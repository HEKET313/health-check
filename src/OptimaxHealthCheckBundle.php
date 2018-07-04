<?php

namespace Optimax\HealthCheckBundle;

use Optimax\HealthCheckBundle\DependencyInjection\Compiler\HealthServicesPath;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OptimaxHealthCheckBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new HealthServicesPath());
    }

}
