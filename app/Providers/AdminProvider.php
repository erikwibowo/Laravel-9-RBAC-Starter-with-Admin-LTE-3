<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class AdminProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initModules();
    }

    private function initModules()
    {
        $modules = Module::getOrdered();
        $modulemenus = [];

        if ($modules) {
            foreach ($modules as $module) {
                $moduleDetails = $this->getModuleDetails($module);

                if (!empty($moduleDetails['menus'])) {
                    $modulemenus[] = [
                        'module'        => $module->getLowerName(),
                        'menu_count'    => count($moduleDetails['menus']),
                        'menus'         => $moduleDetails['menus'],
                    ];
                }
            }
        }

        View::share('modulemenus', $modulemenus);
    }

    private function getModuleDetails($module)
    {
        $moduleJson = $module->getPath() . '/module.json';
        return json_decode(file_get_contents($moduleJson), true);
    }
}
