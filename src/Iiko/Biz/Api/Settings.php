<?php

namespace Iiko\Biz\Api;

class Settings extends AbstractApi
{
    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getSupportedProtocols(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/supportedProtocols', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getRoles(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getRoles', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getEmployees(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getEmployees', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getRestaurantSections(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getRestaurantSections', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getOrderTypes(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getOrderTypes', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getPaymentTypes(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getPaymentTypes', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getMarketingSources(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getMarketingSources', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getCouriers(string $organizationId, array $params = []): array
    {
        return $this->get('rmsSettings/getCouriers', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }
}
