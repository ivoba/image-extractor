<?php

namespace Ivoba\ImageExtractor;

use Symfony\Component\DomCrawler\Crawler;

interface ExtractorInterface
{
    /**
     * extract images via a DomCrawler object
     *
     * @param Crawler $crawler
     * @return array
     */
    public function extract(Crawler $crawler);
} 