<?php

namespace Iiko\Biz\Api;

class Organizations extends AbstractApi
{
    /**
     * @param  array $params
     * @return array
     */
    public function getList(array $params = []): array
    {
        return $this->get('organization/list', $this->withToken($params));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getOrganization(string $organizationId, array $params = []): array
    {
        return $this->get("organization/{$organizationId}", $this->withToken($params));
    }

    /**
     * @param  string $apiAccessToken
     * @param  array $userIds
     * @param  array $params
     * @return array
     */
    public function getUsersOrganizations(string $apiAccessToken, array $userIds, array $params = []): array
    {
        return $this->post('applicationMarket/usersOrganizations', $userIds, $params + [
            'api_access_token' => $apiAccessToken,
        ]);
    }

    /**
     * ---------------------------
     * All methods below require iikoCard5
     * ---------------------------
     */

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getOrganizationCorporateNutritions(string $organizationId, array $params = [])
    {
        return $this->get("organization/{$organizationId}/corporate_nutritions", $this->withToken($params));
    }

    /**
     * @param  string $organizationId
     * @param  string $corporateNutritionProgramId
     * @param  string $dateFrom
     * @param  string $dateTo
     * @param  array $params
     * @return array
     */
    public function getOrganizationCorporateNutritionReport(string $organizationId, string $corporateNutritionProgramId, string $dateFrom, string $dateTo, array $params = [])
    {
        return $this->get("organization/{$organizationId}/corporate_nutrition_report", $this->withToken($params + [
            'corporate_nutrition_id' => $corporateNutritionProgramId,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $userId
     * @param  string $dateFrom
     * @param  string $dateTo
     * @param  array $params
     * @return array
     */
    public function getTransactionsReport(string $organizationId, string $userId, string $dateFrom, string $dateTo, array $params = [])
    {
        return $this->get("organization/{$organizationId}/transactions_report", $this->withToken($params + [
            'userId' => $userId,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getGuestCategories(string $organizationId, array $params = [])
    {
        return $this->get("organization/{$organizationId}/guest_categories", $this->withToken($params));
    }

    /**
     * @param  string $apiAccessToken
     * @param  array $sendSmsRequest
     * @param  array $params
     * @return array
     */
    public function sendSms(string $organizationId, array $sendSmsRequest, array $params = [])
    {
        return $this->post("organization/{$organizationId}/send_sms", $sendSmsRequest, $this->withToken($params));
    }

    /**
     * @param  string $apiAccessToken
     * @param  array $sendEmailRequest
     * @param  array $params
     * @return array
     */
    public function sendEmail(string $organizationId, array $sendEmailRequest, array $params = [])
    {
        return $this->post("organization/{$organizationId}/send_email", $sendEmailRequest, $this->withToken($params));
    }
}
