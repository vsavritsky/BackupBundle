<?php

namespace Vsavritsky\BackupBundle\Tests\Command;

use Vsavritsky\BackupBundle\Command\RunCommand;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class RunCommandTest extends ProfileActionCommandTest
{
    /**
     * {@inheritdoc}
     */
    protected function createCommand()
    {
        return new RunCommand();
    }

    /**
     * {@inheritdoc}
     */
    protected function getCommandName()
    {
        return 'vsavritsky:backup:run';
    }
}
