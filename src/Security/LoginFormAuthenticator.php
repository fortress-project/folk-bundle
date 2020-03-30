<?php


namespace Fortress\Folk\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
	use TargetPathTrait;

	private $urlGenerator;
	private $csrfTokenManager;
	private $passwordEncoder;

	private $loginRoute;
	private $redirectRoute;

	public function __construct(UrlGenerator $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager,
								UserPasswordEncoderInterface $passwordEncoder, $loginRoute, $redirectRoute)
	{
		$this->urlGenerator = $urlGenerator;
		$this->csrfTokenManager = $csrfTokenManager;
		$this->passwordEncoder = $passwordEncoder;
		$this->loginRoute = $loginRoute;
		$this->redirectRoute = $redirectRoute;
	}

	/**
	 * @inheritDoc
	 */
	public function supports(Request $request)
	{
		return $this->loginRoute === $request->attributes->get('_route') && $request->isMethod('POST');
	}

	/**
	 * @inheritDoc
	 */
	public function getCredentials(Request $request)
	{
		$credentials = [
			'username' => $request->request->get('username'),
			'password' => $request->request->get('password'),
			'csrf_token' => $request->request->get('_csrf_token'),
		];

		$request->getSession()->set(
			Security::LAST_USERNAME,
			$credentials['username']
		);

		return $credentials;
	}

	/**
	 * @inheritDoc
	 */
	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		$token = new CsrfToken('authenticate', $credentials['csrf_token']);
		if (!$this->csrfTokenManager->isTokenValid($token))
			throw new InvalidCsrfTokenException();

		return $userProvider->loadUserByUsername($credentials['username']);
	}

	/**
	 * @inheritDoc
	 */
	public function checkCredentials($credentials, UserInterface $user)
	{
		return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
	}

	/**
	 * @inheritDoc
	 */
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
	{
		if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
			return new RedirectResponse($targetPath);
		}

		return new RedirectResponse($this->urlGenerator->generate($this->redirectRoute));
	}

	/**
	 * @inheritDoc
	 */
	protected function getLoginUrl()
	{
		return $this->urlGenerator->generate($this->loginRoute);
	}

	/**
	 * @inheritDoc
	 */
	public function getPassword($credentials): ?string
	{
		return $credentials['password'];
	}
}