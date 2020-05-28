<?php

namespace Vsavritsky\BackupBundle\Tests;

use Vsavritsky\BackupBundle\ZenstruckBackupBundle;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ZenstruckBackupBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function compiler_passes_are_registered()
    {
        $container = $this
            ->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->setMethods(array('addCompilerPass'))
            ->getMock();

        $container
            ->expects($this->exactly(5))
            ->method('addCompilerPass')
            ->withConsecutive(
                $this->isInstanceOf('Vsavritsky\BackupBundle\DependencyInjection\Compiler\ProfileCompilerPass'),
                $this->isInstanceOf('Vsavritsky\BackupBundle\DependencyInjection\Compiler\DestinationCompilerPass'),
                $this->isInstanceOf('Vsavritsky\BackupBundle\DependencyInjection\Compiler\SourceCompilerPass'),
                $this->isInstanceOf('Vsavritsky\BackupBundle\DependencyInjection\Compiler\ProcessorCompilerPass'),
                $this->isInstanceOf('Vsavritsky\BackupBundle\DependencyInjection\Compiler\NamerCompilerPass')
            );

        $bundle = new ZenstruckBackupBundle();
        $bundle->build($container);
    }
}
