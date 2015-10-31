Whats the purpose of this project?
------------------

Using this library you can create Bootstrap's HTML markup easily using PHP.

Features
------------------

 * Bootstrap 3 support
 * Nest components in object-oriented way 
 * Extend the bootstrap components with custom styles
 * Form validation
 * Wizard comonent with dependant Forms

Quick start
------------------

Add the [composer](https://getcomposer.org/) dependency:

```
"require": {
   "phpstrap/phpstrap": "1.*"
}
```

Issuea a composer install o composer update if you already have composer installed for your project.

Include de composer autoload directive:

```php
require_once __DIR__ . '/vendor/autoload.php';
```

Include Bootstrap's CSS+JS in your PHP, for example with the CDN:

```html
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" >
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
```

And start producing the HTML markup:

```php
use PHPStrap\Panel;
$ExamplePanel = new Panel();
$ExamplePanel->addHeader("Example panel");
$ExamplePanel->addContent("My content");
echo $ExamplePanel;
```

Clone and run example
------------------

```
git clone https://github.com/kktuax/PHPStrap.git
cd PHPStrap/examples
composer install
```

Deploy the examples folder to your PHP-enabled server, an open your browser:

(http://localhost/PHPStrap/examples/example.php)

[![API DOCS](http://apigenerator.org/badge.png)](http://kktuax.github.io/PHPStrap/)





