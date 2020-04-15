<?php

namespace Iiko\Biz\Api;

class StopLists extends AbstractApi
{
    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getDeliveryStopList(string $organizationId, array $params = []): array
    {
        return $this->get('stopLists/getDeliveryStopList', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }
}
