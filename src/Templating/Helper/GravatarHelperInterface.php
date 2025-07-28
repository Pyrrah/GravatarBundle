<?php

namespace Pyrrah\GravatarBundle\Templating\Helper;

interface GravatarHelperInterface
{
    /**
     * Returns a url for a gravatar.
     *
     * @param string $email
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param bool   $format
     *
     * @return string
     */
    public function getUrl($email, $size = null, $rating = null, $default = null, $format = null);

    /**
     * Returns a url for a gravatar for a given hash.
     *
     * @param string $hash
     * @param int    $size
     * @param string $rating
     * @param string $default
     * @param bool   $format
     *
     * @return string
     */
    public function getUrlForHash($hash, $size = null, $rating = null, $default = null, $format = null);

    /**
     * Returns a url for a gravatar profile.
     *
     * @param string $email
     *
     * @return string
     */
    public function getProfileUrl($email);

    /**
     * Returns a url for a gravatar profile, for the given hash.
     *
     * @param string $hash
     *
     * @return string
     */
    public function getProfileUrlForHash($hash);

    /**
     * Returns true if a avatar could be found for the email.
     *
     * @param string $email
     *
     * @return bool
     */
    public function exists($email);
}
