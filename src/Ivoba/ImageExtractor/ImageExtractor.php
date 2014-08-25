<?php

namespace Ivoba\ImageExtractor;


use Symfony\Component\DomCrawler\Crawler;

class ImageExtractor
{

    private $filterList = [];
    private $extractorList = [];

    /**
     * @param array $extractor
     * @param array $filterList
     */
    function __construct(array $extractorList, array $filterList)
    {
        foreach ($extractorList as $extractor) {
            $this->addExtractor($extractor);
        }

        foreach ($filterList as $filter) {
            $this->addFilter($filter);
        }
    }

    /**
     * @param $string
     * @return array
     */
    public function findImages($string)
    {
        $images = [];

        $crawler = new Crawler();

        $str = html_entity_decode($string);
        $crawler->addContent($str);

        foreach ($this->extractorList as $extractor) {
            $images = array_merge($images, $extractor->extract($crawler));
        }

        foreach ($this->filterList as $filter) {
            $images = $filter->filter($images);
        }

        return $images;
    }

    /**
     * @param ExtractorInterface $extractor
     */
    public function addExtractor(ExtractorInterface $extractor)
    {
        $this->extractorList[] = $extractor;
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filterList[] = $filter;
    }

} 