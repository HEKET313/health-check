<?php

namespace niklesh\HealthCheckBundle\Entity;

interface HealthDataInterface
{
    public const STATUS_OK = 1;
    public const STATUS_WARNING = 2;
    public const STATUS_DANGER = 3;
    public const STATUS_CRITICAL = 4;

    public function getStatus(): int;
    public function getAdditionalInfo(): array;
}
