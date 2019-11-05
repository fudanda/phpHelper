<?php

namespace Kuiba\kuibaAdmin\command;

use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use Kuiba\kuibaAdmin\facade\Tool;

class Model extends \think\console\Command
{

    protected $type = 'model';
    protected function configure()
    {
        $this->setName('add:mod')
            ->addArgument('name', Argument::OPTIONAL, "your name")
            // ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('make:life');
    }

    protected function execute(Input $input, Output $output)
    {
        $name = trim($input->getArgument('name'));
        $className = Tool::getClassName($name, $this->type);
        //路径
        $Path = Tool::getPathName($className);
        // 创建
        if (is_file($Path)) {
            $output->writeln($Path . ' already exists!');
        } else {
            if (!is_dir(dirname($Path))) {
                mkdir(dirname($Path), 0755, true);
            }
            file_put_contents($Path, $this->build($className));
            $output->writeln($this->type . ' Creating  successful!');
        }
    }

    protected function getStub()
    {
        $stubPath = file_build_path(__DIR__, 'stubs', '' . $this->type . '.stub');
        return $stubPath;
    }


    protected function build($name)
    {
        $stub = file_get_contents($this->getStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $namespace_new = trim(implode('\\', array_slice(explode('\\', $namespace), 0, 2)), '\\');

        $class = str_replace($namespace . '\\', '', $name);

        $data_field = cc_format($class);

        return str_replace(['{%className%}', '{%data_field%}'], [
            $class,
            $data_field,
        ], $stub);
    }
}