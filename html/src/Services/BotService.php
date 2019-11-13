<?php


namespace App\Services;


use Doctrine\DBAL\Driver\Connection;
use GuzzleHttp\Client;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class BotService
{

    private $bot;

    /**
     * BotService constructor.
     * @param Connection $connection
     * @param $botApiKey
     * @param $botApiName
     * @param null $botProxy
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function __construct(Connection $connection, $botApiKey, $botApiName, $botProxy = null)
    {
        $bot = new Telegram($botApiKey, $botApiName);

        if ($botProxy) {
            Request::setClient(new Client([
                'base_uri' => 'https://api.telegram.org',
                'proxy' => $botProxy
            ]));
        }

        $bot->enableExternalMySql($connection, 'tg_');

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