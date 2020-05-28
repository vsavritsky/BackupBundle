<?php

namespace Vsavritsky\BackupBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\ProcessorCompilerPass;

class ProcessorCompilerPassTest extends RegisterCompilerPassTest
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
        return 'vsavritsky_backup.processor';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addProcessor';
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ProcessorCompilerPass());
    }
}
