<?php

namespace agoalofalife\Commands;

use agoalofalife\CapsuleSettings;
use agoalofalife\database\migrations\CitiesMigration;
use agoalofalife\database\migrations\CountryMigration;
use agoalofalife\database\migrations\RegionsMigration;
use agoalofalife\database\seeds\CitiesTableSeeder;
use agoalofalife\database\seeds\CountryTableSeeder;
use agoalofalife\database\seeds\RegionsTableSeeder;
use agoalofalife\ManagerMigrations;
use agoalofalife\ManagerSeeder;
use agoalofalife\Support\Local;
use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;


class InstallCommand extends Command
{
    protected $settings;

    protected function configure()
    {
        $this->setName('install')->setHelp('Sets up tables with the regions, cities and so on..');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $style = new OutputFormatterStyle('black', 'yellow', array('bold', 'blink'));
        $output->getFormatter()->setStyle('fire', $style);

        $output->writeln([
            '<fire>Hi let\'s start to do the migration!</fire>',
            '======================================'
        ]);

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please choose your database type :',
            array('mysql', 'postgres'),
            0
        );
        $question->setErrorMessage('Database %s is invalid.');
        // get type database
        $this->settings['databaseType'] = $helper->ask($input, $output, $question);

        $output->writeln('');
        $output->writeln( " You have just selected: <info>{$this->settings['databaseType']}</info>");

        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>host</info> for database , please : ", 'localhost');

        // get host
        $this->settings['host']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['host']} </info>");

        $output->writeln('');
        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>database name</info>,  please : ");

        // get name database
        $this->settings['databaseName']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['databaseName']} </info>");

        $output->writeln('');
        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>database username</info>,  please : ");

        //get username in database
        $this->settings['databaseUsername']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['databaseUsername']} </info>");

        $output->writeln('');
        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>database password</info>,  please : ");
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        // get password
        $this->settings['databasePassword']    = $helper->ask($input, $output, $question);


         $table = new Table($output);
         $table->setHeaders(array('name', 'value'))
                ->setRows(array(
                    array('Type database', $this->settings['databaseType']),
                    array('Host database', $this->settings['host']),
                    array('Name database', $this->settings['databaseName']),
                    array('Username database', $this->settings['databaseUsername'])
                ));

        $table->render();

        $helper   = $this->getHelper('question');
        $question = new ConfirmationQuestion("<question>Are you sure?? y/n</question>", false);
        // TODO check connection with database from choose parameters


        if (!$helper->ask($input, $output, $question)) {
            return;
        }
        // connection database
        $capsule = (new CapsuleSettings(new Manager()))->settings( $this->settings );
        dd(  $capsule->connection());
        $output->writeln('<info>Then go ahead!</info>');

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please select your native language :',
            array(0 => 'ru', 'en', 'ua', 'be', 'es', 'fi', 'de', 'it'),
            0
        );
        $question->setErrorMessage('Local %s is invalid.');

        // get native language
        $this->settings['localization'] = $helper->ask($input, $output, $question);
        (new Local())->setLocal($this->settings['localization']);

        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info> the country you wish to migrate</info>,  please : ");
        $output->writeln('<comment>the list of countries you can see here 3166-1 alpha-2</comment>');
        $output->writeln('<comment>you can specify multiple countries separated by commas</comment>');
        $output->writeln('<comment>example EN, RU</comment>');

        //  the list of countries that need to migrate
        $this->settings['country']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['country']} </info>");
        config(['geography.country' =>  $this->settings['country'] ]);

        $io = new SymfonyStyle($input, $output);
        $io->progressStart(3);



        // migrate table
        (new ManagerMigrations([
                new CountryMigration,
                new RegionsMigration,
                new CitiesMigration
            ]))->builder();
        $io->progressAdvance(2);

        // seed data
        (new ManagerSeeder(array(
            new CountryTableSeeder,
            new RegionsTableSeeder,
            new CitiesTableSeeder
        )))->run();

        $io->progressFinish();
        $output->writeln('<info>Successfully created all!</info>');
    }
}