<?php

namespace Pyrrah\GravatarBundle;

use Pyrrah\GravatarBundle\DependencyInjection\PyrrahGravatarExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PyrrahGravatarBundle extends Bundle
{
    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new PyrrahGravatarExtension();
        }
        return $this->extension;
    }
}
