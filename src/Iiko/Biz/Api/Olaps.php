<?php

namespace Iiko\Biz\Api;

class Olaps extends AbstractApi
{
    /**
     * @param  string $organizationId
     * @param  mixed $reportType
     * @param  array $params
     * @return array
     */
    public function getOlapColumns(string $organizationId, $reportType, array $params = []): array
    {
        return $this->get('olaps/olapColumns', $this->withToken($params + [
            'organizationId' => $organizationId,
            'reportType' => $reportType,
        ]));
    }

    /**
     * @param  mixed $olapReportRequest
     * @param  array $params
     * @return array
     */
    public function getOlap($olapReportRequest, array $params = []): array
    {
        return $this->post('olaps/olap', $olapReportRequest, $this->withToken($params));
    }

    /**
     * @param  string $organizationId
     * @param  array $params
     * @return array
     */
    public function getOlapPresets(string $organizationId, array $params = []): array
    {
        return $this->get('olaps/olapPresets', $this->withToken($params + [
            'organizationId' => $organizationId,
        ]));
    }

    /**
     * @param  mixed $presetOlapReportRequest
     * @param  array $params
     * @return array
     */
    public function getOlapByPreset($presetOlapReportRequest, array $params = []): array
    {
        return $this->post('olaps/olapByPreset', $presetOlapReportRequest, $this->withToken($params));
    }
}
