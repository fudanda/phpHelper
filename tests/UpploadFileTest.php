<?php

require_once '../vendor/autoload.php';

use Kuiba\Qihengsan\ExcelExport;

// $ExcelExport = new ExcelExport();

$a = ExcelExport::test();
var_dump($a);