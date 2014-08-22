<?php

namespace Ivoba\ImageParser;


interface ParserInterface
{
    /**
     * parses Images from string
     *
     * @param string $str
     * @return array images
     */
    public function parse($str);
} 