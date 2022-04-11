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

class Users extends AbstractApi{
  
    /**
     * @var string
     */
    protected $service = 'users';
    
    /**
     * Find by Email
     *
     * @param  string
     * @return Object
     */
    public function findByEmail($search)
    {
        return $this->sendRequestFilter(['query[email]' => $search], 1, 25, true);
    }

    /**
     * Find by Role
     *
     * @param  string, int, int
     * @return array
     */
    public function findByRole($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[role]' => $search], $page, $limit);
    }

    /**
     * Find by ExternalSource
     *
     * @param  string, int, int
     * @return array
     */
    public function findByExternalSource($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[external_source]' => $search], $page, $limit);
    }

    /**
     * Find by Custom Field 
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCustomField($label, $value, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter([
            'query[custom_profile_field_label]' => $label, 
            'query[custom_profile_field_value]' => $value
        ], $page, $limit);
    }

    /**
     * Find by Group Id
     *
     * @param  string, int, int
     * @return array
     */
    public function findByGroupId($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[group_id]' => $search], $page, $limit);
    }

    /**
     * Create a user
     * Example Data
     * {
     *       "first_name": "Bob",
     *       "last_name": "Smith",
     *       "email": "bob@example.com",
     *       "password": "password",
     *       "roles": [
     *           "affiliate"
     *       ],
     *       "bio": "The user's bio",
     *       "company": "The user's company",
     *       "headline": "The user's job title",
     *       "affiliate_code": "abc123",
     *       "affiliate_commission": 20,
     *       "affiliate_commission_type": "%",
     *       "affiliate_payout_email": "bob@example.com",
     *       "custom_profile_fields": [
     *           {
     *           "value": "887 909 9999",
     *           "label": "Phone",
     *           "custom_profile_field_definition_id": 1
     *           }
    *      ],
     *       "skip_custom_fields_validation": false,
     *       "send_welcome_email": false,
     *       "external_id": 0
     *       }
     * @param  
     * @return array
     */
    public function create(array $userData)
    {
        return json_decode(
            $this->api->post($this->service,array('json' => $userData))
        );
    }

    /**
     * Edit a user
     *
     * @param  
     * @return array
     */
    public function edit($id, array $userData)
    {
        return json_decode(
            $this->api->put($this->service . '/' . $id ,array('json' => $userData))
        );
    }

    /**
     * Delete a user
     *
     * @param  
     * @return array
     */
    public function delete($id)
    {
        return json_decode(
            $this->api->delete($this->service . '/' . $id)
        );
    }
}
