<?php
/**
 * Created by PhpStorm.
 * User: voip1
 * Date: 2015/5/11
 * Time: 14:29
 */
$config = array(
    'master' => array(
        'type' => 'MySQL',
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '',
        'dbname' => 'mytest',
    ),

    'slave' => array(
        'slave1' => array(
            'type' => 'MySQL',
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => '',
            'dbname' => 'mytest',
        ),
        'slave2' => array(
            'type' => 'MySQL',
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => '',
            'dbname' => 'mytest',
        ),
    ),
);