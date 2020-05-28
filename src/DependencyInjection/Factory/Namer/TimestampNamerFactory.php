<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Factory\Namer;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Vsavritsky\BackupBundle\DependencyInjection\Factory\Factory;
use Vsavritsky\Backup\Namer\TimestampNamer;

class TimestampNamerFactory implements Factory
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'timestamp';
    }

    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $serviceId = sprintf('vsavritsky_backup.namer.%s', $id);

        $container->setDefinition($serviceId, new DefinitionDecorator('vsavritsky_backup.namer.abstract_timestamp'))
            ->replaceArgument(0, $id)
            ->replaceArgument(1, $config['format'])
            ->replaceArgument(2, $config['prefix'])
            ->replaceArgument(3, $config['timezone'])
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
                ->scalarNode('format')->defaultValue(TimestampNamer::DEFAULT_FORMAT)->end()
                ->scalarNode('prefix')->defaultValue(TimestampNamer::DEFAULT_PREFIX)->end()
                ->scalarNode('timezone')->defaultNull()->end()
            ->end()
        ;
    }
}
