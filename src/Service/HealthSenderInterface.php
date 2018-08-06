<?php

namespace niklesh\HealthCheckBundle\Service;

use niklesh\HealthCheckBundle\Entity\HealthDataInterface;

interface HealthSenderInterface
{
    public const TAG = 'health.sender';

    /**
     * @param HealthDataInterface[] $data
     */
    public function send(array $data): void;
    public function getDescription(): string;
    public function getName(): string;
}
