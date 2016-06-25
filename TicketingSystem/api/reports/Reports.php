<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 2:11 PM
 */

require_once '../AbstractAPI.php';

class Reports extends AbstractAPI
{
    protected $response;

    public function __construct($request, $origin) {
        parent::__construct($request);
    }

    protected function test()
    {
        return 'Reports API';
    }
}