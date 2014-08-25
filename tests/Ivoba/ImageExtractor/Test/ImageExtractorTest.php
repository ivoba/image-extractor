<?php
namespace Ivoba\ImageExtractor\Test;

use Ivoba\ImageExtractor\Filter\FixRelativePathFilter;
use Ivoba\ImageExtractor\Filter\StrPosFilter;
use Ivoba\ImageExtractor\ImageExtractor;
use Ivoba\ImageExtractor\Extractor\ImageXPathExtractor;

class ImageExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testExtractImages($file, $image)
    {
        $extractorList = [new ImageXPathExtractor()];
        $filter = [];
        $imageExtractor = new ImageExtractor($extractorList, $filter);
        $images = $imageExtractor->extract(file_get_contents($file));
        $this->assertEquals($image, $images[0]->getSrc());
    }

    public function testExtractRelativeImages(){
        $extractorList = [new ImageXPathExtractor()];
        $filter = [new FixRelativePathFilter('http://domain.com')];
        $imageExtractor = new ImageExtractor($extractorList, $filter);
        $images = $imageExtractor->extract(file_get_contents(__DIR__ . '/../Resources/relativePath.html'));
        $this->assertEquals('http://domain.com/image.jpg', $images[0]->getSrc());
        $this->assertEquals('http://externaldomain.com/image.jpg', $images[2]->getSrc());
    }

    public function testExtractRelativeImagesWithStrPosFilter(){
        $extractorList = [new ImageXPathExtractor()];
        $filter = [new FixRelativePathFilter('http://domain.com'),
                   new StrPosFilter(['flattr-badge', 'feedburner.com'])];
        $imageExtractor = new ImageExtractor($extractorList, $filter);
        $images = $imageExtractor->extract(file_get_contents(__DIR__ . '/../Resources/relativePath.html'));
        $this->assertEquals('http://domain.com/image.jpg', $images[0]->getSrc());
        $this->assertEquals(2, count($images));
    }

    public function provideUrls()
    {
        return [
            [__DIR__ . '/../Resources/rssItemContent.txt', 'http://mtn-world.com/files/2012/08/SABE_12.jpg'],
            [__DIR__ . '/../Resources/html5.html', 'http://nerdpress.org/wp-content/themes/nerdpress/images/sponsor.png']
            ];
    }
} 