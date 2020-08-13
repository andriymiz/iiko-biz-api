<?php

namespace Iiko\Biz\Api;

class Customers extends AbstractApi
{
    /**
     * ---------------------------
     * All methods below require iikoCard5
     * ---------------------------
     */

    /**
     * @param  string $organizationId
     * @param  string $userPhone
     * @param  array $params
     * @return array
     */
    public function getCustomerByPhone(string $organizationId, string $userPhone, array $params = []): array
    {
        return $this->get('customers/get_customer_by_phone', $this->withToken($params + [
            'organization' => $organizationId,
            'phone' => $userPhone,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $userId
     * @param  array $params
     * @return array
     */
    public function getCustomerById(string $organizationId, string $userId, array $params = []): array
    {
        return $this->get('customers/get_customer_by_id', $this->withToken($params + [
            'organization' => $organizationId,
            'id' => $userId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $cardNumber
     * @param  array $params
     * @return array
     */
    public function getCustomerByCard(string $organizationId, string $cardNumber, array $params = []): array
    {
        return $this->get('customers/get_customer_by_card', $this->withToken($params + [
            'organization' => $organizationId,
            'card' => $cardNumber,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $customer
     * @param  array $params
     * @return string
     */
    public function createOrUpdate(string $organizationId, array $customer, array $params = [])
    {
        return $this->post('customers/create_or_update', ['customer' => $customer], $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $customerId
     * @param  string $categoryId
     * @param  array $params
     * @return array
     */
    public function addCategory(string $organizationId, string $customerId, string $categoryId, array $params = [])
    {
        return $this->post("customers/{$customerId}/add_category", [], $this->withToken($params + [
            'organization' => $organizationId,
            'categoryId' => $categoryId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $customerId
     * @param  string $categoryId
     * @param  array $params
     * @return array
     */
    public function removeCategory(string $organizationId, string $customerId, string $categoryId, array $params = [])
    {
        return $this->post("customers/{$customerId}/remove_category", [], $this->withToken($params + [
            'organization' => $organizationId,
            'categoryId' => $categoryId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $categoryId
     * @param  string $customerId
     * @param  array $params
     * @return array
     */
    public function addCard(string $organizationId, string $customerId, array $addCardRequest, array $params = [])
    {
        return $this->post("customers/{$customerId}/add_card", $addCardRequest, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $customerId
     * @param  string $cardTrack
     * @param  array $params
     * @return array
     */
    public function deleteCard(string $organizationId, string $customerId, string $cardTrack, array $params = [])
    {
        return $this->post("customers/{$customerId}/delete_card", [], $this->withToken($params + [
            'organization' => $organizationId,
            'cardTrack' => $cardTrack,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $refillBalanceRequest
     * @param  array $params
     * @return array
     */
    public function refillBalance(string $organizationId, array $refillBalanceRequest, array $params = [])
    {
        return $this->post('customers/refill_balance', $refillBalanceRequest, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $withdrawBalanceRequest
     * @param  array $params
     * @return array
     */
    public function withdrawBalance(string $organizationId, array $withdrawBalanceRequest, array $params = [])
    {
        return $this->post('customers/withdraw_balance', $withdrawBalanceRequest, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $customerId
     * @param  string $corporateNutritionId
     * @param  array $params
     * @return array
     */
    public function addToNutritionOrganization(string $organizationId, string $customerId, string $corporateNutritionId, array $params = [])
    {
        return $this->post("customers/{$customerId}/add_to_nutrition_organization", [], $this->withToken($params + [
            'organization' => $organizationId,
            'corporate_nutrition_id' => $corporateNutritionId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $customerId
     * @param  string $corporateNutritionId
     * @param  array $params
     * @return array
     */
    public function removeFromNutritionOrganization(string $organizationId, string $customerId, string $corporateNutritionId, array $params = [])
    {
        return $this->post("customers/{$customerId}/remove_from_nutrition_organization", [], $this->withToken($params + [
            'organization' => $organizationId,
            'corporate_nutrition_id' => $corporateNutritionId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $dateFrom
     * @param  string $dateTo
     * @param  array $params
     * @return array
     */
    public function getCustomersByOrganizationAndByPeriod(string $organizationId, string $dateFrom, string $dateTo, array $params = []): array
    {
        return $this->get('customers/get_customers_by_organization_and_by_period', $this->withToken($params + [
            'organization' => $organizationId,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $request
     * @param  array $params
     * @return array
     */
    public function getCategoriesByGuests(string $organizationId, array $request, array $params = []): array
    {
        return $this->post('customers/get_categories_by_guests', $request, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $request
     * @param  array $params
     * @return array
     */
    public function getCountersByGuests(string $organizationId, array $request, array $params = []): array
    {
        return $this->post('customers/get_counters_by_guests', $request, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  string $walletId
     * @param  array $request
     * @param  array $params
     * @return array
     */
    public function getBalancesByGuestsAndWallet(string $organizationId, string $walletId, array $request, array $params = []): array
    {
        return $this->post('customers/get_balances_by_guests_and_wallet', $request, $this->withToken($params + [
            'organization' => $organizationId,
            'wallet' => $walletId,
        ]));
    }
}
