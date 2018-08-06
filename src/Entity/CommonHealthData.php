<?php

namespace niklesh\HealthCheckBundle\Entity;

/**
 * Class CommonHealthData
 * @package niklesh\HealthCheckBundle\Entity
 * @codeCoverageIgnore
 */
class CommonHealthData implements HealthDataInterface
{
    private $status;
    private $additionalInfo = [];

    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function setAdditionalInfo(array $additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }
}
