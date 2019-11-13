<?php

namespace App\Command;

use App\Services\BotService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TelegramUpdateCommand extends Command
{
    protected static $defaultName = 'app:telegram-update';
    protected $botService;

    public function __construct(BotService $botService, string $name = null)
    {
        $this->botService = $botService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Get new Telegram bot messages');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $serverResponses = $this->botService->getBot()->handleGetUpdates();

        $io->block(print_r($serverResponses, true));

        return 0;
    }
}
