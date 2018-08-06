<?php

namespace niklesh\HealthCheckBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package niklesh\HealthCheckBundle\DependencyInjection
 * @codeCoverageIgnore
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('health_check');
        $rootNode
            ->children()
                ->arrayNode('senders')
                    ->scalarPrototype()->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
