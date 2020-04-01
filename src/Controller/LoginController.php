<?php


namespace Fortress\Folk\Controller;


use \RuntimeException;
use Fortress\Folk\Form\LoginFormType;
use Fortress\Folk\Model\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
	public function login(CsrfTokenManagerInterface $csrfTokenManager, AuthenticationUtils $authenticationUtils):
	Response
	{
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		$loginForm = new LoginForm();
		$loginForm->setUsername($lastUsername);
		$loginForm->setCsrfToken($csrfTokenManager->getToken('authenticate'));

		$form = $this->createForm(LoginFormType::class, $loginForm);

		return $this->render('@FortressFolk/login/login.html.twig', [
			'form' => $form->createView(),
			'error' => $error
		]);
	}

	public function logout() {
		throw new RuntimeException('Your logout route is not configured!');
	}
}