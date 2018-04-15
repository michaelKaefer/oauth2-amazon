<?php

namespace MichaelKaefer\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class AmazonResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getValueByKey($this->response, 'data.0.id');
    }

    /**
     * Get resource owner name
     *
     * @return string|null
     */
    public function getName()
    {
        $firstName = $this->getValueByKey($this->response, 'data.0.firstName') ?: '';
        $lastName = $this->getValueByKey($this->response, 'data.0.lastName') ?: '';
        return $firstName . ($firstName && $lastName ? ' ' : '') . $lastName;
    }

    /**
     * Get resource owner username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return null;
    }

    /**
     * Get resource owner location
     *
     * @return string|null
     */
    public function getLocation()
    {
        return null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
