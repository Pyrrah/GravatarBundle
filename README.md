Pyrrah/GravatarBundle 🤳
========================

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]

Source based on [`OrnicarGravatarBundle`](https://github.com/henrikbjorn/GravatarBundle), today deprecated. This new version is compatible with Symfony 3 to 5.

Installation Symfony 4/5
------------------------

  1. Add this bundle to your projects composer.json

  ```
  composer require pyrrah/gravatar-bundle
  ```

  2. If you always have some default for your gravatars such as size, rating or default it can be configured in your config :

  ```yaml
  # config/packages/pyrrah_gravatar.yaml
    pyrrah_gravatar:
      rating: g
      size: 150
      default: mm
      secure: true
  ```

  3. Add the bundle in the file config/bundles.php (no Symfony Flex... for the moment) :

  ```php
  <?php
  
  return [
        Pyrrah\GravatarBundle\PyrrahGravatarBundle::class => ['all' => true],
  ];
  ```

Installation Symfony 3
----------------------

  1. Add this bundle to your projects composer.json

  ```json
  "require": { 
      "pyrrah/GravatarBundle" : "1.1.1^"
  }
  ```

  2. Run composer update to install the bundle and regenerate the autoloader
  
  ```bash
  $ composer update pyrrah/GravatarBundle
  ```

  3. Add this bundle to your application's kernel:

  ```php
  // application/ApplicationKernel.php
  public function registerBundles()
  {
      return array(
          // ...
          new Pyrrah\GravatarBundle\PyrrahGravatarBundle(),
          // ...
      );
  }
  ```

  4. Configure the `gravatar` service, templating helper and Twig extension in your config:

  ```yaml
  # application/config/config.yml
  pyrrah_gravatar: ~
  ```

  5. If you always have some default for your gravatars such as size, rating or default it can be configured in your config:

  ```yaml
  # application/config/config.yml
  pyrrah_gravatar:
    rating: g
    size: 80
    default: mm
  ```

Usage
-----

All you have to do is use the helper like this example:

```html
<img src="<?php echo $view['gravatar']->getUrl('alias@domain.tld') ?>" />
```

Or with parameters:

```html
<img src="<?php echo $view['gravatar']->getUrl('alias@domain.tld', '80', 'g', 'defaultimage.png', true) ?>" />
```

The only required parameter is the email adress. The rest have default values.

If you use twig you can use the helper like this example:

```
<img src="{{ gravatar('alias@domain.tld') }}" />
```

Or if you want to check if a gravatar email exists:

```
{% if gravatar_exists('alias@domain.tld') %}
  The email is an gravatar email
{% endif %}
```

Or with parameters:

```
<img src="{{ gravatar('alias@domain.tld', size, rating, default, secure) }}" />
```

For more information [look at the gravatar implementation pages][link-gravatar].

Credits
-------

- [Pierre-Yves Dick][link-author]
- [All Contributors][link-contributors]

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/pyrrah/gravatar-bundle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pyrrah/gravatar-bundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pyrrah/gravatar-bundle
[link-downloads]: https://packagist.org/packages/pyrrah/gravatar-bundle
[link-author]: https://github.com/pyrrah
[link-contributors]: ../../contributors
[link-gravatar]: http://en.gravatar.com/site/implement/