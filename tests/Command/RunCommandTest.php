<?php

namespace vsavritsky\BackupBundle\Tests\Command;

use vsavritsky\BackupBundle\Command\RunCommand;

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
