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
     * Indicator success proses
     */
    CONST SUCCESS = 'success';

    /**
     * Indicator error proses
     */
    CONST ERROR = 'error';

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

    /**
     * set object path link
     * @param string  $name
     * @param string  $link
     * @param string  $icon
     * @param boolean $active
     */
    public function setObjectPath($name, $link, $icon, $active = false)
    {
        return ['name' => $name, 'link' => $link, 'icon' => $icon, 'active' => $active];
    }


    /**
     * Build notification
     * @param string $type
     * @param string $message
     */
    public function setNotification($type, $message)
    {
        session()->flash('notification.type', $type);
        session()->flash('notification.message', $message);
    }

    /**
     * Redirect to route
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function toRoute($name)
    {
        return redirect()->route($name);
    }

    /**
     * Get errors exception proses
     * @param  \Exception $e
     * @return string
     */
    public function errorException(\Exception $e)
    {
        if (env('APP_DEBUG')) {
            $errorMessage = $e->getMessage().' - '.$e->getLine().' - '.$e->getFile();
            \Log::error($errorMessage);
        } else {
            $errorMessage = trans('error.500');
        }

        return $errorMessage;
    }
}
