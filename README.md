# DoctrineRoutingBundle
With this bundle you can persist a subset of your routes inside a database using the provided entity `Route`. These routes will be cached and only updated if you clear your routing cache. This way you can manage your routes from an interface without abandoning cacheing. The bundle provides both command line and service triggering of clearing your cache.

## Installation
Composer (<a href="https://packagist.org/packages/eschmar/doctrine-routing-bundle" target="_blank">Packagist</a>):
```json
"require": {
	"eschmar/doctrine-routing-bundle": "dev-master"
},
```

app/Appkernel.php:
```yaml
new Eschmar\DoctrineRoutingBundle\EschmarDoctrineRoutingBundle(),
```

app/config/routing.yml:
```yaml
eschmar_doctrine_routing:
    resource: "@EschmarDoctrineRoutingBundle/Resources/config/routing.yml"
    prefix:   /
```

Finally you have to update your doctrine schema for creating the database table.

## Usage

Store your routes inside the provided Route entity. After updating your routes you have to invoke
```php
php app/console cache:clear:routing prod
```
or inside a controller
```php
$helper = $this->get('eschmar_doctrine_routing.helper');
$helper->clear('prod');
```
for clearing the cache.

## License

MIT License

