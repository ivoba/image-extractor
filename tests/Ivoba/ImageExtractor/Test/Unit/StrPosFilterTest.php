<?php

namespace Ivoba\ImageExtractor\Test\Unit;


use Ivoba\ImageExtractor\Entity\Image;
use Ivoba\ImageExtractor\Filter\StrPosFilter;

class StrPosFilterTest extends \PHPUnit_Framework_TestCase
{

    public function testFilter()
    {
        $images = [new Image('http://domain.com/image.jpg'),
                   new Image('http://feeds.feedburner.com/dir/dir/image.jpg'),
                   new Image('http://domain.com/image2.jpg'),
                   new Image('http://otherdomain.com/image.jpg'),
                   new Image('http://googleusercontent.com/tracker/pixel.gif'),
                   new Image('http://domain.com/flattr-badge.png'),
                   new Image('http://feedads.g.doubleclick.net/image.jpg')];

        $filter = new StrPosFilter(['feeds.feedburner.com',
                                       'googleusercontent.com/tracker',
                                       'feedads.g.doubleclick.net',
                                       'flattr-badge']);

        $generated = $filter->filter($images);
        $this->assertEquals('http://domain.com/image.jpg', $generated[0]->getSrc());
        $this->assertEquals('http://domain.com/image2.jpg', $generated[2]->getSrc());
        $this->assertEquals('http://otherdomain.com/image.jpg', $generated[3]->getSrc());
    }
} 