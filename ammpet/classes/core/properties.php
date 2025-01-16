<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('ROOT','http://localhost/ammpet/public');
} else{
    define('ROOT','https://amm01.sp1.br.saveincloud.net.br/ammpet/public');
}