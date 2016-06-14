<?php

namespace Moodle\Composer\Command;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\OutputInterface;

class MoodleCommand extends BaseCommand {

    protected function configure() {
        $this->setName('moodle')->setDescription("Call other Composer commands in the context of Moodle.")->setDefinition(array (
            new InputArgument('command-name', InputArgument::REQUIRED, ''),
            new InputArgument('args', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, '')
        ))->setHelp(<<<EOT
Use this command as a wrapper to run other Composer commands
within the context of Moodle.

This causes both the main composer.json and composer.local.json in the
root of the Moodle installation to be read.

EOT
);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Symfony\Component\Console\Command\Command::run() (Nicked from built-in GlobalCommand)
     */
    public function run(InputInterface $input, OutputInterface $output) {
        // extract real command name
        $tokens = preg_split('{\s+}', $input->__toString());
        $args = array ();
        foreach ($tokens as $token) {
            if ($token && $token [0] !== '-') {
                $args [] = $token;
                if (count($args) >= 2) {
                    break;
                }
            }
        }

        // show help for this command if no command was found
        if (count($args) < 2) {
            return parent::run($input, $output);
        }

        // change to composer.local.json
        putenv("COMPOSER=composer.local.json");

        // create new input without "moodle" command prefix
        $input = new StringInput(preg_replace('{\bm(?:o(?:o(?:d(?:l(?:e)?)?)?)?)?\b}', '', $input->__toString(), 1));

        $this->getApplication()->resetComposer();

        return $this->getApplication()->run($input, $output);
    }

    public function isProxyCommand() {
        return true;
    }

}