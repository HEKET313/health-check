<?php

namespace Optimax\HealthCheckBundle\Service;

use Optimax\HealthCheckBundle\Entity\HealthDataInterface;

interface HealthInterface
{
    public const TAG = 'health.service';

    public function getName(): string;
    public function getHealthInfo(): HealthDataInterface;
}
