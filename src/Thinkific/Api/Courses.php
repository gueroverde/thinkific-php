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

class Courses extends AbstractApi{
  
    /**
     * @var string
     */
    protected $service = 'courses';

    /**
     * Get courses
     *
     * @param  
     * @return array
     */
    public function getCourses($courseId)
    {
        return json_decode(
            $this->api->get($this->service,
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
     * Get courses by ID
     *
     * @param  
     * @return array
     */
    public function getCourseById($courseId)
    {
        return json_decode(
            $this->api->get($this->service . '/' . $courseId)
        );
    }

    /**
     * Get Chapters by Course ID
     *
     * @param  
     * @return array
     */
    public function getChaptersById($courseId, $page = 1, $limit = 25)
    {
        return json_decode(
            $this->api->get($this->service . '/' . $courseId . '/chapters',
                ['query' => 
                    [
                        'page' => $page, 
                        'limit' => $limit
                    ]
                ]
            )
        );
    }
}
