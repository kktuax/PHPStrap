<?php
require_once __DIR__ . '/vendor/autoload.php';
use PHPStrap\ListGroup;
use PHPStrap\Panel;
use PHPStrap\Row;
use PHPStrap\Well;
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHPStrap Demo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>PHPStrap Demo</h1>
<h2>Quick start</h2>
<h3>Include PHPStrap in your project</h3>
<div>For example, using composer, simply add the dependency:
<pre>"require": {
   "phpstrap/phpstrap": "1.*"
}</pre>
And fetch the library:
<pre>composer update</pre>
</div>
<h3>Create a PHP file with PHPStrap+Bootrstrap</h3>
<div>
If you are using composer, PHPStrap will be loaded along with the rest of the dependencies
<pre>require_once __DIR__ . '/vendor/autoload.php';</pre>
</div>
<div>
Next add the Bootrstrap CSS+JS, for example, using the CDN:
<pre>
&lt;head&gt;
   &lt;link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"&gt;
   &lt;link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"&gt;
   &lt;script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"&gt;&lt;/script&gt;
   &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
&lt;/head&gt;
</pre>
</div>
<h2>Ready to use components</h2>
<h3>Panel</h3>
<pre>
$ExamplePanel = new Panel();
$ExamplePanel->addHeader("Example panel");
$ExamplePanel->addContent("My content");
echo $ExamplePanel;
</pre>
<?php
$ExamplePanel = new Panel();
$ExamplePanel->addHeader("Example panel");
$ExamplePanel->addContent("My content");
echo $ExamplePanel;
?>
<h3>ListGroup</h3>
<pre>
$ExampleListGroup = new ListGroup();
$ExampleListGroup->addItem("First item");
$ExampleListGroup->addItem("Active item", TRUE);
$ExampleListGroup->addLink("Linked item", "https://github.com/kktuax/PHPStrap");
echo $ExampleListGroup;
</pre>
<?php
$ExampleListGroup = new ListGroup();
$ExampleListGroup->addItem("First item");
$ExampleListGroup->addItem("Active item", TRUE);
$ExampleListGroup->addLink("Linked item", "https://github.com/kktuax/PHPStrap");
echo $ExampleListGroup;
?>
<h3>Grid system and composing components</h3>
<pre>
$Row = new Row();
$Row->addColumn($ExampleListGroup);
$Row->addColumn($ExamplePanel);
echo new Well($Row);
</pre>
<?php
$Row = new Row();
$Row->addColumn($ExampleListGroup);
$Row->addColumn($ExamplePanel);
echo new Well($Row);
?>
</body>
</html>