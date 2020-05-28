<?php

namespace Vsavritsky\BackupBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vsavritsky\Backup\Console\Command\RunCommand as BaseRunCommand;
use Vsavritsky\Backup\Console\Helper\BackupHelper;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class RunCommand extends BaseRunCommand
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
