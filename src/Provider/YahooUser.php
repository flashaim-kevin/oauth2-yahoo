<?php

namespace Hayageek\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class YahooUser implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    protected $response;


    /**
     * @var image URL
     */
    private $imageUrl;

    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->response['sub'];
    }

    /**
     * Get perferred display name.
     *
     * @return string
     */
    public function getName()
    {
        /*
        nickname is not coming in the response.
        $this->response['profile']['nickname']
        */
        return $this->getFirstName() . " " . $this->getLastName();
    }

    /**
     * Get perferred first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->response['given_name'];
    }

    /**
     * Get perferred last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->response['family_name'];
    }

    /**
     * Get email address.
     *
     * @return string|null
     */
    public function getEmail()
    {
        if (!empty($this->response['email'])) {
            return $this->response['email'];
        }
    }

    /**
     * Get avatar image URL.
     *
     * @return string|null
     */
    public function getAvatar()
    {
        return $this->response['picture'];
    }

    public function setImageURL($url)
    {
        $this->response['picture'] = $url;
        return $this;
    }

    /**
     * Get user data as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
