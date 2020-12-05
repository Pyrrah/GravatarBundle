<?php

namespace Pyrrah\GravatarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('pyrrah_gravatar');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('pyrrah_gravatar');
        }

        $rootNode
                ->children()
                    ->scalarNode('size')->defaultValue('80')->end()
                    ->scalarNode('rating')->defaultValue('g')->end()
                    ->scalarNode('default')->defaultValue('mm')->end()
                    ->booleanNode('secure')->defaultFalse()->end()
                ->end();

        return $treeBuilder;
    }
}
