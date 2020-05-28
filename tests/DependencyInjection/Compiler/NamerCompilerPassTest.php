<?php

namespace Vsavritsky\BackupBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\NamerCompilerPass;

class NamerCompilerPassTest extends RegisterCompilerPassTest
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
        return 'vsavritsky_backup.namer';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addNamer';
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new NamerCompilerPass());
    }
}
