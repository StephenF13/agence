<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    private $maxPrice;


    /**
     * @var ArrayCollection
     */
    private $options;


    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return mixed
     * @Assert\Range(min=100000, max=1000000)
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     */
    public function setMaxPrice($maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return mixed
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @param mixed $minSurface
     */
    public function setMinSurface($minSurface): void
    {
        $this->minSurface = $minSurface;
    }

    /**
     * @var
     * @Assert\Range(min=10, max=400)
     */
    private $minSurface;

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }


}