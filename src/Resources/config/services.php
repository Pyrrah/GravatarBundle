<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('gravatar.api', \Pyrrah\GravatarBundle\GravatarApi::class)
        ->args([
            null, // will be filled in with size dynamically
            null, // will be filled in with rating dynamically
            null, // will be filled in with default dynamically
            null, // will be filled in with format dynamically
        ]);

        $services->set('templating.helper.gravatar', \Pyrrah\GravatarBundle\Templating\Helper\GravatarHelper::class)
            ->args([
                service('gravatar.api'),
                service('router')
            ]);

    $services->set('twig.extension.gravatar', \Pyrrah\GravatarBundle\Twig\GravatarExtension::class)
        ->tag('twig.extension', ['alias' => 'gravatar'])
        ->args([
            service('templating.helper.gravatar')
        ]);
};
