<?php

/*
 * This file is part of the thans/layui-admin.
 *
 * (c) Thans <thans@thans.cn>
 *
 * This source file is subject to the Apache2.0 license that is bundled.
 */

namespace Kuiba\kuibaAdmin;

class Tool
{
    public function fileManager()
    {
        $filePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'images';
        $file_arr = array();
        if (is_dir($filePath)) {
            //打开
            if ($dh = @opendir($filePath)) {
                //读取
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $file_arr[] = $file;
                    }
                }
                //关闭
                closedir($dh);
            }
        }
        $this->initfileManager($file_arr);
        return $file_arr;
    }
    public function initfileManager($file_arr)
    {
        $configFilePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'fileManager.json';

        $data['code'] = 0;
        $data['msg'] = '成功！';
        $data['count'] = count($file_arr);
        $data['data'] = $file_arr;
        $json_string = json_encode($data, JSON_UNESCAPED_UNICODE);
        // 写入文件
        file_put_contents($configFilePath, $json_string);
    }
}