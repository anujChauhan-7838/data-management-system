<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function __construct(){
        $this->middleware(function ($request, $next) {
            if(Auth::user()){
                $modulePermissions = [];
                
                foreach (User::find(Auth::user()->id)->Userroles as $key => $value) {
                    $module                              = $value->module->toArray();
                    $module_name                         = strtolower($module['name']);
                    $modulePermissions[$module_name]     = $value->toArray();	
                    $modulePermissions[$module_name]['module_name'] = $module['name'];
                }
                // echo "<pre>";
                // print_r($modulePermissions);die;
                \View::share('allowedModules',$modulePermissions);
               }
            return $next($request);
        });
       }
}
