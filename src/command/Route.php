<?php

namespace Kuiba\kuibaAdmin\command;

use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use Kuiba\kuibaAdmin\facade\Tool;

class Route extends \think\console\Command
{

    protected $type = 'route';
    protected function configure()
    {
        $this->setName('add:route')
            ->addArgument('name', Argument::OPTIONAL, "your name")
            // ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('make:life');
    }

    protected function execute(Input $input, Output $output)
    {
        $name = trim($input->getArgument('name'));
        empty($name) && $name = 'admin';
        $name = strtolower($name);
        $Path = file_build_path(env('app_path'), '..', $this->type, $name . '.php');

        //创建
        if (is_file($Path)) {
            $output->writeln($Path . ' already exists!');
        } else {
            if (!is_dir(dirname($Path))) {
                mkdir(dirname($Path), 0755, true);
            }
            $pageFilePath = file_build_path(__DIR__, '..', '..', 'resources', 'html', 'page');
            $dirToArray = dirToArray($pageFilePath);
            $page = $this->build($name);
            foreach ($dirToArray as $key => $value) {
                $newValue = str_replace('.html', '', $value);
                $routeStr = $this->buildRoute($newValue, $name);
                $page .= $routeStr . PHP_EOL;
            }
            $page .= '});';
            file_put_contents($Path, $page);
            $output->writeln($this->type . ' Creating  successful!');
        }
    }

    protected function getStub()
    {
        $stubPath = file_build_path(__DIR__, 'stubs', 'route.stub');
        return $stubPath;
    }


    protected function build($name)
    {
        $stub = file_get_contents($this->getStub());
        $module = $name;
        return str_replace(['{%module%}'], [
            $module,
        ], $stub);
    }
    protected function buildRoute($name, $module)
    {
        $stubPath = file_build_path(__DIR__, 'stubs', 'routeitem.stub');
        $stub = file_get_contents($stubPath);
        $module = $module;

        $item = $name;
        return str_replace(['{%item%}', '{%module%}'], [
            $item,
            $module
        ], $stub);
    }
}