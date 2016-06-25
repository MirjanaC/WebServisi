<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 11:09 AM
 */

require_once '../AbstractAPI.php';

class Projects extends AbstractAPI
{
    protected $response;

    public function __construct($request, $origin) {
        parent::__construct($request);
    }

    protected function test()
    {
        return 'Projects API';
    }
}