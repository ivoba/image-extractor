<?php

namespace Ivoba\ImageExtractor\Filter;


use Ivoba\ImageExtractor\FilterInterface;

class FixRelativePathFilter implements FilterInterface
{

    private $basePath;

    function __construct($basePath)
    {
        $this->basePath = rtrim($basePath, '/');
    }

    /**
     * @inheritdoc
     */
    public function filter(array $images)
    {
        foreach ($images as &$img) {
            //check for relative path
            $matches = [];
            preg_match('/(http|https|ftp|ftps)\:\/\/(\/\S*)?/', $img->getSrc(), $matches, PREG_OFFSET_CAPTURE);
            if (empty($matches)) {
                $img->setSrc($this->basePath . '/' .ltrim($img->getSrc(), '/'));
            }
        }
        return $images;

    }
} 