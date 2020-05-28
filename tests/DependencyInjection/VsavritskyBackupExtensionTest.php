<?php

namespace Vsavritsky\BackupBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\Yaml\Yaml;
use Vsavritsky\BackupBundle\DependencyInjection\VsavritskyBackupExtension;

class vsavritskyBackupExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @test
     */
    public function can_compile_with_no_config()
    {
        $this->load();
        $this->compile();

        $this->assertContainerBuilderHasService('vsavritsky_backup.profile_registry');
        $this->assertContainerBuilderHasService('vsavritsky_backup.profile_builder');
        $this->assertContainerBuilderHasService('vsavritsky_backup.executor');
    }

    /**
     * @test
     */
    public function compile_with_valid_config()
    {
        $this->load($this->loadConfig('valid_config.yml'));
        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.source.database', 'vsavritsky_backup.source');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.source.files', 'vsavritsky_backup.source');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.namer.simple', 'vsavritsky_backup.namer');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.namer.daily', 'vsavritsky_backup.namer');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.namer.snapshot', 'vsavritsky_backup.namer');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.processor.zip', 'vsavritsky_backup.processor');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.processor.gzip', 'vsavritsky_backup.processor');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.destination.s3', 'vsavritsky_backup.destination');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.destination.stream', 'vsavritsky_backup.destination');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.profile.daily', 'vsavritsky_backup.profile');
        $this->assertContainerBuilderHasServiceDefinitionWithTag('vsavritsky_backup.profile.monthly', 'vsavritsky_backup.profile');
    }

    /**
     * @test
     *
     * @dataProvider invalidConfigProvider
     */
    public function compile_with_invalid_config($file, $message, $expectedException)
    {
        $this->setExpectedException($expectedException, $message);

        $this->load($this->loadConfig($file));
        $this->compile();
    }

    public static function invalidConfigProvider()
    {
        return array(
            array('invalid_profile_missing_sources.yml', 'The child node "sources" at path "vsavritsky_backup.profiles.daily" must be configured.', 'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException'),
            array('invalid_profile_missing_namer.yml', 'The child node "namer" at path "vsavritsky_backup.profiles.daily" must be configured.', 'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException'),
            array('invalid_profile_missing_destinations.yml', 'The child node "destinations" at path "vsavritsky_backup.profiles.daily" must be configured.', 'Symfony\Component\Config\Definition\Exception\InvalidConfigurationException'),
        );
    }

    protected function getContainerExtensions()
    {
        return array(new vsavritskyBackupExtension());
    }

    private function loadConfig($file)
    {
        return Yaml::parse(file_get_contents(__DIR__.'/../Fixtures/'.$file));
    }
}
