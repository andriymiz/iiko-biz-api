<?php

namespace Iiko\Biz\Api;

class Notices extends AbstractApi
{
    /**
     * @param  array $params
     * @return array
     */
    public function sendNotices(array $request, array $params = [])
    {
        return $this->post('notices/notices', $request, $this->withToken($params));
    }
}
