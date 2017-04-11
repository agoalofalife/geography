<?php

namespace agoalofalife\Commands;

use agoalofalife\CapsuleSettings;
use agoalofalife\Migrations\CountryMigration;
use agoalofalife\Support\Config;
use agoalofalife\Support\Local;
use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;


class InstallCommand extends Command
{
    protected $settings;

    protected function configure()
    {
        $this->setName('install')->setHelp('Sets up tables with the regions, cities and so on..');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = new Config();
        $output->writeln([
            'Hi let\'s start to do the migration!',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please choose your database type :',
            array('mysql', 'postgres'),
            0
        );
        $question->setErrorMessage('Database %s is invalid.');

        $this->settings['databaseType'] = $helper->ask($input, $output, $question);

        $output->writeln('');
        $output->writeln( " You have just selected: <info>{$this->settings['databaseType']}</info>");

        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>host</info> for database , please : ", 'localhost');

        $this->settings['host']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['host']} </info>");

        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>database name</info>,  please : ");

        $this->settings['databaseName']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['databaseName']} </info>");


        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>database username</info>,  please : ");

        $this->settings['databaseUsername']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['databaseUsername']} </info>");

        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info>database password</info>,  please : ");
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        $this->settings['databasePassword']    = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['databasePassword']} </info>");

        $table = new Table($output);
        $table->setHeaders(array('name', 'value'))
            ->setRows(array(
                array('Type database', $this->settings['databaseType']),
                array('Host database', $this->settings['host']),
                array('Name database', $this->settings['databaseName']),
                array('Username database', $this->settings['databaseUsername'])
            ))
        ;
        $table->render();

        $helper   = $this->getHelper('question');
        $question = new ConfirmationQuestion("<question>Are you sure?? y/n</question>", false);

        if (!$helper->ask($input, $output, $question)) {
            return;
        }

        $output->writeln('<info>Then go ahead!</info>');

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Please choose local :',
            array(0 => 'ru', 'en', 'ua', 'be', 'es', 'fi', 'de', 'it'),
            0
        );
        $question->setErrorMessage('Local %s is invalid.');

        $this->settings['localization'] = $helper->ask($input, $output, $question);

        (new Local($config))->setLocal($this->settings['localization']);

        $helper   = $this->getHelper('question');
        $question = new Question("Enter <info> the country you wish to migrate</info>,  please : ");
        $output->writeln('<comment>the list of countries you can see here 3166-1 alpha-2</comment>');
        $output->writeln('<comment>example EN, RU</comment>');

        $this->settings['country']     = $helper->ask($input, $output, $question);
        $output->writeln( " You have just selected: <info>{$this->settings['country']} </info>");
        $config->set('geography.country=' . $this->settings['country'] );

//        (new CapsuleSettings(new Manager()))->settings( $this->settings );
//        (new CountryMigration())->execute();
    }
}