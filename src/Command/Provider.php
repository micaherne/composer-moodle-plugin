<?php

namespace Moodle\Composer\Command;

use Composer\Plugin\Capability\CommandProvider;
use Moodle\Composer\Command\MoodleCommand;

class Provider implements CommandProvider {

    public function getCommands() {

        return [
            new MoodleCommand()
        ];

    }

}