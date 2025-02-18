<?php

namespace Controller;

class Test{

    use _GlobalController;

    function testx(){

        return $this->view('login/login2');

    }

}