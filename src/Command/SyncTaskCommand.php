<?php

namespace App\Command;

use App\Factory\ProviderFactory;
use App\Message\SyncTask;
use App\Provider\Provider1;
use App\Provider\Provider2;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class SyncTaskCommand extends Command
{
    protected static $defaultName = 'task:sync';

    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct();

        $this->bus = $bus;
    }

    protected function configure()
    {
        $this->setDescription('Sync Task Command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->bus->dispatch(new SyncTask(new ProviderFactory(new Provider1())));

        $this->bus->dispatch(new SyncTask(new ProviderFactory(new Provider2())));

        $io->success("Success");

        return 0;
    }
}
