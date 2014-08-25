<?php

namespace Ivoba\ImageExtractor\Test\Unit;


class ImageXPathExtractor extends \PHPUnit_Framework_TestCase
{
    public function testExtract()
    {
        $extractor = new \Ivoba\ImageExtractor\Extractor\ImageXPathExtractor();
        $crawler = $this->getMockBuilder('Ivoba\ImageExtractor\Extractor\ImageXPathExtractor')
                        ->disableOriginalConstructor()
                        ->getMock();
        $crawler->expects($this->once())
                ->method('filterXPath')
                ->with('//img')
                ->will($this->returnValue($tags = []));
        $generated = $extractor->extract($crawler);
        $this->assertEquals([], $generated);
    }
} 