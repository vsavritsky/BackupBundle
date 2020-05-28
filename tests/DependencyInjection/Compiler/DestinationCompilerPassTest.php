<?php

namespace Vsavritsky\BackupBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\DestinationCompilerPass;

class DestinationCompilerPassTest extends RegisterCompilerPassTest
{
    /**
     * {@inheritdoc}
     */
    protected function getRegistrarDefinitionName()
    {
        return 'vsavritsky_backup.profile_builder';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTagName()
    {
        return 'vsavritsky_backup.destination';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addDestination';
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DestinationCompilerPass());
    }
}
