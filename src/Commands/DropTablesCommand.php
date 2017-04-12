<?php
namespace agoalofalife\Commands;


use agoalofalife\ManagerMigrations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class DropTablesCommand extends Command
{
    protected function configure()
    {
        $this->setName('table:drop')->setHelp('delete all tables( country, cities, regions)..');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper   = $this->getHelper('question');
        $question = new ConfirmationQuestion("<question>Are you sure?? y/n</question>", false);

        if (!$helper->ask($input, $output, $question)) {
            return;
        }
        (new ManagerMigrations())->destroyer();
        $output->writeln('<info>all databases are successfully removed!</info>');
    }
}