<?php

namespace Hexis\AccessControlProfilerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Filesystem\Filesystem;

class AccessControlProfilerExtension extends Extension
{
    public function getAlias(): string
    {
        return 'access_control_profiler';
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        //this is required because of Sulu CMS :(
        if (!class_exists('Symfony\Component\HttpKernel\Profiler\Profiler')) return;

        $configDir = new FileLocator(__DIR__ . '/../../config');
        $loader = new YamlFileLoader($container, $configDir);
        $loader->load('services.yaml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['access_control_profiler'])) {
            $definition = $container->getDefinition('hexis.access_control_profiler.event_listener');

            if (isset($config['profiler_route'])) {
                $definition->setArgument(2, $config['profiler_route']);
            } else {
                $definition->setArgument(2, '_profiler');
            }
        }
    }
}
