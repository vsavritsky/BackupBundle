<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Factory\Namer;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Vsavritsky\BackupBundle\DependencyInjection\Factory\Factory;
use Zenstruck\Backup\Namer\SimpleNamer;

class SimpleNamerFactory implements Factory
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'simple';
    }

    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $serviceId = sprintf('vsavritsky_backup.namer.%s', $id);

        $container->setDefinition($serviceId, new DefinitionDecorator('vsavritsky_backup.namer.abstract_simple'))
            ->replaceArgument(0, $config['name'])
            ->addTag('vsavritsky_backup.namer')
        ;

        return new Reference($serviceId);
    }

    /**
     * {@inheritdoc}
     */
    public function addConfiguration(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('name')->defaultValue(SimpleNamer::DEFAULT_NAME)->end()
            ->end()
        ;
    }
}
