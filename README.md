PyrrahGravatarBundle
=====================

This bundle is based on [`OrnicarGravatarBundle`](https://github.com/henrikbjorn/GravatarBundle) for Symfony 2, today deprecated for Symfony 4.

New version is compatible with Symfony 2/3/4.

Installation Symfony 2/3
------------------------

  1. Add this bundle to your projects composer.json

  ```json
  "require": { 
      "pyrrah/GravatarBundle" : "~1.0"
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

  5. If you always have some default for your gravatars such as size, rating or default it can be configured in your config

  ```yaml
  # application/config/config.yml
  pyrrah_gravatar:
    rating: g
    size: 80
    default: mm
  ```

Installation Symfony 4
----------------------

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

For more information [look at the gravatar implementation pages][gravatar].

[gravatar]: http://en.gravatar.com/site/implement/
