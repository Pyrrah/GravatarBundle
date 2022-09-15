<?php

namespace Pyrrah\GravatarBundle;

/**
 * Simple wrapper to the gravatar API
 * http://en.gravatar.com/site/implement/url.
 *
 * Usage:
 *      \Bundle\GravatarBundle\GravatarApi::getUrl('henrik@bearwoods.dk', 80, 'g', 'mm');
 *
 * @author     Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author     Henrik Bjørnskov <henrik@bearwoods.dk>
 * @author     Pierre-Yves Dick <hello@pierreyvesdick.fr>
 */
class GravatarApi
{
    /*protected $defaults = array(
        'size'    => 80,
        'rating'  => 'g',
        'default' => null,
        'secure'  => true,
    );*/

    /**
     * @var int
     */
    protected $sizeGravatar;

    /**
     * @var string
     */
    protected $ratingGravatar;

    /**
     * @var string
     */
    protected $defaultGravatar;

    /**
     * @var bool
     */
    protected $secureGravatar;

    /**
     * Constructor.
     *
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param bool   $secure
     */
    public function __construct($size = null, $rating = null, $default = null, $secure = true)
    {
        $this->sizeGravatar = $size;
        $this->ratingGravatar = $rating;
        $this->defaultGravatar = $default;
        $this->secureGravatar = $secure;
    }

    /**
     * Returns a url for a gravatar.
     *
     * @param string $email
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param bool   $secure
     *
     * @return string
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $secure = true)
    {
        $hash = md5(strtolower(trim($email)));

        return $this->getUrlForHash($hash, $size, $rating, $default, $secure);
    }

    /**
     * Returns a url for a gravatar for the given hash.
     *
     * @param string $hash
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param bool   $secure
     *
     * @return string
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $secure = true)
    {
        $map = array(
            's' => $size ?: $this->sizeGravatar,
            'r' => $rating ?: $this->ratingGravatar,
            'd' => $default ?: $this->defaultGravatar,
        );

        $secure = isset($secure) ? $secure : $this->defaults['secure'];

        return ($secure ? 'https://secure' : 'http://www').'.gravatar.com/avatar/'.$hash.'?'.http_build_query(array_filter($map));
    }

    /**
     * Returns a url for a gravatar profile.
     *
     * @param string $email
     * @param bool   $secure
     *
     * @return string
     */
    public function getProfileUrl($email, $secure = true)
    {
        $hash = md5(strtolower(trim($email)));

        return $this->getProfileUrlForHash($hash, $secure);
    }

    /**
     * Returns a url for a gravatar profile for the given hash.
     *
     * @param string $hash
     * @param bool   $secure
     *
     * @return string
     */
    public function getProfileUrlForHash($hash, $secure = true)
    {
        $secure = $secure ?: $this->secureGravatar;

        return ($secure ? 'https://secure' : 'http://www').'.gravatar.com/'.$hash;
    }

    /**
     * Checks if a gravatar exists for the email. It does this by checking for the presence of 404 in the header
     * returned. Will return null if fsockopen fails, for example when the hostname cannot be resolved.
     *
     * @param string $email
     *
     * @return bool|null Boolean if we could connect, null if no connection to gravatar.com
     */
    public function exists($email)
    {
        $path = $this->getUrl($email, null, null, '404');

        if (!$sock = @fsockopen('gravatar.com', 80, $errorNo, $error)) {
            return;
        }

        fwrite($sock, 'HEAD '.$path." HTTP/1.0\r\n\r\n");
        $header = fgets($sock, 128);
        fclose($sock);

        return strpos($header, '404') ? false : true;
    }
}
