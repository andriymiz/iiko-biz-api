<?php

namespace Iiko\Biz\Api;

class Cities extends AbstractApi
{
    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getCitiesWithStreets(string $organizationId, array $params = []): array
    {
        return $this->get('cities/cities', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getCities(string $organizationId, array $params = []): array
    {
        return $this->get('cities/citiesList', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $cityId
     * @param  array $params
     * @return array
     */
    public function getStreets(string $organizationId, string $cityId, array $params = []): array
    {
        return $this->get('streets/streets', $this->withToken($params + [
            'organization' => $organizationId,
            'city' => $cityId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getRegions(string $organizationId, array $params = []): array
    {
        return $this->get('regions/regions', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }
}
