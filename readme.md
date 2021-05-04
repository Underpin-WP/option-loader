# Underpin Option Loader

Loader That assists setting, saving, and deleting options from a WordPress website.

## Installation

### Using Composer

`composer require underpin/option-loader`

### Manually

This plugin uses a built-in autoloader, so as long as it is required _before_
Underpin, it should work as-expected.

`require_once(__DIR__ . '/underpin-options/options.php');`

## Setup

1. Install Underpin. See [Underpin Docs](https://www.github.com/underpin-wp/underpin)
1. Register new options menus as-needed.

## Example

A very basic example could look something like this.

```php
// Register option
underpin()->options()->add( 'example-option', [
	'key'           => 'example-option', // required
	'default_value' => 'optional default option value',
	'name'          => 'Human-readable name',
	'description'   => 'Human-readable description',
] );
```

Alternatively, you can extend `Option` and reference the extended class directly, like so:

```php
underpin()->options()->add('option-key','Namespace\To\Class');
```

## Accessing Options

### Basic Example

```php
// Fetch from global context
underpin()->options()->get( 'example-option')->get();
```

### Access when object is directly accessible

```php
// Fetch, given a meta factory
$meta = underpin()->options()->get('example-meta-field');

$meta->get( $object_id );
```

### Get all registered options

```php
// Fetch all registered options

// Typecasting options gets array of registered options objects.
$registered_options = (array) underpin()->options();
$values             = [];

foreach ( $registered_options as $key => $object ) {
	$values[ $key ] = $object->get();
}
```

### Reset all registered options

```php
// Reset all options
$registered_options = (array) underpin()->options();

foreach($registered_user_meta as $object){
  $object->reset();    
}
```

### Pluck an option value from an option stored as an array

In WordPress, it is quite common to store a serialized array of options in-favor of creating multiple database records.
Because of this, Underpin has a baked-in helper method to fetch a single value from an array of options that are stored
in the database. This method makes it possible to get an option value quickly.

Given this option, where the value stored is an array:

```php
underpin()->options()->add( 'example-option', [
	'key'           => 'example-option', // required
	'default_value' => [ 'item' => 'name', 'another_item' => 'another_value' ],
	'name'          => 'Human-readable name',
	'description'   => 'Human-readable description',
] );
```

You can do this, and fetch the individual values:

```php
underpin()->options()->pluck( 'example-option', 'another_item' ); // 'another_value'
underpin()->options()->pluck( 'example-option', 'invalid' ); // WP_Error
```