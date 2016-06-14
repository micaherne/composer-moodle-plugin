<?php

namespace Moodle\Composer;

use Composer\Plugin\PluginInterface;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Wikimedia\Composer\MergePlugin;
use Moodle\Composer\Moodle\PluginState;
use Wikimedia\Composer\Logger;

class Plugin extends MergePlugin implements PluginInterface, Capable {

    protected $composer;
    protected $io;

    public function activate(Composer $composer, IOInterface $io) {
        $this->composer = $composer;
        $this->state = new PluginState($this->composer);
        $this->logger = new Logger('moodle-plugin', $io);
    }

    public function getCapabilities() {
        return array(
            'Composer\Plugin\Capability\CommandProvider' => 'Moodle\Composer\Command\Provider',
        );
    }

}