<?php

namespace Iiko\Biz;

use Iiko\Biz\Api\DeliverySettings;
use Iiko\Biz\Api\Organizations;
use Iiko\Biz\Api\Nomenclature;
use Iiko\Biz\Api\Customers;
use Iiko\Biz\Api\StopLists;
use Iiko\Biz\Api\Settings;
use Iiko\Biz\Api\Notices;
use Iiko\Biz\Api\Cities;
use Iiko\Biz\Api\Events;
use Iiko\Biz\Api\Orders;
use Iiko\Biz\Api\Olaps;
use Iiko\Biz\Api\Auth;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Iiko\Biz\Factories\LoggerFactory;

/**
 * The iiko API Client
 *
 * Example:
 *
 * $menu = $iiko->NomenclatureApi()->getMenu($organization['id']);
 * $iiko->OrdersApi()->checkAddress($organization['id'], [
 *     "city" => "Москва",
 *     "street" => "Планетарная",
 *     "home" => "1"
 * ]);
 * $cities = $iiko->CitiesApi()->getCitiesWithStreets($organization['id']);
 * $res = $iiko->OrdersApi()->addOrder([
 *     'organization' => $organization['id'],
 *     'customer' => ['name' => 'test', 'phone' => 'Phone'],
 *     'order' => ['phone' => 'Phone'],
 * ]);
 * $res = $iiko->OrdersApi()->getDeliveryOrders($organization['id'], [
 *     'dateFrom' => '2020-04-09',
 *     'dateTo' => '2020-04-09',
 * ]);
 * $res = $iiko->SettingsApi()->getSupportedProtocols($organization['id']);
 * $res = $iiko->DeliverySettingsApi()->getDeliveryDiscounts($organization['id']);
 */
class Client
{
    const DEFAULT_API_BASE_URI = 'https://iiko.biz:9900/api/0/';

    /**
     * @var GuzzleHttpClient $client
     */
    private $httpClient;

    /**
     * @var array
     */
    private $options;

    /**
     * @var string
     */
    private $token;

    protected $logger;
    const MAX_RETRIES = 1;

    /**
     * Construct the iiko Client
     *
     * @param array $config
     * @param bool $autoTokening
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
        if (isset($options['logging']) && is_string($options['logging'])) {
            $this->logger = (new LoggerFactory)->create('log', $options['logging']);
        }

        $this->httpClient = new GuzzleHttpClient([
            'base_uri' => $options['api_base_uri'] ?? self::DEFAULT_API_BASE_URI,
            'handler' => $this->logger ? $this->createHandlerStack() : null,
        ]);
    }

    /**
     * @return mixed
     */
    protected function createHandlerStack()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::retry($this->retryDecider(), $this->retryDelay()));
        return $this->createLoggingHandlerStack($stack);
    }

    /**
     * @param HandlerStack $stack
     * @return mixed
     */
    protected function createLoggingHandlerStack(HandlerStack $stack)
    {
        $messageFormats = [
            '{method} {uri} HTTP/{version}',
            'HEADERS: {req_headers}',
            'BODY: {req_body}',
            'RESPONSE: {code} - {res_body}',
        ];
        foreach ($messageFormats as $messageFormat) {
            // We'll use unshift instead of push, to add the middleware to the bottom of the stack, not the top
            $stack->unshift(
                $this->createGuzzleLoggingMiddleware($messageFormat)
            );
        }

        return $stack;
    }

    /**
     * @param string $messageFormat
     * @return mixed
     */
    protected function createGuzzleLoggingMiddleware(string $messageFormat)
    {
        return Middleware::log(
            $this->logger,
            new MessageFormatter($messageFormat)
        );
    }

    /**
     * @return mixed
     */
    protected function retryDecider()
    {
        return function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            // Limit the number of retries to MAX_RETRIES
            if ($retries >= self::MAX_RETRIES) {
                return false;
            }
            // Retry connection exceptions
            if ($exception instanceof ConnectException) {
                $this->logger->info('Timeout encountered, retrying');
                return true;
            }
            if ($response) {
                // Retry on server errors
                if ($response->getStatusCode() >= 500) {
                    $this->logger->info('Server 5xx error encountered, retrying...');
                    return true;
                }
            }
            return false;
        };
    }

    /**
     * delay 1s 2s 3s 4s 5s ...
     *
     * @return mixed
     */
    protected function retryDelay()
    {
        return function ($numberOfRetries) {
            return 1000 * $numberOfRetries;
        };
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        if ($this->token === null) {
            $this->token = $this->AuthApi()->getAccessToken([
                'user_id' => $this->options['user_id'],
                'user_secret' => $this->options['user_secret'],
            ]);
        }
        return $this->token;
    }

    /**
     * @return GuzzleHttpClient
     */
    public function getHttpClient(): GuzzleHttpClient
    {
        return $this->httpClient;
    }

    /**
     * @return Auth
     */
    public function AuthApi(): Auth
    {
        return new Auth($this);
    }

    /**
     * @return Orders
     */
    public function OrdersApi(): Orders
    {
        return new Orders($this);
    }

    /**
     * @return Nomenclature
     */
    public function NomenclatureApi(): Nomenclature
    {
        return new Nomenclature($this);
    }

    /**
     * @return Cities
     */
    public function CitiesApi(): Cities
    {
        return new Cities($this);
    }

    /**
     * @return Notices
     */
    public function NoticesApi(): Notices
    {
        return new Notices($this);
    }

    /**
     * @return Organizations
     */
    public function OrganizationsApi(): Organizations
    {
        return new Organizations($this);
    }

    /**
     * @return Settings
     */
    public function SettingsApi(): Settings
    {
        return new Settings($this);
    }

    /**
     * @return StopLists
     */
    public function StopListsApi(): StopLists
    {
        return new StopLists($this);
    }

    /**
     * @return DeliverySettings
     */
    public function DeliverySettingsApi(): DeliverySettings
    {
        return new DeliverySettings($this);
    }

    /**
     * @return Olaps
     */
    public function OlapsApi(): Olaps
    {
        return new Olaps($this);
    }

    /**
     * @return Events
     */
    public function EventsApi(): Events
    {
        return new Events($this);
    }

    /**
     * @return Customers
     */
    public function CustomersApi(): Customers
    {
        return new Customers($this);
    }
}
