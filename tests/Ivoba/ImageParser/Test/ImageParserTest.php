<?php
namespace Ivoba\ImageParser\Test;

use Ivoba\ImageParser\ImageParser;
use Ivoba\ImageParser\Parser\DomCrawlerParser;

class ImageParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testFindImagesViaDomCrawlerParser($file, $image)
    {
        $parser = [new DomCrawlerParser()];
        $filter = [];
        $basePath = 'http://domain.com';
        $imageParser = new ImageParser($parser, $filter, $basePath);
        $images = $imageParser->findImages(file_get_contents($file));
        $this->assertEquals($image, $images[0]->getSrc());
    }

    public function provideUrls()
    {
        return [
            [__DIR__ . '/../Resources/relativePath.html', 'http://domain.com/image.jpg'],
            [__DIR__ . '/../Resources/rssItemContent.txt', 'http://mtn-world.com/files/2012/08/SABE_12.jpg'],
            [__DIR__ . '/../Resources/html5.html', 'http://nerdpress.org/wp-content/themes/nerdpress/images/sponsor.png']
            ];
    }
} 