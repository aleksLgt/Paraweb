<?php

namespace App\Console\Commands;

use App\Models\Permission;
use DB;
use Exception;
use Illuminate\Console\Command;
use Route;
use Throwable;

class UpdatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'once:update-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда получает все АПИ на проекте и сохраняет в таблицу permissions';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $currentRoutes = Route::getRoutes()->get();

        try {
            DB::transaction(function () use ($currentRoutes) {
                foreach ($currentRoutes as $route) {
                    if (!str_contains($route->uri, '_ignition')
                        && !str_contains($route->uri, 'sanctum')
                        && !str_contains($route->uri, 'broadcasting')
                        && !str_contains($route->uri, 'test')
                    ) {
                        $method = $this->getRouteMethod($route);
                        if (Permission::where('uri', $route->uri)
                            ->where('method', $method)
                            ->doesntExist()) {
                            $groupWithName = $route->getAction('as');
                            if (empty($groupWithName)) {
                                throw new Exception();
                            }

                            $groupWithNameArray = explode('|', $groupWithName);
                            if (Permission::where('name', $groupWithNameArray[1])->exists()) {
                                continue;
                            }

                            Permission::create([
                                'name'      =>  $groupWithNameArray[1],
                                'group'     =>  $groupWithNameArray[0],
                                'uri'       =>  '/' . $route->uri,
                                'method'    =>  $method,
                            ]);
                        }
                    }
                }
            });
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Command::SUCCESS;
    }

    protected function getRouteMethod(\Illuminate\Routing\Route $route)
    {
        $allMethods = $route->methods;
        $headKey = array_search('HEAD', $allMethods);
        if ($headKey !== false) {
            unset($allMethods[$headKey]);
        }

        return $allMethods[0];
    }
}
