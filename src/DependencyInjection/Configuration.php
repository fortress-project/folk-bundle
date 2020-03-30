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
			->scalarNode('route')
			->defaultValue('app_login')
			->end()
			->end()
			->addDefaultsIfNotSet()
			->end()
			->end()
			->end()
		;

		return $treeBuilder;
	}
}