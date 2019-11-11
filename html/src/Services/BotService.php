<?php


namespace App\Services;


use Doctrine\DBAL\Driver\Connection;
use Longman\TelegramBot\Telegram;

class BotService
{

    private $bot;

    public function __construct(Connection $connection, $botApiKey, $botApiName)
    {
        $bot = new Telegram($botApiKey, $botApiName);
        $bot->enableExternalMySql($connection);

        $this->bot = $bot;
    }

    /**
     * @return Telegram
     */
    public function getBot(): Telegram
    {
        return $this->bot;
    }

}