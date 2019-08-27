<?php

/**
 *
 */

namespace Kuiba\kuibaAdmin;

use think\console\Input;
use think\console\Output;

class Command extends \think\console\Command
{
    public function configure()
    {
        $this->setName('admin:init')
            ->setDescription('install admin');
    }

    public function execute(Input $input, Output $output)
    {
        $this->createConfig($output);
        $this->createStatic($output);
        $this->createMigrations($output);
        $this->createHtml($output);
    }
    //复制配置文件
    public function createConfig($output)
    {
        $configFilePath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'template.php';
        // if (is_file($configFilePath)) {
        //     $output->writeln('Config file is exist');
        // } else {
        $res = copy(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'template.php', $configFilePath);
        if ($res) {
            $output->writeln('Create config file success:' . $configFilePath);
        } else {
            $output->writeln('Create config file error');
            // }
        }
    }
    //复制数据库迁移文件
    public function createMigrations($output)
    {
        $migrationsPath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';
        copy_dir(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations', $migrationsPath);
        $output->writeln('Copy database margrations success(数据库迁移文件复制成功)');
    }
    //复制静态文件
    public function createStatic($output)
    {
        $staticPath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'public' .
            DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR;
        copy_dir(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'static', $staticPath);
        $output->writeln('Copy resources success(静态文件复成功)');
    }
    //复制html文件
    public function createHtml($output)
    {
        $staticPath = env('app_path') . '..' . DIRECTORY_SEPARATOR . 'view';
        copy_dir(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view', $staticPath);
        $output->writeln('Copy Html success(Html文件复成功)');
    }
}