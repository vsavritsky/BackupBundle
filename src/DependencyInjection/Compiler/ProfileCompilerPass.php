<?php

namespace Vsavritsky\BackupBundle\DependencyInjection\Compiler;

class ProfileCompilerPass extends RegisterCompilerPass
{
    /**
     * {@inheritdoc}
     */
    protected function getDefinitionName()
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
}
