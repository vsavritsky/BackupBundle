<?php

namespace Vsavritsky\BackupBundle\Tests\Command;

use Vsavritsky\BackupBundle\Command\ListCommand;

class ListCommandTest extends ProfileActionCommandTest
{
    /**
     * {@inheritdoc}
     */
    protected function createCommand()
    {
        return new ListCommand();
    }

    /**
     * {@inheritdoc}
     */
    protected function getCommandName()
    {
        return 'vsavritsky:backup:list';
    }
}
