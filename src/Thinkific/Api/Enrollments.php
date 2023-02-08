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

class Enrollments extends AbstractApi{

    /**
     * @var string
     */
    protected $service = 'enrollments';

    /**
     * Base Request
     *
     * @param  array, int, int
     * @return array
     */
    protected function sendRequestFilter(array $filter, $page = 1, $limit = 25, $unique = false, $endPoint = '')
    {
        $baseQuery = [
            'page' => $page,
            'limit' => $limit
        ];

        return json_decode(
            $this->api->get($this->service,
                ['query' => array_merge($baseQuery, $filter)]
            ));
    }

    /**
     * Find by User Id
     *
     * @param  string, int, int
     * @return array
     */
    public function findByUserId($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[user_id]' => $search], $page, $limit);
    }

    /**
     * Find by Course Id
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCourseId($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[course_id]' => $search], $page, $limit);
    }

    /**
     * Find by Email
     *
     * @param  string, int, int
     * @return array
     */
    public function findByEmail($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[email]' => $search], $page, $limit);
    }

    /**
     * Find by Free Trial
     *
     * @param  string, int, int
     * @return array
     */
    public function findFreeTrial(bool $search = true, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[free_trial]' => $search], $page, $limit);
    }

    /**
     * Find by Full
     *
     * @param  string, int, int
     * @return array
     */
    public function findFull(bool $search = true, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[full]' => $search], $page, $limit);
    }

    /**
     * Find by Completed
     *
     * @param  string, int, int
     * @return array
     */
    public function findCompleted(bool $search = true, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[completed]' => $search], $page, $limit);
    }

    /**
     * Find by Expired
     *
     * @param  string, int, int
     * @return array
     */
    public function findExpired(bool $search = true, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[expired]' => $search], $page, $limit);
    }

    /**
     * Find by Created On Date
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCreatedOnDate($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[created_on]' => $search], $page, $limit);
    }

    /**
     * Find by Created Before Date
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCreatedBeforeDate($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[created_before]' => $search], $page, $limit);
    }

    /**
     * Find by Created On Or Before Date
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCreatedOnOrBeforeDate($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[created_on_or_before]' => $search], $page, $limit);
    }

    /**
     * Find by Created After
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCreatedAfter($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[created_after]' => $search], $page, $limit);
    }

    /**
     * Find by Created On Or After Date
     *
     * @param  string, int, int
     * @return array
     */
    public function findByCreatedOnOrAfterDate($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[created_on_or_after]' => $search], $page, $limit);
    }

    /**
     * Find by Updated On
     *
     * @param  string, int, int
     * @return array
     */
    public function findByUpdatedOn($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[updated_on]' => $search], $page, $limit);
    }

    /**
     * Find by Updated Before
     *
     * @param  string, int, int
     * @return array
     */
    public function findByUpdatedBefore($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[updated_before]' => $search], $page, $limit);
    }

    /**
     * Find by Updated On Or After Date
     *
     * @param  string, int, int
     * @return array
     */
    public function findByUpdatedOnOrAfterDate($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[updated_on_or_before]' => $search], $page, $limit);
    }

    /**
     * Find by Updated After
     *
     * @param  string, int, int
     * @return array
     */
    public function findByUpdatedAfter($search, $page = 1, $limit = 25)
    {
        return $this->sendRequestFilter(['query[updated_after]' => $search], $page, $limit);
    }

    /**
     * Create a Enrollment
     * Example Data
     * {
     *   "course_id": 1,
     *   "user_id": 1,
     *   "activated_at": "2018-01-01T01:01:00Z",
     *   "expiry_date": "2019-01-01T01:01:00Z"
     *   }
     * @param  Int, Int, string, string
     * @return array
     */
    public function create($courseId, $userId, $activeDate = '', $expireDate = '2150-01-01')
    {
        $date = new DateTime();
        $date->modify('-1 day');
        $yesterday = $date->format('Y-m-d');

        $activeDate = $activeDate ? : $yesterday;

        $enrollData = [
            'course_id' => $courseId,
            'user_id' => $userId,
            'activated_at' => DateTime::createFromFormat('Y-m-d',$activeDate)->format('Y-m-d\TH:i:s\Z'),
            'expiry_date' => DateTime::createFromFormat('Y-m-d',$expireDate)->format('Y-m-d\TH:i:s\Z')
        ];

        return json_decode(
            $this->api->post($this->service,array('json' => $enrollData))
        );
    }

    /**
     * Edit enrollment
     *
     * @param  int, string, string
     * @return array
     */
    public function edit($id, $activeDate = '', $expireDate = '')
    {
        $enrollData = [];

        if(!empty($activeDate)){
            $enrollData['activated_at'] = DateTime::createFromFormat('Y-m-d',$activeDate)->format('Y-m-d\TH:i:s\Z');
        }

        if(!empty($expireDate)){
            $enrollData['expiry_date'] = DateTime::createFromFormat('Y-m-d',$expireDate)->format('Y-m-d\TH:i:s\Z');
        }

        if(empty($enrollData)){
           return;
        }

        return json_decode(
            $this->api->put($this->service . '/' . $id ,array('json' => $enrollData))
        );
    }

    /**
     * Expire an Enrollment
     *
     * @param  int
     * @return array
     */
    public function expire($id)
    {
        $date = new DateTime();
        $yesterday = $date->modify('-1 day');

        $enrollData = ['expiry_date' => $yesterday->format('Y-m-d\TH:i:s\Z')];

        return json_decode(
            $this->api->put($this->service . '/' . $id ,array('json' => $enrollData))
        );
    }
}
