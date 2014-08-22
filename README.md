# Image Parser

*CAUTION: currently WIP*

Extensible Image Parser to find all Image tags in a string.

- You can add multiple Parser to find img tags or video tags to f.e resolve youtube thumbs.
- You can add own XPath to the DomCrawlerParser.
- You can define custom Parsers.
- You can add multiple Filter to filter the found Images.
- You can define custom Filter.
- You can resolve relative image pathes with a given basePath.

## Install

Via Composer

``` json
{
    "require": {
        "ivoba/image-parser": "dev-master"
    }
}
```


## Usage

``` php
$parser = [new DomCrawlerParser()];
$filter = [];
$basePath = 'http://domain.com';
$imageParser = new ImageParser($parser, $filter, $basePath);
$images = $imageParser->findImages(file_get_contents($file));

```


## Testing

``` bash
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](https://github.com/ivoba/image-parser/blob/master/CONTRIBUTING.md) for details.


## Credits

- Ivo Bathke(https://github.com/ivoba)


## License

The MIT License (MIT). Please see [License File](https://github.com/ivoba/image-parser/blob/master/LICENSE) for more information.
