<?php

/**
 *
 */

namespace Kuiba\kuibaAdmin;

use think\console\Input;
use think\console\Output;
use Kuiba\kuibaAdmin\facade\Tool;

class Vue extends \think\console\Command
{
    public function configure()
    {
        $this->setName('vue:init')
            ->setDescription('install vue  admin');
    }

    public function execute(Input $input, Output $output)
    {
        $this->createwebpackmix($output);
        $this->createStatic($output);
        $this->createBabelrc($output);

        // $this->createMigrations($output);
        // $this->createHtml($output);
        // $this->createCommonModel($output);
        // $this->createRouter($output);
    }
    //复制配置文件
    public function createWebpackmix($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'webpack.mix.js');
        $baseFilePath = file_build_path(__DIR__, '..', 'vue', 'webpack.mix.js');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    }
    //复制 babel 配置文件
    public function createBabelrc($output)
    {
        $filePath = file_build_path(env('app_path'), '..', '.babelrc');
        $baseFilePath = file_build_path(__DIR__, '..', 'vue', '.babelrc');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    }
    //复制数据库迁移文件
    public function createMigrate($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'database', 'migrations');
        $baseFilePath = file_build_path(__DIR__, '..', 'database', 'migrations');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath, 'copy_dir');
    }
    //复制静态文件
    public function createResources($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'resources');
        $baseFilePath = file_build_path(__DIR__, '..', 'vue', 'resources');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath, 'copy_dir');
    }
    public function createCommonModel($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'application', 'common', 'model', 'Common.php');
        $baseFilePath = file_build_path(__DIR__, '..', 'src', 'model', 'Common.php');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    }
    // //复制公共Route文件
    // public function createRoute($output)
    // {
    //     $filePath = file_build_path(env('app_path'), '..', 'route', 'admin.php');
    //     $baseFilePath = file_build_path(__DIR__, '..', 'src', 'route', 'admin.php');
    //     Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    // }
}