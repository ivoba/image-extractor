# Image Extractor

*CAUTION: currently WIP*

Extensible Image Extractor to find all Image tags in a string.

- You can add multiple Extractors to find img tags or video tags to f.e resolve youtube thumbs.
- You can add own XPath expressions to ImageXPathExtractor.
- You can define custom & additional Extractors.
- You can add multiple Filter to filter the found Images.
- You can define custom Filter.
- You can resolve relative image pathes with a FixRelativePathFilter.

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
$this->assertEquals($image, $images[0]->getSrc());

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
