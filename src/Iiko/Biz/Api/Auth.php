<?php

namespace Iiko\Biz\Api;

class Auth extends AbstractApi
{
    /**
     * @param  array $params
     * @return string
     */
    public function getAccessToken(array $params = []): string
    {
        return $this->get('auth/access_token', $params);
    }

    /**
     * @param  string $msg
     * @param  string $accessToken
     * @param  array $params
     * @return string
     */
    public function checkAccessToken(string $msg, string $accessToken, array $params = []): string
    {
        return $this->get('auth/echo', $params + [
            'msg' => $msg,
            'access_token' => $accessToken,
        ]);
    }

    /**
     * @param  string $userExtId
     * @param  array $params
     * @return string
     */
    public function getBizAccessToken(string $userExtId, array $params = []): string
    {
        return $this->get('auth/biz_access_token', $params + [
            'user_ext_id' => $userExtId,
        ]);
    }

    /**
     * @param  string $apiAccessToken
     * @param  string $bizAccessToken
     * @param  array $params
     * @return string
     */
    public function getUserInfo(string $apiAccessToken, string $bizAccessToken = '', array $params = []): array
    {
        return $this->get('auth/biz_access_token', $params + [
            'api_access_token' => $apiAccessToken,
            'biz_access_token' => $bizAccessToken,
        ]);
    }
}
