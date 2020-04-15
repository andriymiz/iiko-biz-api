<?php

namespace Iiko\Biz\Api;

class Events extends AbstractApi
{
    /**
     * @param  mixed $eventsRequest
     * @param  array $params
     * @return array
     */
    public function getEvents($eventsRequest, array $params = []): array
    {
        return $this->post('events/events', $eventsRequest, $this->withToken($params));
    }

    /**
     * @param  mixed $eventsRequest
     * @param  array $params
     * @return array
     */
    public function getEventsMetadata($eventsRequest, array $params = []): array
    {
        return $this->post('events/eventsMetadata', $eventsRequest, $this->withToken($params));
    }

    /**
     * @param  mixed $eventsRequest
     * @param  array $params
     * @return array
     */
    public function getSessions($eventsRequest, array $params = []): array
    {
        return $this->post('events/sessions', $eventsRequest, $this->withToken($params));
    }
}
