<?php
/*
 * This file is part of the Thinkific library.
 *
 * (c) Graphem Solutions <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thinkific\Api;

use DateTime;

class Bundles extends AbstractApi{
  
    /**
     * @var string
     */
    protected $service = 'bundles';

    /**
     * Get Bundle
     *
     * @param  
     * @return array
     */
    public function getBundleById($id)
    {
        return json_decode(
            $this->api->get($this->service . '/' . $id)
        );
    }    
    
    /**
     * Get courses by Bundle ID
     *
     * @param  
     * @return array
     */
    public function getCourseByBundleId($id, $page = 1, $limit = 25)
    {
        return json_decode(
            $this->api->get($this->service . '/' . $id . '/courses',
                ['query' => 
                    [
                        'page' => $page, 
                        'limit' => $limit
                    ]
                ]
            )
        );
    }

    /**
     * Create a bundle Enrollment
     * Example Data
     * {   
     *   "user_id": 1,
     *   "activated_at": "2018-01-01T01:01:00Z",
     *   "expiry_date": "2019-01-01T01:01:00Z"
     *   }
     * @param  Int, Int, string, string
     * @return array
     */
    public function enroll($bundleId, $userId, $activeDate = '', $expireDate = '2150-01-01')
    {        
        $date = new DateTime();
        $date->modify('-1 day');
        $yesterday = $date->format('Y-m-d');

        $activeDate = $activeDate ? : $yesterday;
        
        $enrollData = [
            'user_id' => $userId,
            'activated_at' => DateTime::createFromFormat('Y-m-d',$activeDate)->format('Y-m-d\TH:i:s\Z'),
            'expiry_date' => DateTime::createFromFormat('Y-m-d',$expireDate)->format('Y-m-d\TH:i:s\Z')
        ];
        
        return json_decode(
            $this->api->post($this->service . '/' . $bundleId . '/enrollments' ,array('json' => $enrollData))
        );
    }
}