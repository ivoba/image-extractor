# Image Extractor

[![Build Status](https://secure.travis-ci.org/ivoba/image-extractor.png?branch=master)](http://travis-ci.org/ivoba/image-extractor)
[![Total Downloads](https://poser.pugx.org/ivoba/image-extractor/downloads.png)](https://packagist.org/packages/ivoba/image-extractor)

Extensible Image Extractor to find all Image tags in a string.
The library uses the symfony DomCrawler as base of extraction.

- You can add multiple Extractors to find img tags or video tags to f.e resolve youtube thumbs.
- You can add own XPath expressions to ImageXPathExtractor.
- You can define custom & additional Extractors.
- You can add multiple Filter to filter the found Images.
- You can define custom Filter.
- You can resolve relative image pathes with a FixRelativePathFilter.

As extractor a ImageXPathExtractor gets shipped, which fetches all img tags.

These filters are provided:

 - a StrPosFilter which filters images that contain one of the given filter strings.
 - a FixRelativePathFilter that adds a basePath to all relative image paths.

## Install

Via Composer

``` json
{
    "require": {
        "ivoba/image-extractor": "dev-master"
    }
}
```


## Usage

``` php
$extractorList = [new ImageXPathExtractor()];
$filter = [];
$imageExtractor = new ImageExtractor($extractorList, $filter);
$images = $imageExtractor->findImages(file_get_contents($file));
```


## Testing

``` bash
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](https://github.com/ivoba/image-extractor/blob/master/CONTRIBUTING.md) for details.


## Credits

- Ivo Bathke(https://github.com/ivoba)


## License

The MIT License (MIT). Please see [License File](https://github.com/ivoba/image-extractor/blob/master/LICENSE) for more information.
