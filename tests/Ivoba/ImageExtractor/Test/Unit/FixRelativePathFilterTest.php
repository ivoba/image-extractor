<?php

namespace Ivoba\ImageExtractor\Test\Unit;


use Ivoba\ImageExtractor\Entity\Image;
use Ivoba\ImageExtractor\Filter\FixRelativePathFilter;

class FixRelativePathFilterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provideLinks
     */
    public function testFilter($link, $expected)
    {
        $filter = new FixRelativePathFilter('http://domain.com');
        $generated = $filter->filter([new Image($link)]);
        $this->assertEquals($generated[0]->getSrc(), $expected);
    }

    public function provideLinks(){
        return [
                ['img/../image.jpg', 'http://domain.com/img/../image.jpg'],
                ['/image.jpg', 'http://domain.com/image.jpg'],
                ['/test/image.jpg', 'http://domain.com/test/image.jpg'],
                ['http://pingpong.de/test/image.jpg', 'http://pingpong.de/test/image.jpg'],
                ['https://pingpong.de/test/image.jpg', 'https://pingpong.de/test/image.jpg'],
                ['ftp://pingpong.de/test/image.jpg', 'ftp://pingpong.de/test/image.jpg']
               ];
    }
} 