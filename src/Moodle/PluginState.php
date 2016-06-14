<?php

namespace Moodle\Composer\Moodle;

use Composer\Composer;

class PluginState extends \Wikimedia\Composer\Merge\PluginState {

    public function loadSettings() {

        parent::loadSettings();

        // Add our own settings here
        $this->includes[] = 'composer.json';
    }

}