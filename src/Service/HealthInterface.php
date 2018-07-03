<?php

namespace Optimax\HealthCheckBundle\Service;

use Optimax\HealthCheckBundle\Entity\HealthDataInterface;

interface HealthInterface
{
    public function getName(): string;
    public function getHealthInfo(): HealthDataInterface;
}
