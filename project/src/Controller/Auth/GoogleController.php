<?php

namespace App\Controller\Auth;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class GoogleController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     */
    #[Route(path: '/connect/google', name: 'connect_google_start', methods: ['GET'])]
    public function googleConnectAction(ClientRegistry $clientRegistry)
    {
        // on Symfony 3.3 or lower, $clientRegistry = $this->get('knpu.oauth2.registry');

        // will redirect to Facebook!
        return $clientRegistry
            ->getClient('google') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect();
    }

    /**
     * After going to Google, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route(path: '/connect/google/check', name: 'connect_google_check', methods: ['GET'])]
    public function connectCheckAction(RouterInterface $router)
    {
        return new RedirectResponse($router->generate('index'));
    }
}