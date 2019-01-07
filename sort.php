<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/22
 * Time: 15:06
 */


/**
 * 递归公式
 * merge_sort(p…r) = merge(merge_sort(p…q), merge_sort(q+1…r))
 * 终止条件：p >= r 不用再继续分解
 */

function merge_sort_c(&$arr, $start, $end)
{
    if($start >= $end){
        return;
    }
    $middle = (int)(($start +$end)/2);
    merge_sort_c($arr, $start, $middle);
    merge_sort_c($arr, $middle+1, $end);

    merger($arr, $start, $middle, $end);
}

function merger(&$arr, $start, $middle, $end)
{
    $i = $start;
    $j = $middle+1;
    $arrTemp =[];
    while($i<=$middle && $j<=$end){
       if($arr[$i] <= $arr[$j]){
           $arrTemp[] =$arr[$i];
           $i++;
       }else{
           $arrTemp[] =$arr[$j];
           $j++;
       }
    }
    while($i <= $middle){
        $arrTemp[] =$arr[$i];
        $i++;
    }
    while($j<=$end){
        $arrTemp[] =$arr[$j];
        $j++;
    }

    $i = $start;
    foreach ($arrTemp as $key=>$val){
        $arr[$i]= $val;
        $i++;
    }
    return ;
}


$arr = [6,43,3,2, 2, 1];
$end = count($arr)-1;
echo $end;
merge_sort_c($arr, 0,5);


print_r($arr);
