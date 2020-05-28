<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Factory\Processor;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Vsavritsky\BackupBundle\DependencyInjection\Factory\Factory;
use Vsavritsky\Backup\Processor\ZipArchiveProcessor;

class ZipArchiveProcessorFactory implements Factory
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'zip';
    }

    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $serviceId = sprintf('vsavritsky_backup.processor.%s', $id);

        $container->setDefinition($serviceId, new DefinitionDecorator('vsavritsky_backup.processor.abstract_zip'))
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
                ->scalarNode('options')->defaultValue(ZipArchiveProcessor::DEFAULT_OPTIONS)->end()
                ->integerNode('timeout')->defaultValue(ZipArchiveProcessor::DEFAULT_TIMEOUT)->end()
            ->end()
        ;
    }
}
