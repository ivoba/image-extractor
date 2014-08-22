<?php

namespace Ivoba\ImageParser;


class ImageParser
{

    private $filterList = [];
    private $parserList = [];
    private $basePath;

    /**
     * @param array $parserList
     * @param array $filterList
     * @param null $basePath
     */
    function __construct(array $parserList, array $filterList, $basePath = null)
    {
        $this->basePath = $basePath;

        foreach ($parserList as $parser) {
            $this->addParser($parser);
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

        foreach ($this->parserList as $parser) {
            $images = array_merge($images, $parser->parse($string));
        }

        foreach ($this->filterList as $filter) {
            $images = $filter->filter($images);
        }

        if ($this->basePath) {
            $this->fixRelativePaths($images);
        }
        return $images;
    }

    /**
     * @param ParserInterface $resolver
     */
    public function addParser(ParserInterface $parser)
    {
        $this->parserList[] = $parser;
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filterList[] = $filter;
    }

    /**
     * @param mixed $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    protected function fixRelativePaths(array $images)
    {
        foreach ($images as $img) {
            //check for relative path
            //@todo https
            preg_match('/^http:\/\//', $img->getSrc(), $matches, PREG_OFFSET_CAPTURE);
            if (empty($matches)) {
                $img->setSrc($this->basePath . $img->getSrc());
            }
        }
        return $images;

    }
} 