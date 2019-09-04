<?php

namespace Kuiba\kuibaAdmin;

use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\App;
use think\facade\Config;
use think\facade\Env;

class Curd extends \think\console\Command
{
    protected $service = 'service';
    protected $facade = 'facade';
    protected $controller = 'controller';
    protected $model = 'model';

    protected $add = 'add';
    protected $edit = 'edit';
    protected $index = 'index';


    protected $model_path = 'app\\common\\model\\';

    protected $html_path = '\\..\\view\\';


    protected function configure()
    {
        $this->setName('curd:init')
            ->addArgument('name', Argument::OPTIONAL, "your name")
            // ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('make:life');
    }

    protected function execute(Input $input, Output $output)
    {

        $name = trim($input->getArgument('name'));
        $classname = $this->getClassName($name);


        // $namespace = trim(implode('\\', array_slice(explode('\\', $classname[4]), 0, -1)), '\\');

        // $namespace_new = trim(implode('\\', array_slice(explode('\\', $classname[4]), -2, 1)), '\\');
        // $namespace_new = strtolower($namespace_new);

        // $class = str_replace($classname[1] . '\\', '', $name);

        // $data_field = cc_format($class);
        // $output->writeln($classname[4]);

        // $output->writeln($namespace_new);
        // die;

        $pathname_service = $this->getPathName($classname[0]);
        $pathname_facade = $this->getPathName($classname[1]);
        $pathname_controller = $this->getPathName($classname[2]);
        $pathname_model = $this->getPathName($classname[3]);

        $pathname_index = $this->getHtmlName($classname[4]);
        $pathname_add = $this->getHtmlName($classname[5]);
        $pathname_edit = $this->getHtmlName($classname[6]);





        // $output->writeln($pathname_index);
        // die;




        //创建service
        if (is_file($pathname_service)) {
            $output->writeln('<error>' . $this->service . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_service))) {
                mkdir(dirname($pathname_service), 0755, true);
            }
            file_put_contents($pathname_service, $this->buildService($classname[0]));
            $output->writeln('<info>' . $this->service . ' Creating  successful!</info>');
        }
        //创建facade
        if (is_file($pathname_facade)) {
            $output->writeln('<error>' . $this->facade . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_facade))) {
                mkdir(dirname($pathname_facade), 0755, true);
            }
            file_put_contents($pathname_facade, $this->buildFacade($classname[1]));
            $output->writeln('<info>' . $this->facade . ' Creating  successful!</info>');
        }
        //创建controller
        if (is_file($pathname_controller)) {
            $output->writeln('<error>' . $this->controller . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_controller))) {
                mkdir(dirname($pathname_controller), 0755, true);
            }
            file_put_contents($pathname_controller, $this->buildController($classname[2]));
            $output->writeln('<info>' . $this->controller . ' Creating  successful!</info>');
        }

        //创建model
        if (is_file($pathname_model)) {
            $output->writeln('<error>' . $this->model . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_model))) {
                mkdir(dirname($pathname_model), 0755, true);
            }
            file_put_contents($pathname_model, $this->buildModel($classname[3]));
            $output->writeln('<info>' . $this->model . ' Creating  successful!</info>');
        }

        if (is_file($pathname_index)) {
            $output->writeln('<error>' . $this->index . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_index))) {
                mkdir(dirname($pathname_index), 0755, true);
            }
            file_put_contents($pathname_index, $this->buildIndex($classname[4]));
            $output->writeln('<info>' . $this->index . ' Creating  successful!</info>');
        }

        if (is_file($pathname_add)) {
            $output->writeln('<error>' . $this->add . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_add))) {
                mkdir(dirname($pathname_add), 0755, true);
            }
            file_put_contents($pathname_add, $this->buildAdd($classname[5]));
            $output->writeln('<info>' . $this->add . ' Creating  successful!</info>');
        }


        if (is_file($pathname_edit)) {
            $output->writeln('<error>' . $this->edit . ' already exists!</error>');
        } else {
            if (!is_dir(dirname($pathname_edit))) {
                mkdir(dirname($pathname_edit), 0755, true);
            }
            file_put_contents($pathname_edit, $this->buildEdit($classname[6]));
            $output->writeln('<info>' . $this->edit . ' Creating  successful!</info>');
        }
    }
    protected function getServiceStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . $this->service . '.stub';
    }
    protected function getFacadeStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . $this->facade . '.stub';
    }
    protected function getControllerStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . $this->controller . '.stub';
    }
    protected function getModelStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . $this->model . '.stub';
    }

    protected function getAddStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . 'a.' . $this->add . '.stub';
    }
    protected function getIndexStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . 'a.' . $this->index . '.stub';
    }
    protected function getEditStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . 'a.' . $this->edit . '.stub';
    }

    protected function buildService($name)
    {
        $stub = file_get_contents($this->getServiceStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $namespace_new = trim(implode('\\', array_slice(explode('\\', $namespace), 0, 2)), '\\');

        $class = str_replace($namespace . '\\', '', $name);

        $data_field = cc_format($class);

        return str_replace(['{%className%}', '{%actionSuffix%}', '{%namespace%}', '{%app_namespace%}', '{%namespace_new%}', '{%data_field%}'], [
            $class,
            Config::get('action_suffix'),
            $namespace,
            App::getNamespace(),
            $namespace_new,
            $data_field,
        ], $stub);
    }

    protected function buildFacade($name)
    {
        $stub = file_get_contents($this->getFacadeStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $namespace_new = trim(implode('\\', array_slice(explode('\\', $namespace), 0, 2)), '\\');

        $class = str_replace($namespace . '\\', '', $name);

        $data_field = cc_format($class);

        return str_replace(['{%className%}', '{%actionSuffix%}', '{%namespace%}', '{%app_namespace%}', '{%namespace_new%}', '{%data_field%}'], [
            $class,
            Config::get('action_suffix'),
            $namespace,
            App::getNamespace(),
            $namespace_new,
            $data_field,
        ], $stub);
    }

    protected function buildController($name)
    {
        $stub = file_get_contents($this->getControllerStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $namespace_new = trim(implode('\\', array_slice(explode('\\', $namespace), 0, 2)), '\\');

        $class = str_replace($namespace . '\\', '', $name);

        $data_field = cc_format($class);

        return str_replace(['{%className%}', '{%namespace%}', '{%data_field%}'], [
            $class,
            $namespace,
            $data_field,
        ], $stub);
    }


    protected function buildModel($name)
    {
        $stub = file_get_contents($this->getModelStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $namespace_new = trim(implode('\\', array_slice(explode('\\', $namespace), 0, 2)), '\\');

        $class = str_replace($namespace . '\\', '', $name);

        $data_field = cc_format($class);

        return str_replace(['{%className%}', '{%data_field%}'], [
            $class,
            $data_field,
        ], $stub);
    }

    protected function buildAdd($name)
    {
        $stub = file_get_contents($this->getAddStub());

        $data_field = strtolower(trim(implode('\\', array_slice(explode('\\', $name), -2, 1)), '\\'));

        return str_replace(['{%data_field%}'], [
            $data_field,
        ], $stub);
    }
    protected function buildIndex($name)
    {
        $stub = file_get_contents($this->getIndexStub());

        $data_field = strtolower(trim(implode('\\', array_slice(explode('\\', $name), -2, 1)), '\\'));

        return str_replace(['{%data_field%}'], [
            $data_field,
        ], $stub);
    }

    protected function buildEdit($name)
    {
        $stub = file_get_contents($this->getEditStub());

        $data_field = strtolower(trim(implode('\\', array_slice(explode('\\', $name), -2, 1)), '\\'));

        return str_replace(['{%data_field%}'], [
            $data_field,
        ], $stub);
    }


    protected function getPathName($name)
    {
        $name = str_replace(App::getNamespace() . '\\', '', $name);

        return Env::get('app_path') . ltrim(str_replace('\\', '/', $name), '/') . '.php';
    }

    protected function getHtmlName($name)
    {
        $name = str_replace(App::getNamespace() . '\\', '', $name);

        return Env::get('app_path') . ltrim(str_replace('\\', '/', $name), '/') . '.html';
    }
    protected function getClassName($name)
    {
        $appNamespace = App::getNamespace();

        $html_name = strtolower(str_replace('/', '\\', $name));

        if (strpos($name, $appNamespace . '\\') !== false) {
            return $name;
        }

        if (Config::get('app_multi_module')) {
            if (strpos($name, '/')) {
                list($module, $name) = explode('/', $name, 2);
            } else {
                $module = 'common';
            }
        } else {
            $module = null;
        }

        if (strpos($name, '/') !== false) {
            $name = str_replace('/', '\\', $name);
        }

        $result = [];
        array_push($result, $this->getNamespace($appNamespace, $module) . '\\' . $this->service . '\\' . $name);
        array_push($result, $this->getNamespace($appNamespace, $module) . '\\' . $this->facade . '\\' . $name);
        array_push($result, $this->getNamespace($appNamespace, $module) . '\\' . $this->controller . '\\' . $name);
        array_push($result, $this->model_path . $name);
        array_push($result, $this->html_path . $html_name . '\\' . $this->index);
        array_push($result, $this->html_path . $html_name . '\\' . $this->add);
        array_push($result, $this->html_path . $html_name . '\\' . $this->edit);

        // array_push($result, $this->html_path . $html_name);
        // array_push($result, $this->html_path . $html_name);

        return $result;
    }

    protected function getNamespace($appNamespace, $module)
    {
        return $module ? ($appNamespace . '\\' . $module) : $appNamespace;
    }
}