<?php


namespace Fortress\Folk\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

	/**
	 * @inheritDoc
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder('fortress_folk');

		$treeBuilder->getRootNode()
			->children()
			->arrayNode('form_login')
			->children()
			->scalarNode('target')
			->defaultValue('app_login')
			->end()
			->end()
			->addDefaultsIfNotSet()
			->end()
			->arrayNode('user_provider')
			->children()
			->enumNode('fields')
			->values(['username'])
			->end()
			->addDefaultsIfNotSet()
			->scalarNode('entity')
			->defaultValue('App\\Entity\\User')
			->end()
			->end()
			->addDefaultsIfNotSet()
			->end()
			->end()
			->end();

		return $treeBuilder;
	}
}