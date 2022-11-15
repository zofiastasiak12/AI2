<?php
namespace App\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\WeatherUtil;
use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;

#[AsCommand(
    name: 'app:GetById',
    description: 'Add a short description for your command',

)]

class GetByIdCommand extends Command

{

    private WeatherUtil $weatherUtil;

    private LocationRepository $locationRepository;

    private MeasurementRepository $measurementRepository;



    public function __construct(WeatherUtil $weatherUtil, LocationRepository $locationRepository, MeasurementRepository $measurementRepository)

    {

        $this->weatherUtil = $weatherUtil;

        $this->locationRepository = $locationRepository;

        $this->measurementRepository = $measurementRepository;



        parent::__construct();

    }

protected function configure(): void

    {

        $this->addArgument('id', InputArgument::REQUIRED, 'id');

    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');
        if ($id) {
            $result = $this->weatherUtil->getWeatherForLocation($id);
            $output->writeln("{$result[0]->getLocation()}, {$result[0]->getCelsius()}C, {$result[0]->getHumidity()}%,{$result[0]->getWind()}");
        }
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');



        return Command::SUCCESS;

    }
    }