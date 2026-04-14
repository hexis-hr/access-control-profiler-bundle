<?php

namespace Hexis\AccessControlProfilerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('access_control_profiler');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->scalarNode('profiler_route')
            ->info('The route name for the profiler')
            ->defaultValue('_profiler')
            ->end()
            ->end();

        return $treeBuilder;
    }
}
