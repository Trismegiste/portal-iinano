<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Model;

/**
 * Plan is a Plan product specification
 */
class Plan
{

    protected $name;
    protected $code;
    protected $dbLimit;
    protected $storageLimit;
    protected $bandwidthLimit;
    protected $descr;
    protected $price;
    protected $recommendedSize;
    protected $templateBody;

    public function __construct(array $property)
    {
        foreach ($property as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \InvalidArgumentException("$key is not a property of Plan");
            }
        }
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getDescription()
    {
        return $this->descr;
    }

    public function getDbLimit()
    {
        return $this->dbLimit;
    }

    public function getStorageLimit()
    {
        return $this->storageLimit;
    }

    public function getBandwidthLimit()
    {
        return $this->bandwidthLimit;
    }

    public function getRecommendedSize()
    {
        return $this->recommendedSize;
    }

    public function getTemplate()
    {
        return $this->templateBody;
    }

}
