<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Set breadcrumbs name
     * @return void
     */
    public function breadcrumb($childPath = [])
    {
        $path = $this->setObjectPath('dashboard', 'admin.dashboard', 'fa-dashboard', true);

        if (count($childPath) > 0) {
            $path['active'] = false;
        }

        $path = collect([$path]);
        $path = $path->merge($childPath);
        view()->share('breadcrumbs', $path->toArray());
    }

    public function setObjectPath($name, $link, $icon, $active = false)
    {
        return ['name' => $name, 'link' => $link, 'icon' => $icon, 'active' => $active];
    }
}
