<?php

namespace Vsavritsky\BackupBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\SourceCompilerPass;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class SourceCompilerPassTest extends RegisterCompilerPassTest
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
        return 'vsavritsky_backup.source';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addSource';
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SourceCompilerPass());
    }
}
