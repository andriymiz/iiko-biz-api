<?php

namespace Iiko\Biz\Api;

class Nomenclature extends AbstractApi
{
    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getMenu(string $organizationId, array $params = []): array
    {
        return $this->get("nomenclature/{$organizationId}", $this->withToken($params));
    }
}
