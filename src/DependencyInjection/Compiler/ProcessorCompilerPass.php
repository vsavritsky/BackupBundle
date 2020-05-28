<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Compiler;

class ProcessorCompilerPass extends RegisterCompilerPass
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
        return 'vsavritsky_backup.processor';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addProcessor';
    }
}
