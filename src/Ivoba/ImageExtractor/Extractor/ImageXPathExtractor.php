<?php

namespace Ivoba\ImageExtractor\Extractor;

use Ivoba\ImageExtractor\Entity\Image;
use Ivoba\ImageExtractor\ExtractorInterface;
use Symfony\Component\DomCrawler\Crawler;

class ImageXPathExtractor implements ExtractorInterface
{
    private $xpath;

    /**
     * @param string $xpath
     */
    function __construct($xpath = '//img')
    {
        $this->xpath = $xpath;
    }

    /**
     * @inheritdoc
     */
    public function extract(Crawler $crawler)
    {
        $images = [];

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