<?php

namespace Kuiba\kuibaAdmin\command;

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
        // $this->createRoute($output, $moduleName);
        $this->createModule($output, $moduleName);

        $this->createHtml($output, $moduleName);
    }
    //复制配置文件
    public function createConfig($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'config', 'template.php');
        $baseFilePath = file_build_path(__DIR__, '..', '..', 'config', 'template.php');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath, false);
    }
    //复制数据库迁移文件
    public function createMigrate($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'database', 'migrations');
        $baseFilePath = file_build_path(__DIR__, '..', '..', 'database', 'migrations');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath, true, 'copy_dir');
    }
    //复制静态文件
    public function createResources($output, $moduleName = 'admin')
    {
        //文件重命名
        $pageFilePath = file_build_path(__DIR__, '..', '..', 'resources', 'html', 'page');
        $dirToArray = dirToArray($pageFilePath);
        foreach ($dirToArray as $key => $value) {
            $newbaseFilePath = file_build_path($pageFilePath, $value);
            $newValue = strpos($value, '-');
            $newName = null;
            $newValue && $newName = str_replace('-', '', $value);
            !is_null($newName) && $newFilePath = file_build_path($pageFilePath, $newName);
            !is_null($newName) && rename($newbaseFilePath, $newFilePath);
        }

        $filePath = file_build_path(env('app_path'), '..', 'public', 'static', $moduleName);
        $baseFilePath = file_build_path(__DIR__, '..', '..', 'resources', 'html');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath, true, 'copy_dir');
    }
    //复制html文件
    public function createHtml($output, $moduleName = 'admin')
    {
        $filePath = file_build_path(env('app_path'), '..', 'view', $moduleName, 'page', 'index.html');

        if (is_file($filePath)) {
            $output->writeln($filePath . ' already exists!');
        } else {
            $baseFilePath = file_build_path(__DIR__, '..', '..', 'resources', 'html', 'index.html');
            $baseFilePathStr = file_get_contents($baseFilePath);
            $newLink = '$1' . '="/static/' . $moduleName . '/$2"' . '$3';
            $newScript = '$1' . '="/static/' . $moduleName . '/$2"' . '$3';
            $newJson = "'/static/$moduleName/api/init.json'";
            // . '/static/' . $moduleName . '/api/init.json'
            $indexStr = preg_replace('/(<link.+?href)="(.*?[css])"/', $newLink, $baseFilePathStr);
            $indexStr = preg_replace('/(<script.+?src)="(.*?)"/', $newScript, $indexStr);
            $indexStr = preg_replace('/(\'api\/init.json\')/', $newJson, $indexStr);
            file_put_contents($filePath, $indexStr);
            $output->writeln('index Creating  successful!');
        }
    }
    //复制公共model文件
    public function createCommonModel($output)
    {
        $filePath = file_build_path(env('app_path'), '..', 'application', 'common', 'model', 'Common.php');
        $baseFilePath = file_build_path(__DIR__, '..', '..', 'src', 'model', 'Common.php');
        Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    }
    // //复制公共Route文件
    // public function createRoute($output, $moduleName = 'admin')
    // {
    //     $routeName = $moduleName . '.php';
    //     $filePath = file_build_path(env('app_path'), '..', 'route', $routeName);
    //     $baseFilePath = file_build_path(__DIR__, '..', '..', 'src', 'route', $routeName);
    //     Tool::handle($output, __FUNCTION__, $filePath, $baseFilePath);
    // }
    //复制公共静态文件文件
    public function createModule($output, $moduleName = 'admin')
    {
        //复制page文件
        $filePath = file_build_path(env('app_path'), '..', 'view', $moduleName, 'page');
        $baseFilePath = file_build_path(__DIR__, '..', '..', 'resources', 'html', 'page');
        Tool::handle($output, 'createResources', $filePath, $baseFilePath, true, 'copy_dir');




        $newModuleName = $moduleName . '/Page';
        $parameters['name'] = $newModuleName;
        $newoutput = Console::call('add:page', $parameters);
        $output->writeln($newoutput->fetch());

        //生成router
        $newModuleName = $moduleName;
        $parameters['name'] = $newModuleName;
        $newoutput = Console::call('add:route', $parameters);
        $output->writeln($newoutput->fetch());
    }
}