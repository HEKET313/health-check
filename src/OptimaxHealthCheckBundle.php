<?php

namespace Optimax\HealthCheckBundle;

use Optimax\HealthCheckBundle\DependencyInjection\Compiler\HealthServicesPath;
use Optimax\HealthCheckBundle\Service\HealthInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OptimaxHealthCheckBundle
 * @package Optimax\HealthCheckBundle
 * @codeCoverageIgnore
 */
class OptimaxHealthCheckBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new HealthServicesPath());
        $container->registerForAutoconfiguration(HealthInterface::class)->addTag(HealthInterface::TAG);
    }
}
