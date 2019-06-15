# phpHelper
>php 助手类 整理
composer require fdd/php-helper



$excelObj = (new \app\common\tools\ExcelExport());
//单个导出
$excelObj->exportTheExcel($filename, $xlsCell, $data);


//压缩导出
$res = array_chunk($data, 1000);
$num = count($res);
for ($i = 0; $i < $num; $i++) {
    $myres = $excelObj->exportTheExcelZip($filename, $xlsCell, $res[$i], $i + 1);
}
$excelObj->excelZip();