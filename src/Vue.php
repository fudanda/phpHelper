<?php

/**
 *
 */

namespace Kuiba\kuibaAdmin;

use think\console\Input;
use think\console\Output;

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
    public function createwebpackmix($output)
    {
        $configFilePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'webpack.mix.js';

        $output->writeln($configFilePath);

        if (is_file($configFilePath)) {
            $output->writeln('webpackmix file is exist');
        } else {
            $res = copy(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR . 'webpack.mix.js', $configFilePath);
            if ($res) {
                $output->writeln('Create webpackmix file success:' . $configFilePath);
            } else {
                $output->writeln('Create webpackmix file error');
            }
        }
    }
    //复制 babel 配置文件
    public function createBabelrc($output)
    {
        $configFilePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . '.babelrc';
        if (is_file($configFilePath)) {
            $output->writeln('Config file is exist');
        } else {
            $res = copy(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR . '.babelrc', $configFilePath);
            if ($res) {
                $output->writeln('Create Babelrc file success:' . $configFilePath);
            } else {
                $output->writeln('Create Babelrc file error');
            }
        }
    }
    // //复制数据库迁移文件
    // public function createMigrations($output)
    // {
    //     $migrationsPath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';
    //     copy_dir(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations', $migrationsPath);
    //     $output->writeln('Copy database margrations success(数据库迁移文件复制成功)');
    // }
    //复制静态文件
    public function createStatic($output)
    {
        $staticPath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'resources';
        if (is_dir($staticPath)) {
            $output->writeln('Static file is exist');
        } else {
            copy_dir(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR . 'resources', $staticPath);
            $output->writeln('Copy resources success(静态文件复成功)');
        }
    }
    // //复制html文件
    // public function createHtml($output)
    // {
    //     $staticPath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'view';
    //     copy_dir(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view', $staticPath);
    //     $output->writeln('Copy Html success(Html文件复成功)');
    // }
    //复制公共model文件
    public function createCommonModel($output)
    {
        $configFilePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'Common.php';
        if (is_file($configFilePath)) {
            $output->writeln('Config file is exist');
        } else {
            $res = copy(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'Common.php', $configFilePath);
            if ($res) {
                $output->writeln('Create CommonModel file success:' . $configFilePath);
            } else {
                $output->writeln('Create configCommonModel file error');
            }
        }
    }
    //复制公共model文件
    public function createRouter($output)
    {
        $configFilePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'route' . DIRECTORY_SEPARATOR . 'admin.php';
        if (is_file($configFilePath)) {
            $output->writeln('Route admin.php file is exist');
        } else {
            $res = copy(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'route' . DIRECTORY_SEPARATOR . 'admin.php', $configFilePath);
            if ($res) {
                $output->writeln('Create Route file success:' . $configFilePath);
            } else {
                $output->writeln('Create configCommonModelRouteRoute file error');
            }
        }
    }
}