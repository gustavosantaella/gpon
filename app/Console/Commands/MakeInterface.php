<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Interface.';

    protected $type = 'Interface';

    protected function getStub(){
        return base_path('stubs/interface.stub');
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Interfaces';
    }

    protected function replaceClass($stub, $name){
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('{{interface_name}}', $class, $stub);
    }
}
