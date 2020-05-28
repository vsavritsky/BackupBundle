<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Compiler;

class NamerCompilerPass extends RegisterCompilerPass
{
    /**
     * {@inheritdoc}
     */
    protected function getDefinitionName()
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
}
