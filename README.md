# Collection

Base class for working with collections of things.

[![Build Status](https://travis-ci.org/werx/collections.png?branch=master)](https://travis-ci.org/werx/collections) [![Total Downloads](https://poser.pugx.org/werx/collections/downloads.png)](https://packagist.org/packages/werx/collections) [![Latest Stable Version](https://poser.pugx.org/werx/collections/v/stable.png)](https://packagist.org/packages/werx/collections)

## Usage
You can either create instances of the Collection object...

```php
$foo = new \werx\Collections\Collection;
```

Or create a class that extends it.

```php
class Foo extends \werx\Collections\Collection
{

}

$foo = new Foo();
```

### Fill the collection in the constructor.
```php
$foo = new new \werx\Collections\Collection(['foo' => 'Foo', 'bar' => 'bar']);
```

### Add multiple items to collection by passing an array to the `set()` method.
```php
$foo = new Foo();
$foo->set(['foo' => 'Foo', 'bar' => 'bar']);
```

### How many items in the collection?
```php
var_dump($foo->count());
# OR
var_dump(count($foo)); // The Collection class implements the Countable() interface.
// 2
```

### Does the collection have a key named 'foo'? (yes)
```php
var_dump($foo->has('foo'));
// true
```

### Does the collection have a key named 'x'? (no)
``` php
var_dump($foo->has('x'));
// false
```

### Get the value of the key named 'foo' from the collection.
``` php
var_dump($foo->get('foo'));
// Foo
```

### Return default null if key doesn't exist.
``` php
var_dump($foo->get('x'));
// null
```
### Set a different default value if key doesn't exist.
``` php
var_dump($foo->get('x', 'no'));
// no
```

### Set a key/value.
``` php
$foo->set('name', 'Josh');
```

### Add an item to the collection without a specific key.
``` php
$foo->add('Josh');
```

### Add an array to the collection without a specific key.
``` php
$foo->add(['name' => 'Josh', 'location' => 'Arkansas']);
```

### Remove a key from the collection.
``` php
$foo->remove('name');
```

### Get all keys in the collection.
``` php
$foo->all();
```

### OR
``` php
$foo->toArray();
```

### Convert the collection to json.
``` php
var_dump($foo->toJson());
// {"foo":"Foo","bar":"Bar"}
```

### Casting the collection to a string will also return json.
``` php
var_dump((string) $foo);
// {"foo":"Foo","bar":"Bar"}
```

### Empty the collection.
``` php
$foo->clear();
```

## Installation
Installation of this package is easy with Composer. If you aren't familiar with the Composer Dependency Manager for PHP, [you should read this first](https://getcomposer.org/doc/00-intro.md).

### composer.json
``` json
"require": {
	"werx/collections": "dev-master"
}
```

## Contributing

### Unit Testing

	$ vendor/bin/phpunit

### Coding Standards
This library uses [PHP_CodeSniffer](http://www.squizlabs.com/php-codesniffer) to ensure coding standards are followed.

I have adopted the [PHP FIG PSR-2 Coding Standard](http://www.php-fig.org/psr/psr-2/) EXCEPT for the tabs vs spaces for indentation rule. PSR-2 says 4 spaces. I use tabs. No discussion.

To support indenting with tabs, I've defined a custom PSR-2 ruleset that extends the standard [PSR-2 ruleset used by PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/blob/master/CodeSniffer/Standards/PSR2/ruleset.xml). You can find this ruleset in the root of this project at PSR2Tabs.xml

Executing the codesniffer command from the root of this project to run the sniffer using these custom rules.


	$ ./codesniffer
