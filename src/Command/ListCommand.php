<?php

namespace Vsavritsky\BackupBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vsavritsky\Backup\Console\Command\ListCommand as BaseListCommand;
use Vsavritsky\Backup\Console\Helper\BackupHelper;

class ListCommand extends BaseListCommand
{
    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Application $application */
        $application = $this->getApplication();

        if (!$application instanceof Application) {
            throw new \RuntimeException('Application must be instance of Symfony\Bundle\FrameworkBundle\Console\Application');
        }

        $container = $application->getKernel()->getContainer();

        $this->getHelperSet()->set(new BackupHelper(
            $container->get('vsavritsky_backup.profile_registry'),
            $container->get('vsavritsky_backup.executor')
        ));

        parent::execute($input, $output);
    }
}
