<?php

namespace Pyrrah\GravatarBundle;

/**
 * Simple wrapper to the gravatar API
 * https://docs.gravatar.com/rest/getting-started/.
 *
 * Usage:
 *      \Bundle\GravatarBundle\GravatarApi::getUrl('henrik@bearwoods.dk', 80, 'g', 'mm', true);
 *
 * @author     Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author     Henrik Bjørnskov <henrik@bearwoods.dk>
 * @author     Pierre-Yves Dick <hello@pierreyvesdick.fr>
 */
class GravatarApi
{
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
     * @var string
     */
    protected $formatGravatar;

    /**
     * Constructor.
     *
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param string $format
     */
    public function __construct($size = null, $rating = null, $default = null, $format = null)
    {
        $this->sizeGravatar = $size;
        $this->ratingGravatar = $rating;
        $this->defaultGravatar = $default;
        $this->formatGravatar = $format;
    }

    /**
     * Returns a url for a gravatar.
     *
     * @param string $email
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param string $format
     *
     * @return string
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $format = null)
    {
        $hash = md5(strtolower(trim($email)));

        return $this->getUrlForHash($hash, $size, $rating, $default, $format);
    }

    /**
     * Returns a url for a gravatar for the given hash.
     *
     * @param string $hash
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param string $format
     *
     * @return string
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $format = null)
    {
        $map = array(
            's' => $size ?: $this->sizeGravatar,
            'r' => $rating ?: $this->ratingGravatar,
            'd' => $default ?: $this->defaultGravatar,
        );

        $url = 'https://secure.gravatar.com/avatar/'.$hash.'?'.http_build_query(array_filter($map));

        // If asBase64 is true, returns an encoded image instead of the url
        // If the image cannot be fetched, returns a red cross SVG image.
        $format = isset($format) ? $format : $this->formatGravatar;

        switch ($format) {
            case 'base64':
                return $this->getBase64FromUrl($url);

            case 'url':
            default:
                return $url;
        }
    }

    /**
     * Returns a url for a gravatar profile.
     *
     * @param string $email
     *
     * @return string
     */
    public function getProfileUrl($email)
    {
        $hash = md5(strtolower(trim($email)));

        return $this->getProfileUrlForHash($hash);
    }

    /**
     * Returns a url for a gravatar profile for the given hash.
     *
     * @param string $hash
     *
     * @return string
     */
    public function getProfileUrlForHash($hash)
    {
        return 'https://secure.gravatar.com/'.$hash;
    }

    /**
     * Returns a base64 encoded image from the given url.
     *
     * @param string $url
     *
     * @return string
     */
    public function getBase64FromUrl($url)
    {
        // By defaut, returns a red cross SVG image if URL is not valid or image cannot be fetched
        $defaultImg = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSJyZWQiIGQ9Ik0xOS42NiAxNy42NmwtMS40MSAxLjQxLTQuMjUtNC4yNS00LjI1IDQuMjUtMS40MS0xLjQxIDQuMjUtNC4yNS00LjI1LTQuMjUgMS40MS0xLjQxIDQuMjUgNC4yNSA0LjI1LTQuMjUgMS40MSAxLjQxLTQuMjUgNC4yNSA0LjI1IDQuMjV6Ii8+PC9zdmc+';

        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
            return $defaultImg;
        }

        $image = @file_get_contents($url);

        if ($image === false) {
            return $defaultImg;
        }

        return 'data:image/jpeg;base64,' . base64_encode($image);
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
