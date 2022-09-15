<?php

namespace Pyrrah\GravatarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('pyrrah_gravatar');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC for symfony/config < 4.2
            $rootNode = $treeBuilder->root('pyrrah_gravatar');
        }

        $rootNode
            ->children()
                ->integerNode('size')->defaultValue('80')->info('Size in pixels [ 1 - 2048 ]')->end()
                ->scalarNode('rating')->defaultValue('g')->info('Maximum rating (inclusive) [ g | pg | r | x ]')->end()
                ->scalarNode('default')->defaultValue('mp')->info('Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]')->end()
                ->booleanNode('secure')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
