<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minSurface;

    /**
     *
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->option = new ArrayCollection();
    }

    public function getOptions()
    {
    return $this->options;
    }

    public function setOptions(ArrayCollection $options)
    {
        return $this->options = $options;
    }

    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice)
    {
        return $this->maxPrice = $maxPrice;
    }

    public function getMinSurface()
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface)
    {
        return $this->minSurface = $minSurface;
    }
}