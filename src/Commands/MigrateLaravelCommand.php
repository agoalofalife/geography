<?php
namespace agoalofalife\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateLaravelCommand extends Command
{
    protected function configure()
    {
        $this->setName('migrate:laravel')->setHelp('to migrate files to Laravel');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}