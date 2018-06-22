# mullings/pressme

> Note: This Assessment is a short illustration for compressing and decompressing sole text files.

**Table of contents**

* [Quickstart example](#quickstart-example)
* [Tests](#tests)
* [License](#license)
* [More](#more)

## Quickstart example

A demo of the example listed below, can be found here:

https://pressme.herokuapp.com/

```php
require __DIR__ . '/../src/pressme.php';

$pressMe = new pressme();

$compressor = $pressMe->fileCompressor('text.txt');

var_dump($compressor);
```

#### Compressor()

The following methods can be used to create a compressor instance:

```php
$compressor = $pressMe->fileCompressor('text.txt');
```

#### Decompressor()

The following methods can be used to create a decompressor instance:

```php
$decompress = $pressMe->fileDecompressor('text.1529585704.txt');
```

## Tests

To run the test suite, you first need to clone this repo and then install all
dependencies [through Github](https://getcomposer.org):

```bash
$ composer install
```

To run the test suite, go to the project root and run:

```bash
$ php vendor/bin/phpunit
```

## License

MIT