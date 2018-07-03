<?php

namespace Optimax\HealthCheckBundle\Tests\Unit\DependencyInjection\Compiler;

use Optimax\HealthCheckBundle\Controller\HealthController;
use Optimax\HealthCheckBundle\DependencyInjection\Compiler\HealthServicesPath;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class HealthServicesPathTest extends TestCase
{
    public function testProcessNoController()
    {
        $path = new HealthServicesPath();
        $containerBuilder = $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['has', 'findDefinition'])
            ->getMock();
        $containerBuilder->method('has')->willReturn(false);
        $containerBuilder->expects($this->never())->method('findDefinition');
        $path->process($containerBuilder);
    }

    public function testProcess()
    {
        $healthServices = ['HealthService1', 'HealthService2', 'HealthService3'];

        $controller = $this->getMockBuilder(Definition::class)
            ->disableOriginalConstructor()
            ->setMethods(['addMethodCall'])
            ->getMock();
        $controller->expects($this->exactly(sizeof($healthServices)))->method('addMethodCall')->willReturn($controller);

        $containerBuilder = $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['has', 'findDefinition', 'findTaggedServiceIds'])
            ->getMock();
        $containerBuilder->method('has')->willReturn(true);
        $containerBuilder->method('findDefinition')->willReturn($controller);
        $containerBuilder->method('findTaggedServiceIds')->willReturn($healthServices);

        (new HealthServicesPath())->process($containerBuilder);
    }
}
