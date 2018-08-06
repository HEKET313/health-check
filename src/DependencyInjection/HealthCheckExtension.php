<?php

namespace niklesh\HealthCheckBundle\DependencyInjection;

use niklesh\HealthCheckBundle\Command\SendDataCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

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

        $commandDefinition = new Definition(SendDataCommand::class);
        foreach ($config['senders'] as $serviceId) {
            $commandDefinition->addArgument(new Reference($serviceId));
        }
        $commandDefinition->addTag('console.command', ['command' => SendDataCommand::COMMAND_NAME]);
        $container->setDefinition(SendDataCommand::class, $commandDefinition);
    }
}
