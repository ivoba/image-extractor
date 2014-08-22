<?php

namespace Ivoba\ImageParser\Parser;


use Ivoba\ImageParser\Entity\Image;
use Ivoba\ImageParser\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

class DomCrawlerParser implements ParserInterface
{
    private $xpath;

    function __construct($xpath = '//img')
    {
        $this->xpath = $xpath;
    }

    public function parse($str)
    {
        $images = [];
        $crawler = new Crawler();

        $str = html_entity_decode($str);
        $crawler->addContent($str);

        $tags = $crawler->filterXPath($this->xpath);
        foreach ($tags as $img) {
            $src = null;
            $height = null;
            $width = null;
            $title = null;
            $attributes = [];
            foreach ($img->attributes as $attr) {
                switch ($attr->name) {
                    case 'src':
                        $src = $attr->value;
                        break;
                    case 'width':
                        $width = $attr->value;
                        break;
                    case 'height':
                        $height = $attr->value;
                        break;
                    case 'alt':
                        $title = $attr->value;
                        break;
                    case 'title':
                        $title = $attr->value;
                        break;
                    default:
                        $attributes[$attr->name] = $attr->value;
                        break;
                }
            }
            if ($src) {
                $images[] = new Image($src, $height, $width, $title, $attributes);
            }
        }
        return $images;
    }
} 