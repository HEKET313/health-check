<?php

namespace Optimax\HealthCheckBundle\Entity;

interface HealthDataInterface
{
    public const STATUS_OK = 1;
    public const STATUS_ERROR = 2;
    public const STATUS_WARNING = 3;

    public function getStatus(): int;
    public function getAdditionalInfo(): array;
}
