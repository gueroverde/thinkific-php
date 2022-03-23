<?php

/*
 * This file is part of the Thinkific library.
 *
 * (c) Graphem Solutions <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Documentations: https://developers.thinkific.com/api/api-documentation/
 */

namespace Thinkific;

use Thinkific\SSO\SSO;
use Thinkific\Api\Users;
use Thinkific\Api\Courses;
use Thinkific\Api\Chapters;
use Thinkific\Api\Contents;
use Thinkific\Api\Enrollments;
use Thinkific\Api\Categories;
use Thinkific\Api\Products;
use Thinkific\Adapter\GuzzleHttpAdapter;
use Thinkific\Api\Bundles;

class Thinkific
{
    /**
     * @var string
     */
    const ENDPOINT = 'https://api.thinkific.com/api/public/v1/';

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var String
     */
    protected $apiKey;

    /**
     * @var String
     */
    protected $adapter;

    /**
     * @var String
     */
    protected $subdomain;


    /**
     * @param $apiKey
     * @param $secret
     * @param string $endpoint
     */
    public function __construct($apiKey, $subdomain, $endpoint = null)
    {
        $this->apiKey = $apiKey;
        $this->subdomain = $subdomain;
        $this->endpoint = $endpoint ?: static::ENDPOINT;
    }

    /**
     * Initiate the client for API transation
     *
     * @param AdapterInterface $adapter
     * @param array $headers
     * @return $this
     */
    protected function setAdapter(AdapterInterface $adapter = null, $headers = [])
    {
        if (is_null($adapter)) {
            $this->client = new GuzzleHttpAdapter($headers, $this->endpoint);
            return $this;
        }
        $this->client = new $adapter($headers, $this->endpoint);
        return $this;
    }

    /**
     * Set adapter ready for Thinkific
     * @return void
     */
    protected function setAdapterWithApikey()
    {
        $headers = [
            'headers' =>
            [
                'X-Auth-API-Key'  => $this->apiKey,
                'X-Auth-Subdomain'  => $this->subdomain,
            ]

        ];
        $this->setAdapter($this->adapter, $headers);
    }

    /**
     * Get the client
     *
     * @return AdapterInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return Bundles
     */
    public function bundles()
    {
        $this->setAdapterWithApikey();
        return new Bundles($this);
    }

    /**
     * @return Courses
     */
    public function courses()
    {
        $this->setAdapterWithApikey();
        return new Courses($this);
    }

    /**
     * @return Contents
     */
    public function contents()
    {
        $this->setAdapterWithApikey();
        return new Contents($this);
    }

    /**
     * @return Chapters
     */
    public function chapters()
    {
        $this->setAdapterWithApikey();
        return new Chapters($this);
    }

    /**
     * @return Enrollments
     */
    public function enrollments()
    {
        $this->setAdapterWithApikey();
        return new Enrollments($this);
    }

    /**
     * @return Users
     */
    public function users()
    {
        $this->setAdapterWithApikey();
        return new Users($this);
    }

    /**
     * @return SSO
     */
    public function sso()
    {
        return new SSO($this->apiKey, $this->subdomain);
    }

    public function categories()
    {
        $this->setAdapterWithApikey();
        return new Categories($this);
    }

    /**
     * @return Products
     */
    public function products()
    {
        $this->setAdapterWithApikey();
        return new Products($this);
    }
}