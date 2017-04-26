<?php

namespace UI\AppBundle\Controller\Monitor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PingController
 * @package Infrastructure\AppBundle\Controller\Monitor
 */
class PingController extends Controller
{
    /**
     * @Route("/ping", name="homepage")
     * @return JsonResponse
     */
    public function getAction()
    {
        return new JsonResponse('pong');
    }
}
