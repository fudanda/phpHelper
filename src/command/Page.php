<?php

namespace Kuiba\kuibaAdmin\command;

use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use Kuiba\kuibaAdmin\facade\Tool;

class Page extends \think\console\Command
{

    protected $type = 'controller';
    protected function configure()
    {
        $this->setName('add:page')
            ->addArgument('name', Argument::OPTIONAL, "your name")
            // ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('make:life');
    }

    protected function execute(Input $input, Output $output)
    {
        $name = trim($input->getArgument('name'));
        $className = Tool::getClassName($name, $this->type);
        //控制器路径
        $Path = Tool::getPathName($className);

        // 创建controller
        if (is_file($Path)) {
            $output->writeln($Path . ' already exists!');
        } else {
            if (!is_dir(dirname($Path))) {
                mkdir(dirname($Path), 0755, true);
            }
            $pageFilePath = file_build_path(__DIR__, '..', '..', 'resources', 'html', 'page');
            $dirToArray = dirToArray($pageFilePath);
            $page = $this->build($className);
            foreach ($dirToArray as $key => $value) {
                $newValue = str_replace('.html', '', $value);
                $functionStr = $this->buildFunction($newValue);
                $page .= $functionStr . PHP_EOL;
            }
            $page .= '}';
            file_put_contents($Path, $page);
            $output->writeln($this->type . ' Creating  successful!');
        }
    }

    protected function getStub()
    {
        $stubPath = file_build_path(__DIR__, 'stubs', 'page.stub');
        return $stubPath;
    }


    protected function build($name)
    {
        $stub = file_get_contents($this->getStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $namespace_new = trim(implode('\\', array_slice(explode('\\', $namespace), 0, 2)), '\\');

        $class = str_replace($namespace . '\\', '', $name);

        $data_field = cc_format($class);

        return str_replace(['{%className%}', '{%namespace%}'], [
            $class,
            $namespace,
        ], $stub);
    }
    protected function buildFunction($name)
    {
        $stubPath = file_build_path(__DIR__, 'stubs', 'function.stub');
        $stub = file_get_contents($stubPath);
        $functionName = $name;
        return str_replace(['{%functionName%}'], [
            $functionName,
        ], $stub);
    }
}