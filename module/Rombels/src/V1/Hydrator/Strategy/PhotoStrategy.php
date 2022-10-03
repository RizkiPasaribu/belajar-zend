<?php

namespace Rombels\V1\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;

/**
 * Class PhotoStrategy
 *
 * @package Reimbursement\Stdlib\Hydrator\Strategy
 */
class PhotoStrategy extends AbstractCollectionStrategy implements StrategyInterface
{
    protected $imagesUrl;

    public function __construct($imagesUrl = null)
    {
        $this->setPhotosUrl($imagesUrl);
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     * @throws \RuntimeException If object os not a Reimbursement
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function extract($value, $object = null)
    {
        $baseUrl  = $this->getPhotosUrl();
        if (!is_null($value) && $value != "") {
            $baseUrl    = $this->getPhotosUrl();
            $newUrl     = $baseUrl . '/' . $value;
            return $newUrl;
        } else {
            return null;
        }
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     * @throws \InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function hydrate($value, array $data = null)
    {
        return $value;
    }

    /**
     * Get the value of imagesUrl
     */
    public function getPhotosUrl()
    {
        return $this->imagesUrl;
    }

    /**
     * Set the value of imagesUrl
     *
     * @return  self
     */
    public function setPhotosUrl($imagesUrl)
    {
        $this->imagesUrl = $imagesUrl;

        return $this;
    }
}
