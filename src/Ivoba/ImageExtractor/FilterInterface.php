<?php

namespace Ivoba\ImageExtractor;

interface FilterInterface
{

    /**
     * filters images from array of images
     *
     * @param array $images
     * @return array
     */
    public function filter(array $images);

} 