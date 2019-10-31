<?php

/**
 *
 */

namespace Kuiba\kuibaAdmin;

use think\console\Input;
use think\console\Output;
use think\console\input\Argument;
use Kuiba\kuibaAdmin\facade\Tool;
use think\Console;

class Html extends \think\console\Command
{
    public function configure()
    {
        $this->setName('html:init')
            ->addArgument('name', Argument::OPTIONAL, "your module name")
            ->setDescription('install html admin');
    }
    public function execute(Input $input, Output $output)
    {

        $moduleName = trim($input->getArgument('name'));

        empty($moduleName) && $moduleName = 'admin';
        $moduleName = strtolower($moduleName);

        $this->createConfig($output);
        $this->createMigrate($output);
        $this->createResources($output, $moduleName);
        $this->createCommonModel($output);
        $this->createRoute($output, $moduleName);
        $this->createModule($output, $moduleName);

        // $this->createHtml($output);

    }
    //复制配置文件
    public function createConfig($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'config', 'template.php');
        $baseFilePath = file_build_path(__DIR__, '..', 'config', 'template.php');
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
    public function createResources($output, $moduleName = 'admin')
    {
        $filePath = file_build_path(env('app_path'), '..', 'public', 'static', $moduleName);
        $baseFilePath = file_build_path(__DIR__, '..', 'resources', 'html', 'static');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath, 'copy_dir');
    }
    //复制html文件
    public function createHtml($output)
    { }
    //复制公共model文件
    public function createCommonModel($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'application', 'common', 'model', 'Common.php');
        $baseFilePath = file_build_path(__DIR__, '..', 'src', 'model', 'Common.php');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    }
    //复制公共Route文件
    public function createRoute($output, $moduleName = 'admin')
    {
        $routeName = $moduleName . '.php';
        $filePath = file_build_path(env('app_path'), '..', 'route', $routeName);
        $baseFilePath = file_build_path(__DIR__, '..', 'src', 'route', $routeName);
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    }
    //复制公共Route文件
    public function createModule($output, $moduleName = 'admin')
    {
        $moduleName = $moduleName . '/Page';
        $parameters['name'] = $moduleName;
        $newoutput = Console::call('curd:init', $parameters);
        $output->writeln($newoutput->fetch());
    }
}