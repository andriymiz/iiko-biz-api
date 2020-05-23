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

    /**
     * Construct the iiko Client
     *
     * @param array $config
     * @param bool $autoTokening
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->httpClient = new GuzzleHttpClient([
            'base_uri' => $options['api_base_uri'] ?? self::DEFAULT_API_BASE_URI,
        ]);
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
