<?php
require 'vendor/autoload.php';
$kernel = new App\Kernel\Kernel();
$kernel->handle(new \App\Requests\Request())->send();