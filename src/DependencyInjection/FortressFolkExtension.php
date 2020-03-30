<?php


namespace Fortress\Folk\DependencyInjection;


use Exception;
use Fortress\Folk\Security\LoginFormAuthenticator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class FortressFolkExtension extends Extension
{

	/**
	 * @inheritDoc
	 * @throws Exception
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		$loader->load('services.yaml');

		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		$loginFormAuthenticator = $container->getDefinition(LoginFormAuthenticator::class);
		$loginFormAuthenticator->replaceArgument("route", $config["form_login"]["route"]);
	}
}