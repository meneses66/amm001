<?php

defined('ROOTPATH') OR exit('Access denied!');

class _404 extends _GlobalController {
    public function index()
    {
        echo "404 error - controller not found";
    }
}