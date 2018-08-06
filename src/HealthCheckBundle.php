<?php

namespace niklesh\HealthCheckBundle;

use niklesh\HealthCheckBundle\DependencyInjection\Compiler\HealthServicesPath;
use niklesh\HealthCheckBundle\Service\HealthInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class HealthCheckBundle
 * @package niklesh\HealthCheckBundle
 * @codeCoverageIgnore
 */
class HealthCheckBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new HealthServicesPath());
        $container->registerForAutoconfiguration(HealthInterface::class)->addTag(HealthInterface::TAG);
    }
}
