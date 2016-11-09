<?php

/*
 * This file is part of consoletvs/apify.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ConsoleTVs\Apify\Builder;

/**
 * This is the Apify class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Apify
{
    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }
}
