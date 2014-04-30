# Collection

Base class for working with collections of things.

[![Build Status](https://travis-ci.org/werx/collections.png?branch=master)](https://travis-ci.org/werx/collections) [![Total Downloads](https://poser.pugx.org/werx/collections/downloads.png)](https://packagist.org/packages/werx/collections) [![Latest Stable Version](https://poser.pugx.org/werx/collections/v/stable.png)](https://packagist.org/packages/werx/collections)


```php
class Foo extends \werx\Collections\Collection
{

}

// Fill the collection in the constructor.
$foo = new Foo(['foo' => 'Foo', 'bar' => 'bar']);

// Fill the collection with the `fill()` method.
$foo = new Foo();
$foo->fill(['foo' => 'Foo', 'bar' => 'bar']);

// How many items in the collection?
var_dump($foo->count());
// 2

// Does the collection have a key named 'foo'? (yes)
var_dump($foo->has('foo'));
// true

// Does the collection have a key named 'foo'? (no)
var_dump($foo->has('x'));
// false

// Get the value of the key named 'foo' from the collection.
var_dump($foo->get('foo'));
// Foo

// Return default null if key doesn't exist.
var_dump($foo->get('x'));
// null

// Set a different default value if key doesn't exist.
var_dump($foo->get('x', 'no'));
// no

// Set a key/value.
$foo->set('name', 'Josh');

// Remove a key from the collection.
$foo->remove('name');

// Get all keys in the collection
$foo->all();
// or 
$foo->toArray();

// Convert the collection to json.
var_dump($foo->toJson());
//{"foo":"Foo","bar":"Bar"}

// Casting the collection to a string will also return json.
var_dump((string) $foo);
//{"foo":"Foo","bar":"Bar"}

// Empty the collection.
$foo->clear();


```

## Installation
Installation of this package is easy with Composer. If you aren't familiar with the Composer Dependency Manager for PHP, [you should read this first](https://getcomposer.org/doc/00-intro.md).

If you don't already have [Composer](https://getcomposer.org) installed (either globally or in your project), you can install it like this:

	$ curl -sS https://getcomposer.org/installer | php

Create a file named composer.json somewhere in your project with the following content:

``` json
{
	"require": {
		"werx/collections": "dev-master"
	}
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
