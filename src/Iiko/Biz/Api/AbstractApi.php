<?php

namespace Iiko\Biz\Api;

use Iiko\Biz\Client;
use Iiko\Biz\Exception\IikoResponseException;
use GuzzleHttp\Exception\RequestException;
use \Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractApi
 * @package Tmdb\Api
 */
abstract class AbstractApi
{
    /**
     * The client
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a GET request
     *
     * @param  string $path
     * @param  array  $params
     * @param  array  $headers
     * @return mixed
     */
    public function get($path, array $params = [], $headers = [])
    {
        try {
            $response = $this->getClient()->getHttpClient()->request('GET', $path, ['query' => $params, 'headers' => $headers]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $this->decodeResponse($e->getResponse());
                throw new IikoResponseException(
                    $response['message'] ?? $response['Message'] ?? 'Unknown',
                    ($response['code'] ?? 0) ?: ($response['httpStatusCode'] ?? 0)
                );
            }
        }
        return $this->decodeResponse($response);
    }

    /**
     * Send a POST request
     *
     * @param  string $path
     * @param  null   $postBody
     * @param  array  $params
     * @param  array  $headers
     * @return mixed
     */
    public function post($path, $postBody = null, array $params = [], $headers = [])
    {
        if (is_array($postBody)) {
            $postBody = json_encode($postBody, JSON_UNESCAPED_UNICODE);
        }
        $headers['Content-Type'] = 'application/json';
        try {
            $response = $this->getClient()->getHttpClient()->request('POST', $path, ['body' => $postBody, 'query' => $params, 'headers' => $headers]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $this->decodeResponse($e->getResponse());
                throw new IikoResponseException(
                    $response['message'] ?? $response['Message'] ?? 'Unknown',
                    ($response['code'] ?? 0) ?: ($response['httpStatusCode'] ?? 0)
                );
            }
        }

        return $this->decodeResponse($response);
    }

    /**
     * Send a PUT request
     *
     * @param $path
     * @param  null  $body
     * @param  array $params
     * @param  array $headers
     * @return mixed
     */
    public function put($path, $body = null, array $params = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->put($path, $body, $params, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a DELETE request
     *
     * @param  string $path
     * @param  null   $body
     * @param  array  $params
     * @param  array  $headers
     * @return mixed
     */
    public function delete($path, $body = null, array $params = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->delete($path, $body, $params, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a PATCH request
     *
     * @param $path
     * @param  null  $body
     * @param  array $params
     * @param  array $headers
     * @return mixed
     */
    public function patch($path, $body = null, array $params = [], $headers = [])
    {
        $response = $this->getClient()->getHttpClient()->patch($path, $body, $params, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Send a POST request but json_encode the post body in the request
     *
     * @param  string $path
     * @param  mixed  $postBody
     * @param  array  $params
     * @param  array  $headers
     * @return mixed
     */
    public function postJson($path, $postBody = null, array $params = [], $headers = [])
    {
        if (is_array($postBody)) {
            $postBody = json_encode($postBody, JSON_UNESCAPED_UNICODE);
        }

        return $this->post($path, $postBody, $params, $headers);
    }

    /**
     * Retrieve the client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Decode the response
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    private function decodeResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * @param array $params
     * @return array
     */
    public function withToken(array $params): array
    {
        return array_merge([
            'access_token' => $this->getClient()->getToken(),
        ], $params);
    }
}
