Moodle Composer Plugin
======================
This plugin enables installation of Moodle plugins
using Composer.

Commands
--------

### moodle
This is a proxy command which simply sets the main composer file to composer.local.json before running the command passed to it. It merges the data from the main composer.json and the local file when installing or updating.

Examples:

    $ composer moodle update

    $ composer moodle init  

#### --merge-plugins flag

As above but will look for any composer.json files in any Moodle plugins (assuming it is run in the root of a Moodle codebase) and merge them together.

The main use for this is to resolve a common set of dependencies for all Moodle plugins using composer, ensuring that
there are no conflicts between versions of libraries that are being used by more than one plugin.

#### --rewrite-autoload flag

Using this flag will rewrite the composer-generated autoload.php files *within Moodle plugins' vendor directories*
to use the root vendor/autoload.php
