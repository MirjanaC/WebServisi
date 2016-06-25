<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 2:12 PM
 */

require_once '../AbstractAPI.php';

class Tasks extends AbstractAPI
{
    protected $response;

    public function __construct($request, $origin) {
        parent::__construct($request);
    }

    protected function test()
    {
        return 'Task API';
    }
}