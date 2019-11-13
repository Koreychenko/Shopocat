<?php

namespace App\Controller;

use App\Services\BotService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController extends AbstractController
{
    /**
     * @Route("/webhook", name="webhook")
     */
    public function index(BotService $botService)
    {
        $serverResponses = $botService->getBot()->handle();
        return $this->json([
            'message' => $serverResponses,
            'path' => 'src/Controller/WebhookController.php',
        ]);
    }
}
