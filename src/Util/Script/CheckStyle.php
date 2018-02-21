<?php

namespace App\Util\Script;

use Composer\Script\Event;

/**
 * Class CheckStyle to run phpcs fixer on src directory.
 */
class CheckStyle
{
    /**
     * Execute script. function is static to allow call from composer post-install commands via composer.json file.
     *
     * @param Event $event
     *
     * @return void
     */
    public static function execute(Event $event)
    {
        $result = null;
        exec('vendor/bin/phpcs --standard=LeagueLineCS.xml --colors -s --extensions=php src/', $result);

        $result > 0 ? $event->getIO()->write($result) : $event->getIO()->write('<info>No check style errors.</info>' . PHP_EOL);
    }
}
