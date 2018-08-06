<?php

namespace niklesh\HealthCheckBundle\DependencyInjection;

use niklesh\HealthCheckBundle\Command\SendDataCommand;
use niklesh\HealthCheckBundle\Service\HealthSenderInterface;
use Reference;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class HealthCheckBundleExtension
 * @package niklesh\HealthCheckBundle\DependencyInjection
 * @codeCoverageIgnore
 */
class HealthCheckExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $sendersDefinitions = array_map(function (string $serviceId) use ($container) {
            return $container->findDefinition($serviceId);
        }, $config['senders']);

        $commandDefinition = new Definition(SendDataCommand::class);
        $commandDefinition->addArgument(...$sendersDefinitions);
        foreach (array_keys($container->findTaggedServiceIds(HealthSenderInterface::TAG)) as $serviceId) {
            $commandDefinition->addMethodCall('addHealthService', [new Reference($serviceId)]);
        }
        $container->setDefinition(SendDataCommand::class, $commandDefinition);
    }
}
