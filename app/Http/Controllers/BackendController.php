<?php

namespace App\Http\Controllers;

use Auth;
use App\Component\UserAuth as UserAuthComponent;
use App\Http\Controllers\Controller as BaseController;
use Excel;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Filesystem\Filesystem;


class BackendController extends BaseController
{	
	public $controllerName = '';
	public $actionName = '';
	public $seoRequire = '';

	public $paginationLimit = 10;

    public function __construct(Route $route)
    {	
		// parent::__construct();
		
		$routeNames = explode('.', $route->getName());
        if (isset($routeNames[2])) {
            $this->controllerName = $routeNames[1];
            $this->actionName 	= $routeNames[2];
        }
		require_once app_path('Includes'.DS.'init.php');
        
        if($this->seoRequire){
            \App\Component\Helper::seoTitle($this->controllerName, $this->actionName);
        }
    }
    
}
