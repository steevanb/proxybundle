Composer
--------

```yml
# composer.json
{
    "require": {
        "steevanb/proxybundle": "dev-master"
    }
}
```

Add bundle to AppKernel
-----------------------

```php
# app/appKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new steevanb\ProxyBundle\ProxyBundle()
        );
    }
}
```

Add routings
------------

```yml
# app/config/routing.yml
proxy:
    resource: "@ProxyBundle/Resources/config/routing.yml"
    prefix: /
```

[Back to index](../../README.md)