<?php
# src/Security/FacebookAuthenticator.php
namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ApiAuthenticator extends AbstractAuthenticator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request): ?bool
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        // TODO Fix bug : Here header "Authentication" is always null (but "auth" key works)
        $tokenHeader = $request->headers->get('auth');
        $accessToken = str_replace('Bearer ', '', $tokenHeader);

        /*
         * For all forms POST PUT
         * Robot protection : Here we check that first %second = value
         * If not we return error
         */
        if ($request->getMethod() === Request::METHOD_POST
        || $request->getMethod() === Request::METHOD_PUT) {
            $firstNumber  = $request->headers->get('first');
            $secondNumber = $request->headers->get('second');
            $result       = $request->headers->get('value');

            if (! $firstNumber || ! $secondNumber || ! $result || $result != $firstNumber % $secondNumber) {
                return new SelfValidatingPassport(
                    new UserBadge($accessToken, function () use ($accessToken) {
                        return null;
                    })
                );
            }
        }
        return new SelfValidatingPassport(
            new UserBadge($accessToken, function () use ($accessToken) {
                return $this->entityManager->getRepository(User::class)->findOneByToken($accessToken);
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());
        $jsonResponse = ['error' => $message];

        return new Response(json_encode($jsonResponse), Response::HTTP_FORBIDDEN);
    }
}