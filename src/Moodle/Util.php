<?php

namespace Moodle\Composer\Moodle;

class Util {

    public static function getComposerJsons() {
		// TODO: This assumes that current working directory is Moodle root
        self::setUpGlobals(getcwd());

		$result = [];
        $plugintypes = \core_component::get_plugin_types();
        foreach ($plugintypes as $plugintype => $typedir) {
		// TODO: This should always get composer.json not use getComposerFile
            $composerplugins = \core_component::get_plugin_list_with_file($plugintype, \Composer\Factory::getComposerFile());
            foreach ($composerplugins as $pluginname => $composerfile) {
                $result[] = $composerfile;
            }
        }
	}

	public static function setUpGlobals($moodledir) {
        global $CFG, $DB;
        $CFG = new \stdClass();
        $CFG->dirroot = $moodledir;
        $CFG->dataroot = sys_get_temp_dir();
        $CFG->wwwroot = 'http://example.com';
        $CFG->debug = E_ALL;
        $CFG->debugdisplay = 1;
        $CFG->libdir = $CFG->dirroot . '/lib';
        defined('CLI_SCRIPT') || define('CLI_SCRIPT', true);
        defined('ABORT_AFTER_CONFIG') || define('ABORT_AFTER_CONFIG', true); // We need just the values from config.php.
        defined('CACHE_DISABLE_ALL') || define('CACHE_DISABLE_ALL', true); // This prevents reading of existing caches.
        defined('IGNORE_COMPONENT_CACHE') || define('IGNORE_COMPONENT_CACHE', true);
        require_once ($CFG->dirroot . '/lib/setup.php');
    }

}