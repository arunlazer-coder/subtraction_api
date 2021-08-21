<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class AuthGates
{
    public function handle($request, Closure $next)
    {   
        
        if(!file_exists(storage_path('installed'))  ){
            if(!$request->is('install') &&  !$request->is('install/*')){
                return redirect('/install');
            }
        }
        
        $user = \Auth::user();

        if (!app()->runningInConsole() && $user) {
            $roles = Role::with('permissions')->get();
            
            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function (\App\User $user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        
        $currentRoute = explode('.', str_replace("admin.", "", \Route::currentRouteName()));

        if (!empty($currentRoute[0]) && !in_array($currentRoute[0], ['role', 'ajax', 'logout', 'dashboard', 'imageUpload', 'fileUpload', 'login', 'user', 'permission']) && (!Str::contains($currentRoute[0], 'LaravelInstaller'))) {
            $this->setPermission($currentRoute);
        }
        
        return $next($request);
    }

    Public function setPermission($currentRoute){
        
        $permissionList = [
            'index'         => '_access',
            'create'        => '_create',
            'edit'          => '_edit',
            'show'          => '_show',
            'delete'        => '_delete',
            'massDestroy'   =>'_delete',
        ];
        
        $gatekey  = $currentRoute[0].$permissionList[$currentRoute[1]];
        
        abort_unless(\Gate::allows($gatekey), 403);     
    }
}
