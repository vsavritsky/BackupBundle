<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Compiler;

class DestinationCompilerPass extends RegisterCompilerPass
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
        return 'vsavritsky_backup.destination';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'addDestination';
    }
}
