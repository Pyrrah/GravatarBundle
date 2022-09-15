<?php

namespace Pyrrah\GravatarBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle as BaseBundle;

class PyrrahGravatarBundle extends BaseBundle
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
