<?php

namespace Pyrrah\GravatarBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * @author Pierre-Yves Dick
 */
final class PyrrahGravatarExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $loader->load('services.php');

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('gravatar.api');
        $definition->replaceArgument(0, $config['size']);
        $definition->replaceArgument(1, $config['rating']);
        $definition->replaceArgument(2, $config['default']);
        $definition->replaceArgument(3, $config['format']);
    }
}