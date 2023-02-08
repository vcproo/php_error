<?php
use Core\Error;
include 'Error.php';
(new Error(false))->error();//false 不开启debug 日志保存；true 开启debug利于开发 
require a;//警告错误