<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class RoutePermissionChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        $currentPath = trim($request->server('PATH_INFO'),'/');
        $currentPathArr = explode('/',$currentPath);
        
        if(count($currentPathArr) == 1){
            $moduleId = $this->searchModuleForId($currentPathArr[0]);
            if($moduleId){
                $user = auth()->user();
                if($user->userRoles->count()){
                    $permittedModules = $user->userRoles->toArray();
                    $moduleName = $this->searchModuleForId($permittedModules[0]['module_id'],'name');
                    foreach($permittedModules as $key => $value){
                        if($moduleId ==   $value['module_id']){
                            if($value['add'] == 1 || $value['edit'] == 1 || $value['view'] == 1 || $value['delete'] == 1){
                                return $next($request);
                            }else{
                                
                                return redirect(strtolower($moduleName));
                            }

                        }
                      
                    }
                    return redirect(strtolower($moduleName));

                }else{
                    return redirect('stuck');
                }
            }else{
                return redirect('stuck');
            }
        }else if(count($currentPathArr) == 2 || count($currentPathArr) == 3){
            $moduleId = $this->searchModuleForId($currentPathArr[0]);
            if($moduleId){
                $user = auth()->user();
                if($user->count()){
                    $permittedModules = $user->userRoles->toArray();
                    $moduleName = $this->searchModuleForId($permittedModules[0]['module_id'],'name');
                    foreach($permittedModules as $key => $value){
                        if($moduleId ==   $value['module_id']){
                            $currentPathArr[1]  = $currentPathArr[1] == 'store'?'add':$currentPathArr[1];
                            if(isset($value[$currentPathArr[1]]) && $value[$currentPathArr[1]] == 1){
                                return $next($request);
                            }else{
                                return redirect(strtolower($moduleName));
                            }

                        }
                      
                    }
                    return redirect(strtolower($moduleName));

                }else{
                    return redirect('stuck');
                }
            }else{
                return redirect('stuck');
            }
            
        }
        
        
    }

    private function searchModuleForId($module ,$field = 'id') {
        
        $modules = Module::all();
        foreach ($modules->toArray() as $key => $val) {
            if (strtolower($val['name']) === $module ||  $val['id'] == $module) {
                return $val[$field];
            }
        }
        return null;
     }
}


