<?php

namespace Pyrrah\GravatarBundle\Templating\Helper;

use Pyrrah\GravatarBundle\GravatarApi;
use Symfony\Component\Routing\RouterInterface;

/**
 * Symfony 2 Helper for Gravatar. Uses Bundle\GravatarBundle\GravatarApi.
 *
 * @author Thibault Duplessis
 * @author Henrik Bjornskov <henrik@bearwoods.dk>
 * @author Pierre-Yves Dick <hello@pierreyvesdick.fr>
 */
class GravatarHelper implements GravatarHelperInterface
{
    /**
     * @var Pyrrah\GravatarBundle\GravatarApi
     */
    protected $api;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * Constructor.
     *
     * @param GravatarApi $api
     * @param RouterInterface|null $router
     */
    public function __construct(GravatarApi $api, ?RouterInterface $router)
    {
        $this->api = $api;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $format = null)
    {
        return $this->api->getUrl($email, $size, $rating, $default, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $format = null)
    {
        return $this->api->getUrlForHash($hash, $size, $rating, $default, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrl($email)
    {
        return $this->api->getProfileUrl($email);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrlForHash($hash)
    {
        return $this->api->getProfileUrlForHash($hash);
    }

    public function render($email, array $options = array())
    {
        $size = isset($options['size']) ? $options['size'] : null;
        $rating = isset($options['rating']) ? $options['rating'] : null;
        $default = isset($options['default']) ? $options['default'] : null;
        $format = isset($options['format']) ? $options['format'] : null;

        return $this->api->getUrl($email, $size, $rating, $default, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function exists($email)
    {
        return $this->api->exists($email);
    }

    /**
     * Name of this Helper.
     *
     * @return string
     */
    public function getName()
    {
        return 'gravatar';
    }
}
