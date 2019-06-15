<?php

require_once '../vendor/autoload.php';

use Cribug\Qihengsan\ExcelExport;

$ExcelExport = new ExcelExport();

$a = $ExcelExport::test();
var_dump($a);