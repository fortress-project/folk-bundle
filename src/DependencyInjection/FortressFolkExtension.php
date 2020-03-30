<?php


namespace Fortress\Folk\DependencyInjection;


use Fortress\Folk\Security\LoginFormAuthenticator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class FortressFolkExtension extends Extension
{

	/**
	 * @inheritDoc
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		$loginFormAuthenticator = $container->getDefinition(LoginFormAuthenticator::class);
		$loginFormAuthenticator->replaceArgument("route", $config["form_login"]["route"]);
	}
}