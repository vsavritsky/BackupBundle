<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Factory\Destination;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Vsavritsky\BackupBundle\DependencyInjection\Factory\Factory;

class StreamDestinationFactory implements Factory
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'stream';
    }

    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $serviceId = sprintf('vsavritsky_backup.destination.%s', $id);

        $container->setDefinition($serviceId, new DefinitionDecorator('vsavritsky_backup.destination.abstract_stream'))
            ->replaceArgument(0, $id)
            ->replaceArgument(1, $config['directory'])
            ->addTag('vsavritsky_backup.destination')
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
                ->scalarNode('directory')->isRequired()->end()
            ->end()
        ;
    }
}
