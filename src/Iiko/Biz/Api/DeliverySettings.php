<?php

namespace Iiko\Biz\Api;

class DeliverySettings extends AbstractApi
{
    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getDeliveryDiscounts(string $organizationId, array $params = []): array
    {
        return $this->get('deliverySettings/deliveryDiscounts', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getDeliveryTerminals(string $organizationId, array $params = []): array
    {
        return $this->get('deliverySettings/getDeliveryTerminals', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getDeliveryRestrictions(string $organizationId, array $params = []): array
    {
        return $this->get('deliverySettings/getDeliveryRestrictions', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getSurveyItems(string $organizationId, array $params = []): array
    {
        return $this->get('deliverySettings/getSurveyItems', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getDeliveryCourierMobileSettings(string $organizationId, array $params = []): array
    {
        return $this->get('deliverySettings/getDeliveryCourierMobileSettings', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }
}
