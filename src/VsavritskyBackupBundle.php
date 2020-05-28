<?php

namespace Vsavritsky\BackupBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\DestinationCompilerPass;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\NamerCompilerPass;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\ProcessorCompilerPass;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\ProfileCompilerPass;
use Vsavritsky\BackupBundle\DependencyInjection\Compiler\SourceCompilerPass;

class VsavritskyBackupBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ProfileCompilerPass());
        $container->addCompilerPass(new DestinationCompilerPass());
        $container->addCompilerPass(new SourceCompilerPass());
        $container->addCompilerPass(new ProcessorCompilerPass());
        $container->addCompilerPass(new NamerCompilerPass());
    }
}
