<?php
namespace agoalofalife\Commands;


use Carbon\Carbon;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateLaravelCommand extends Command
{
    protected $listFileMigrations = [
        'country' => '_Acreate_table_country',
        'regions' => '_Bcreate_table_regions',
        'cities'  => '_Ccreate_table_cities'
    ];

    protected $listFilesSeeder = [
      'CountryTableSeeder' => 'CountryTableSeeder.php',
      'RegionsTableSeeder' => 'RegionsTableSeeder.php',
      'CitiesTableSeeder'  => 'CitiesTableSeeder.php'
    ];

    protected $formatterStyle;
    protected $progressBar;

    public function __construct(OutputFormatterStyle $formatterStyle, ProgressBar $bar)
    {
        parent::__construct();
        $this->formatterStyle = $formatterStyle;
        $this->progressBar    = $bar;
        $this->progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
    }

    protected function configure() : void
    {
        $this->setName('migrate:laravel')->setHelp('to migrate files to Laravel');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->getFormatter()->setStyle('fire', $this->formatterStyle);

        $output->writeln([
            '<fire>There is a migration in the project Laravel</fire>',
            ''
        ]);
        
        $this->progressBar->start();

        $this->moveMigrate( $this->progressBar );
        $this->moveSeeders( $this->progressBar );
        $this->moveConfig(  $this->progressBar );

        $this->progressBar->finish();
        $output->writeln(['']);
        $output->writeln(['<info>All successfully copied!</info>']);
    }

    protected function moveMigrate(ProgressBar $progress)
    {
        $pathToMigrationsLaravel  =  $_SERVER["PWD"] . '/database/migrations/';
        $pathToStubs              = __DIR__ . '/../database/migrations/stubs/';

        $this->createDir($pathToMigrationsLaravel);

        foreach ($this->listFileMigrations as $name => $migrate)
        {
            $fileName = $pathToMigrationsLaravel . $this->getDateNormalize() . $migrate . '.php';
            file_put_contents($fileName, $this->getContent($pathToStubs . $name));
            $progress->advance();
        }
    }

    protected function moveSeeders(ProgressBar $progress)
    {
        $pathToSeedersLaravel     =  $_SERVER["PWD"] . '/database/seeds/';
        $pathToSeed               = __DIR__ . '/../database/seeds/stubs/';

        $this->createDir($pathToSeedersLaravel);

        foreach ($this->listFilesSeeder as $name => $seed)
        {
            $fileName = $pathToSeedersLaravel . $seed;
            file_put_contents($fileName, $this->getContent($pathToSeed . $name));
            $progress->advance();
        }
    }

    protected function moveConfig(ProgressBar $progress) : void
    {
        $pathToConfig               = __DIR__ . '/../config.php';
        $pathToConfigsLaravel       =  $_SERVER["PWD"] . '/config/';
        $this->createDir($pathToConfigsLaravel);

        copy($pathToConfig,$pathToConfigsLaravel . 'geography.php' );
        $progress->advance();
    }

    /**
     * Just create directory
     * @param $dir
     */
    protected function createDir(string $dir) : void
    {
        if (is_dir($dir) === false)
        {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * Data from stubs file
     * @param $nameFile
     * @return bool|string
     */
    protected function getContent(string $nameFile) : string
    {
        return file_get_contents($nameFile);
    }

    /**
     * Get date normalize mow
     * @return mixed
     */
    protected function getDateNormalize() : string
    {
        $date = Carbon::now();
        $date = preg_replace('/-|\s/','_', $date);
        $data = preg_replace('/:/','', $date);

        return $data;
    }
}