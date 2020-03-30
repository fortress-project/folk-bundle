<?php


namespace Fortress\Folk\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{
	private $urlGenerator;
	private $csrfTokenManager;
	private $passwordEncoder;

	private $route;

	public function __construct(UrlGenerator $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager,
								PasswordEncoderInterface $passwordEncoder, $route)
	{
		$this->urlGenerator = $urlGenerator;
		$this->csrfTokenManager = $csrfTokenManager;
		$this->passwordEncoder = $passwordEncoder;
		$this->route = $route;
	}

	/**
	 * @inheritDoc
	 */
	public function start(Request $request, AuthenticationException $authException = null)
	{
		// TODO: Implement start() method.
	}

	/**
	 * @inheritDoc
	 */
	public function supports(Request $request)
	{
		// TODO: Implement supports() method.
	}

	/**
	 * @inheritDoc
	 */
	public function getCredentials(Request $request)
	{
		// TODO: Implement getCredentials() method.
	}

	/**
	 * @inheritDoc
	 */
	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		// TODO: Implement getUser() method.
	}

	/**
	 * @inheritDoc
	 */
	public function checkCredentials($credentials, UserInterface $user)
	{
		// TODO: Implement checkCredentials() method.
	}

	/**
	 * @inheritDoc
	 */
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
		// TODO: Implement onAuthenticationFailure() method.
	}

	/**
	 * @inheritDoc
	 */
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
	{
		// TODO: Implement onAuthenticationSuccess() method.
	}

	/**
	 * @inheritDoc
	 */
	public function supportsRememberMe()
	{
		// TODO: Implement supportsRememberMe() method.
	}
}