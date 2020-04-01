<?php


namespace Fortress\Folk\DependencyInjection;


use Exception;
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

		$loginFormAuthenticator = $container->getDefinition('fortress.folk.authenticator.login_form');
		$loginFormAuthenticator->replaceArgument('$redirectRoute', $config['form_login']['redirect_route']);

		$loginFormAuthenticator = $container->getDefinition('fortress.folk.user_provider.default');
		$loginFormAuthenticator->replaceArgument('$fields', $config['user_provider']['fields']);
		$loginFormAuthenticator->replaceArgument('$userClass', $config['user_provider']['entity']);
	}
}