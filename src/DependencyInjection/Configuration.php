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
                ->integerNode('size')
                    ->info('Size in pixels')
                    ->min(1)->max(2048)
                    ->defaultValue('80')
                ->end()
                ->scalarNode('rating')
                    ->info('Maximum rating (inclusive)')
                    ->values(['g', 'pg', 'r', 'x'])
                    ->defaultValue('g')
                ->end()
                ->scalarNode('default')
                    ->info('Default imageset to use')
                    ->values(['404', 'mp', 'identicon', 'monsterid', 'wavatar'])
                    ->defaultValue('mp')
                ->end()
                ->booleanNode('secure')
                    ->info('Return an URL secure for Gravatar')
                    ->defaultTrue()
                    ->setDeprecated(
                        'pyrrah/gravatar-bundle',
                        '1.3',
                        'The "%node%" option is deprecated. Now, secure gravatar is enabled by default.'
                    )
                ->end()
            ->end();

        return $treeBuilder;
    }
}
