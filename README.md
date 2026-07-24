Pyrrah/GravatarBundle 🤳
========================

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Contributors][ico-contributors]][link-contributors]
[![Total Downloads][ico-downloads]][link-downloads]

This bundle allows you to display your avatar anywhere on your site, via the Gravatar service.

Requirements
------------

* Symfony 7.4 and 8.x
* PHP 8.4 or higher
* A [Gravatar account][link-gravatar-signup] - it's free!

Installation
------------

  1. To install this bundle, run the following [Composer](https://getcomposer.org/) command :

  ```
  composer require pyrrah/gravatar-bundle
  ```

  2. If you always have some default for your gravatars such as size, rating, default image, or format, it can be configured in your config:

  ```yaml
  # config/packages/pyrrah_gravatar.yaml
  pyrrah_gravatar:
    rating: "g"      # Allowed values: g, pg, r, x
    size: 80         # Image size in pixels
    default: "mp"   # Default image type (e.g. mp, identicon, monsterid, wavatar, retro, robohash, blank, 404)
    format: "base64" # Output format: url or base64
  ```

> [!NOTE]
> The format option is specific to the bundle to choose the output format :
>  * url (default) : returns the https URL of the Gravatar image
>  * base64 : returns a base64-formatted image generated from the Gravatar URL
>
> By using the "base64" option, you hide from your users the email hash used in the Gravatar URL.

Usage
-----

All you have to do is use the helper like this example:

```twig
<img src="{{ gravatar('alias@domain.tld') }}" />
```

Or if you want to check if a gravatar email exists:

```twig
{% if gravatar_exists('alias@domain.tld') %}
  The email is an gravatar email
{% endif %}
```

Or with parameters (including default):

```
<img src="{{ gravatar('alias@domain.tld', size, rating, default, format) }}" />
```

Where:
- `size` (int): Image size in pixels
- `rating` (string): Allowed values: g, pg, r, x
- `default` (string): Default image type (e.g. mp, identicon, monsterid, wavatar, retro, robohash, blank, 404)
- `format` (string): Output format: url or base64

For more information [look at the gravatar implementation pages][link-gravatar-implement].

Credits
-------

- [Pierre-Yves Dick][link-author]
- [All Contributors][link-contributors]

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/pyrrah/gravatar-bundle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-contributors]: https://img.shields.io/github/contributors/Pyrrah/GravatarBundle?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pyrrah/gravatar-bundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pyrrah/gravatar-bundle
[link-downloads]: https://packagist.org/packages/pyrrah/gravatar-bundle
[link-author]: https://github.com/Pyrrah
[link-contributors]: ../../contributors
[link-gravatar-signup]: https://www.gravatar.com/site/signup
[link-gravatar-implement]: https://docs.gravatar.com/gravatar-images/php/
