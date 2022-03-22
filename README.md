# Thinkific PHP API client
Light Thinkific API library for PHP based on the documentation [found here](https://developers.thinkific.com/api/api-documentation/)

## Requirements
* PHP 7.4+

## Installation

The Thinkific PHP API client can be installed using [Composer](https://packagist.org/packages/zendesk/zendesk_api_client_php).

### Composer

To install run `composer require graphem/thinkific-php`

## Configuration

Configuration is done through an instance of `Thinkific\Thinkific`.
The block is mandatory and if not passed, an error will be thrown.

``` php
// load Composer
require 'vendor/autoload.php';

use \Thinkific\Thinkific;

$subdomain  = "subdomain";
$apiKey     = "yourapikey"; 

$client = new Thinkific($apiKey,$subdomain);
```

## Usage

### Basic Operations

``` php
// Get all the courses
$courses = $client->courses()->getAll();
print_r($courses);

// Find a user by email
$user = $client->users()->findByEmail('me@domain.com');
print_r($user);

// Encoll a user to a course
$enroll = $client->enrollments()->create($courseId,$userId, '2020-01-01', '2021-01-01');

// Generate SSO link
$link = $client->sso()->getLink('signed-by (your application name or url)', ['email' => 'me@domain.com', 'first_name' => 'Me', 'last_name' => 'Hey']);

```