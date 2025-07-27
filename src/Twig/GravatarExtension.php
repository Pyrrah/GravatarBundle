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

    /**
     * @return TwigFunction[]
     */
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
    public function getUrl($email, $size = null, $rating = null, $default = null, $format = null)
    {
        return $this->baseHelper->getUrl($email, $size, $rating, $default, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $format = null)
    {
        return $this->baseHelper->getUrlForHash($hash, $size, $rating, $default, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrl($email)
    {
        return $this->baseHelper->getProfileUrl($email);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrlForHash($hash)
    {
        return $this->baseHelper->getProfileUrlForHash($hash);
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
