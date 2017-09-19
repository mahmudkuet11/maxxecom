<?php

namespace App\Service;


use Symfony\Component\Console\Output\ConsoleOutput;

class Console
{
    public static function writeln($msg){
        $console = new ConsoleOutput();
        $console->writeln($msg);
    }
}