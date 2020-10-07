<?php

namespace App\Security;

use ApiPlatform\Core\Api\IriConverterInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LoginAuthenticator extends AbstractGuardAuthenticator
{
    protected UserRepository $userRepository;
    protected RouterInterface $router;
    protected UserPasswordEncoderInterface $passwordEncoder;
    protected IriConverterInterface $iriConverter;

    public function __construct(
        UserRepository $userRepository,
        RouterInterface $router,
        UserPasswordEncoderInterface $passwordEncoder,
        IriConverterInterface $iriConverter
    ) {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->iriConverter = $iriConverter;
    }

    public function supports(Request $request): bool
    {
        return $request->isMethod('POST')
            && 'login' === $request->attributes->get('_route');
    }

    public function getCredentials(Request $request): array
    {
        return [
            'username'   => $request->request->get('username'),
            'password'   => $request->request->get('password'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?User
    {
        return $this->userRepository->findOneBy(['username' => $credentials['username']]);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): Response
    {
        return new Response(null, 204, [
            'Location' => $this->iriConverter->getIriFromItem($token->getUser()),
        ]);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessageKey()], Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null): JsonResponse
    {
        return new JsonResponse(['error' => $authException->getMessageKey()], Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return true;
    }
}
