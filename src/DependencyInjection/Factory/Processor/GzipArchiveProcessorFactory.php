<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Factory\Processor;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Vsavritsky\BackupBundle\DependencyInjection\Factory\Factory;
use Zenstruck\Backup\Processor\GzipArchiveProcessor;

class GzipArchiveProcessorFactory implements Factory
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'gzip';
    }

    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $serviceId = sprintf('vsavritsky_backup.processor.%s', $id);

        $container->setDefinition($serviceId, new DefinitionDecorator('vsavritsky_backup.processor.abstract_gzip'))
            ->replaceArgument(0, $id)
            ->replaceArgument(1, $config['options'])
            ->replaceArgument(2, $config['timeout'])
            ->addTag('vsavritsky_backup.processor')
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
                ->scalarNode('options')->defaultValue(GzipArchiveProcessor::DEFAULT_OPTIONS)->end()
                ->integerNode('timeout')->defaultValue(GzipArchiveProcessor::DEFAULT_TIMEOUT)->end()
            ->end()
        ;
    }
}
