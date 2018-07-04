<?php

namespace Optimax\HealthCheckBundle\DependencyInjection;

use Optimax\HealthCheckBundle\DependencyInjection\Compiler\HealthServicesPath;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class OptimaxHealthCheckBundleExtension
 * @package Optimax\HealthCheckBundle\DependencyInjection
 * @codeCoverageIgnore
 */
class OptimaxHealthCheckExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
    }
}
