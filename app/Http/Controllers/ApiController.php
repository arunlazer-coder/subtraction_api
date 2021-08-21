<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Auth;
use Illuminate\Routing\Route;

class ApiController extends BaseController
{
	protected $routeInfo = [];

	protected $auths = [];
	protected $loginUser = null;
	protected $shouldAuth = false;

    public $defaultPageLimit = 25;
    public $defaultPageLimitList =[
    	1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
    ];

    public $defaultSortFields = [
    	'date'	=> 'table.created_at',
    	'email'	=> 'table.email',
    	'name'	=> 'table.name',
    	'id'	=> 'table.id',
    	'status'=> 'table.status',
    	'title'	=> 'table.title',
    ];
    public $defaultSort 	= 'date';
	public $defaultSortBy 	= 'desc';
	public $currentSortFields = [];

	public function __construct (Route $route)
	{
		$this->currentRoute = $route->getAction();
		$this->currentRoute['params'] = $route->parameters();

		$currentRouteprefix = str_replace('/customer','', $this->currentRoute['prefix']);
		$version = substr($currentRouteprefix, -1);
		$params = $this->currentRoute['params'];
	}

	public function responseJson ($json)
	{
		return response()->json($json);
	}

	public function responseJsonSuccess ($json)
	{
		return response()->json(array_merge(['success'=>true], $json));
	}

	public function responseJsonError($json)
	{
		return response()->json(array_merge(['success'=>false], $json));
	}

	public function responseJsonErrorList($errors)
	{
		if(is_array($errors)){
			$errors =  implode(' & ', array_values($errors));
		}
		return $this->responseJsonError(['errors'=>$errors]);
		// foreach ($errors as $K=>$V) {
		// 	$errors[$K] = [
		// 		'field' => $K,
		// 		'message' => $V,
		// 	];
		// }
		// return $this->responseJsonError(['errors'=>array_values($errors)]);
	}



}
