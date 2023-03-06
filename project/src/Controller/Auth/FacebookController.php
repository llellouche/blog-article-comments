<?php

namespace App\Controller\Auth;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class FacebookController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     */
    #[Route(path: '/connect/facebook', name: 'connect_facebook_start', methods: ['GET'])]
    public function facebookConnectAction(ClientRegistry $clientRegistry)
    {
        // on Symfony 3.3 or lower, $clientRegistry = $this->get('knpu.oauth2.registry');

        // will redirect to Facebook!
        return $clientRegistry
            ->getClient('facebook_main') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect([
                'public_profile', 'email' // the scopes you want to access
            ]);
    }

    /**
     * After going to Facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route(path: '/connect/facebook/check', name: 'connect_facebook_check', methods: ['GET'])]
    public function facebookConnectCheckAction(RouterInterface $router)
    {
        return new RedirectResponse($router->generate('index'));
    }
}