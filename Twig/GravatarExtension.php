<?php

namespace Pyrrah\GravatarBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Pyrrah\GravatarBundle\Templating\Helper\GravatarHelperInterface;

/**
 * @author Thibault Duplessis
 * @author Henrik Bjornskov   <hb@peytz.dk>
 * @author Pierre-Yves Dick <hello@pierreyvesdick.fr>
 */
class GravatarExtension extends AbstractExtension implements GravatarHelperInterface
{
    /**
     * @var GravatarHelperInterface
     */
    protected $baseHelper;

    /**
     * @param GravatarHelperInterface $helper
     */
    public function __construct(GravatarHelperInterface $helper)
    {
        $this->baseHelper = $helper;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('gravatar', array($this, 'getUrl')),
            new TwigFunction('gravatar_hash', array($this, 'getUrlForHash')),
            new TwigFunction('gravatar_profile', array($this, 'getProfileUrl')),
            new TwigFunction('gravatar_profile_hash', array($this, 'getProfileUrlForHash')),
            new TwigFunction('gravatar_exists', array($this, 'exists')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $secure = true)
    {
        return $this->baseHelper->getUrl($email, $size, $rating, $default, $secure);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $secure = true)
    {
        return $this->baseHelper->getUrlForHash($hash, $size, $rating, $default, $secure);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrl($email, $secure = true)
    {
        return $this->baseHelper->getProfileUrl($email, $secure);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrlForHash($hash, $secure = true)
    {
        return $this->baseHelper->getProfileUrlForHash($hash, $secure);
    }

    /**
     * {@inheritdoc}
     */
    public function exists($email)
    {
        return $this->baseHelper->exists($email);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pyrrah_gravatar';
    }
}
