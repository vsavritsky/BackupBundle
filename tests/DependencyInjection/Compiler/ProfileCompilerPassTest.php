<?php

namespace Vsavritsky\BackupBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\ProfileCompilerPass;

class ProfileCompilerPassTest extends RegisterCompilerPassTest
{
    /**
     * {@inheritdoc}
     */
    protected function getRegistrarDefinitionName()
    {
        return 'vsavritsky_backup.profile_registry';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTagName()
    {
        return 'vsavritsky_backup.profile';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'add';
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ProfileCompilerPass());
    }
}
