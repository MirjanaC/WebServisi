<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 2:09 PM
 */

require_once '../AbstractAPI.php';

class Comments extends AbstractAPI
{
    protected $response;

    public function __construct($request, $origin) {
        parent::__construct($request);
    }

    protected function test()
    {
        return 'Comments API';
    }
}