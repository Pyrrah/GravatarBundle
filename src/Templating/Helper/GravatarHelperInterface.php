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
    public function getUrl(string $email, ?int $size = null, ?string $rating = null, ?string $default = null, ?bool $format = null): string;

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
    public function getUrlForHash(string $hash, ?int $size = null, ?string $rating = null, ?string $default = null, ?bool $format = null): string;

    /**
     * Returns a url for a gravatar profile.
     *
     * @param string $email
     *
     * @return string
     */
    public function getProfileUrl(string $email): string;

    /**
     * Returns a url for a gravatar profile, for the given hash.
     *
     * @param string $hash
     *
     * @return string
     */
    public function getProfileUrlForHash(string $hash): string;

    /**
     * Returns true if a avatar could be found for the email.
     *
     * @param string $email
     *
     * @return bool
     */
    public function exists(string $email): bool;
}