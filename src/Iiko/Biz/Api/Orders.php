<?php

namespace Iiko\Biz\Api;

class Orders extends AbstractApi
{
    /**
     * @param  array $orderRequest
     * @param  array $params
     * @return array
     */
    public function addOrder(array $orderRequest, array $params = []): array
    {
        return $this->post('orders/add', $orderRequest, $this->withToken($params));
    }

    /**
     * @param  string $orderId
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getInfo(string $organizationId, string $orderId, array $params = []): array
    {
        return $this->get('orders/info', $this->withToken($params + [
            'organization' => $organizationId,
            'order' => $orderId,
        ]));
    }

    /**
     * @param  array $orderRequest
     * @param  array $params
     * @return array
     */
    public function checkCreate(array $orderRequest, array $params = []): array
    {
        return $this->post('orders/checkCreate', $orderRequest, $this->withToken($params));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function checkAddress(string $organizationId, array $params = []): array
    {
        return $this->post('orders/checkAddress', $params, $this->withToken($params + [
            'organizationId' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getDeliveryOrders(string $organizationId, array $params = []): array
    {
        return $this->get('orders/deliveryOrders', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * Require iikoCallCenter
     *
     * @param  string $organizationId
     * @param  string $customerId
     * @param  array $params
     * @return array
     */
    public function getDeliveryHistory(string $organizationId, string $customerId, array $params = []): array
    {
        return $this->get('orders/deliveryHistory', $this->withToken($params + [
            'organization' => $organizationId,
            'customerId' => $customerId,
        ]));
    }

    /**
     * Require iikoCallCenter
     *
     * @param  string $organizationId
     * @param  string $phoneNumber
     * @param  array $params
     * @return array
     */
    public function getDeliveryHistoryByPhone(string $organizationId, string $phoneNumber, array $params = []): array
    {
        return $this->get('orders/deliveryHistoryByPhone', $this->withToken($params + [
            'organization' => $organizationId,
            'phone' => $phoneNumber,
        ]));
    }

    /**
     * Require iikoCallCenter
     *
     * @param  string $organizationId
     * @param  string $customerId
     * @param  array $params
     * @return array
     */
    public function getDeliveryHistoryByCustomerId(string $organizationId, string $customerId, array $params = []): array
    {
        return $this->get('orders/deliveryHistoryByCustomerId', $this->withToken($params + [
            'organization' => $organizationId,
            'customerId' => $customerId,
        ]));
    }

    /**
     * @param  array $opinion
     * @param  array $params
     * @return array
     */
    public function sendDeliveryOpinion(array $opinion, array $params = []): array
    {
        return $this->post('orders/sendDeliveryOpinion', $opinion, $this->withToken($params));
    }

    /**
     * @param  string $organizationId
     * @param  string $courierId
     * @param  array $params
     * @return array
     */
    public function getCourierOrders(string $organizationId, string $courierId, array $params = []): array
    {
        return $this->get('orders/get_courier_orders', $this->withToken($params + [
            'organization' => $organizationId,
            'courier' => $courierId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $request
     * @param  array $params
     * @return array
     */
    public function assignCourier(string $organizationId, array $request, array $params = []): array
    {
        return $this->post('orders/assigncourier', $request, $this->withToken($params + [
            'organization' => $organizationId,
        ])) ?? [];
    }

    /**
     * @param  string $organizationId
     * @param  array $request
     * @param  array $params
     * @return array
     */
    public function setOrderDelivered(string $organizationId, array $request, array $params = []): array
    {
        return $this->post('orders/set_order_delivered', $request, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $request
     * @param  array $params
     * @return array
     */
    public function addOrderProblem(string $organizationId, array $request, array $params = []): array
    {
        return $this->post('orders/add_order_problem', $request, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * ---------------------------
     * All methods below require iikoCard5
     * ---------------------------
     */

    /**
     * @param  array $orderRequest
     * @param  array $params
     * @return array
     */
    public function calculateCheckinResult(array $orderRequest, array $params = []): array
    {
        return $this->post('orders/calculate_checkin_result', $orderRequest, $this->withToken($params));
    }

    /**
     * Require iikoCallCenter
     *
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getCombosInfo(string $organizationId, array $params = []): array
    {
        return $this->get('orders/get_combos_info', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getManualConditionInfos(string $organizationId, array $params = []): array
    {
        return $this->get('orders/get_manual_condition_infos', $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }

    /**
     * @param  string $organizationId
     * @param  array $comboPriceRequest
     * @param  array $params
     * @return array
     */
    public function checkAndGetComboPrice(string $organizationId, array $comboPriceRequest, array $params = []): array
    {
        return $this->post('orders/check_and_get_combo_price', $comboPriceRequest, $this->withToken($params + [
            'organization' => $organizationId,
        ]));
    }
}
