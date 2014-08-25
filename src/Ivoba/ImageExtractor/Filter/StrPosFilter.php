<?php

namespace Ivoba\ImageExtractor\Filter;


use Ivoba\ImageExtractor\FilterInterface;

class StrPosFilter implements FilterInterface
{

    private $needles;

    function __construct(array $needles)
    {
        $this->needles = $needles;
    }

    /**
     * @inheritdoc
     */
    public function filter(array $images)
    {
        foreach ($images as $index => $img) {
            if ($this->findNeedle($img->getSrc())) {
                unset($images[$index]);
            }
        }
        return $images;
    }

    private function findNeedle($string)
    {
        foreach ($this->needles as $needle) {
            if (strpos($string, $needle) !== false) {
                return true;
            }
        }
        return false;
    }
}