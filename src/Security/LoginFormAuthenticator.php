<?php


namespace Fortress\Folk\Security;


use Fortress\Folk\Form\LoginFormType;
use Fortress\Folk\Model\Form\LoginForm;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\RememberMeToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface, ContainerAwareInterface
{
	use TargetPathTrait;
	use ContainerAwareTrait;

	private $urlGenerator;
	private $csrfTokenManager;
	private $passwordEncoder;
	private $formFactory;
	private $tokenStorage;

	private $loginRoute;
	private $redirectRoute;

	public function __construct(UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager,
								UserPasswordEncoderInterface $passwordEncoder, FormFactoryInterface $formFactory,
								TokenStorageInterface $tokenStorage, $loginRoute, $redirectRoute)
	{
		$this->urlGenerator = $urlGenerator;
		$this->csrfTokenManager = $csrfTokenManager;
		$this->passwordEncoder = $passwordEncoder;
		$this->loginRoute = $loginRoute;
		$this->redirectRoute = $redirectRoute;
		$this->formFactory = $formFactory;
		$this->tokenStorage = $tokenStorage;
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
		$form = $this->formFactory->create(LoginFormType::class, new LoginForm());

		$form->handleRequest($request);

		if (!($form->isSubmitted() && $form->isValid()))
		{
			throw new CustomUserMessageAuthenticationException('No data found.');
		}

		$loginForm = $form->getData();

		$credentials = [
			'username' => $loginForm->getUsername(),
			'password' => $loginForm->getPassword(),
			'csrf_token' => $loginForm->getCsrfToken(),
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
		$form = $this->formFactory->create(LoginFormType::class, new LoginForm());

		$form->handleRequest($request);

		if (!($form->isSubmitted() && $form->isValid()))
		{
			throw new CustomUserMessageAuthenticationException('No data found.');
		}

		$loginForm = $form->getData();

		if ($loginForm->isRememberMe())
		{
			$rememberMeToken = new RememberMeToken(
				$token->getUser(),
				$providerKey,
				$this->container->getParameter('kernel.secret')
			);

			$this->tokenStorage->setToken($rememberMeToken);
		}

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