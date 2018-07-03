<?php

namespace Optimax\HealthCheckBundle\DependencyInjection\Compiler;

use Optimax\HealthCheckBundle\Controller\HealthController;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class HealthServicesPath implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(HealthController::class)) {
            return;
        }

        $controller = $container->findDefinition(HealthController::class);
        foreach ($container->findTaggedServiceIds('health.service') as $serviceId) {
            $controller->addMethodCall('addHealthService', [new Reference($serviceId)]);
        }
    }
}
