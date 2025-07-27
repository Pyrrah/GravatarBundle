<?php

namespace Pyrrah\GravatarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('pyrrah_gravatar');

        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                // Size in pixels
                ->integerNode('size')
                    ->min(1)->max(2048)
                    ->defaultValue('80')
                ->end()

                // Maximum rating (inclusive)
                ->enumNode('rating')
                    ->values(['g', 'pg', 'r', 'x'])
                    ->defaultValue('g')
                ->end()

                // Default imageset to use (mm deprecated, kept for oldest versions)
                ->enumNode('default')
                    ->values(['404', 'mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'mm'])
                    ->defaultValue('mp')
                ->end()

                // Default format to return to the user (gravatar URL or base64 image)
                ->enumNode('format')
                    ->values(['url', 'base64'])
                    ->defaultValue('url')
                ->end()

                // [Deprecated] Return an URL secure for Gravatar
                ->booleanNode('secure')
                    ->defaultTrue()
                    ->setDeprecated('pyrrah/gravatar-bundle','1.3')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
