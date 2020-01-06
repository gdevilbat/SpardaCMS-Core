<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Console;

use Nwidart\Modules\Commands\SeedCommand as NwidartSeedCommand;
use Illuminate\Support\Str;
use Nwidart\Modules\Module;
use Nwidart\Modules\Support\Config\GenerateConfigReader;

class SeedCommand extends NwidartSeedCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:sparda-seed';

    /**
     * @param Module $module
     *
     * @return void
     */
    public function moduleSeed(Module $module)
    {
        $seeders = [];
        $name = $module->getName();
        $config = $module->get('migration');
        if (is_array($config) && array_key_exists('seeds', $config)) {
            foreach ((array)$config['seeds'] as $class) {
                if (class_exists($class)) {
                    $seeders[] = $class;
                }
            }
        } else {
            $class = $this->getSeederName($name); //legacy support
            if (class_exists($class)) {
                $seeders[] = $class;
            } else {
                //look at other namespaces
                $classes = $this->getSeederNames($name);
                foreach($classes as $class) {
                    if (class_exists($class)) {
                        $seeders[] = $class;
                    } 
                }
            }
        }

        if (count($seeders) > 0) {
            array_walk($seeders, [$this, 'dbSeed']);
            $this->info("Module [$name] seeded.");
        }
    }

    /**
     * Get master database seeder name for the specified module under a different namespace than Modules.
     *
     * @param string $name
     *
     * @return array $foundModules array containing namespace paths
     */
    public function getSeederNames($name)
    {
        $name = Str::studly($name);

        $seederPath = GenerateConfigReader::read('seeder');
        $seederPath = str_replace('/', '\\', $seederPath->getPath());

        $foundModules = [];
        foreach($this->laravel['modules']->config('scan.paths') as $path) {
            $namespace = array_slice(explode('/', $path), -1)[0];
            $foundModules[] = ucfirst($namespace).'\\'.'SpardaCMS'.'\\Modules'. '\\' . $name . '\\' . $seederPath . '\\' . $name . 'DatabaseSeeder';
        }

        return $foundModules;
    }

}
