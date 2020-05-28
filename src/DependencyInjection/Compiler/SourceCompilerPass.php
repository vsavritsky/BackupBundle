<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Compiler;

class SourceCompilerPass extends RegisterCompilerPass
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
        return 'vsavritsky_backup.source';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addSource';
    }
}
