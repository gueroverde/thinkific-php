<?php
/*
 * This file is part of the Thinkific library.
 *
 * (c) Graphem Solutions <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thinkific\SSO;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SSO{

    /**
     * @var String
     */
    protected $apiKey;

    /**
     * @var String
     */
    protected $subdomain;    

    public function __construct($apiKey, $subdomain)
    {
        $this->apiKey = $apiKey;
        $this->subdomain = $subdomain;
    }
    /**
    * Produce the SSO link
    * PARAM:
    * [
    *    {
    *       "first_name": "Thinkific",
    *        "last_name": "Admin",
    *        "email": "thinkific@thinkific.com",
    *        "iat": 1520875725
    *        "external_id": "thinkific@thinkific.com",
    *        "bio": "Mostly harmless",
    *        "company": "Thinkific",
    *        "timezone": "America/Los_Angeles",
    *    }
    *    ]
    * @return string
    */
    public function getLink($issueBy = '', array $userData, $returnUrl = '', $errorUrl = '')
    {
        $time    = time();    
        $payload = array(
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'iat' => $time,
            'exp' =>  $time + 3600,
            'iss' => $issueBy
        );

        if(isset($userData['external_id'])){
            $payload['external_id'] = $userData['external_id'];
        }
        
        $token = JWT::encode($payload, $this->apiKey, 'HS256');

        $url = "https://$this->subdomain.thinkific.com/api/sso/v2/sso/jwt?jwt=$token";

        if(!empty($returnUrl)){ $url = $url . "&return_to=$returnUrl";}
        if(!empty($errorUrl)) {  $url = $url . "&error_url=$errorUrl";}

        return $url;
    }
}