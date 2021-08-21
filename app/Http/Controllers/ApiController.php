<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Auth;
use Illuminate\Routing\Route;
use DB;
use App\Component\Helper;
use App\Model\Customer;
use App\Model\Trip;
use App\Model\Load;
use App\Model\State;
use App\Model\Country;
use App\Model\City;
use Request;

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

		$this->routeInfo['version'] = $version;
		if ($this->loginUser) {
			$this->auths[$this->loginUser] = Auth::guard($this->loginUser);
		}
		require_once app_path('Includes'.DS.'init.php');

		$this->middleware('api.request:'.$this->routeInfo['version'].','.$this->loginUser.','.$this->shouldAuth);
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

	public function getAuthCustomerInfo()
	{
		$id = $this->auths[$this->loginUser]->id();

		$user = DB::table(Customer::TN.' AS tbl');
		$user =	$user->selectRaw('tbl.*')->first();
		$json = [];
		$json['user'] = [
			'id'				=> $user->id,
			'name' 				=> $user->first_name,
			'name' 				=> $user->last_name,
			'name' 				=> trim($user->first_name . ' ' . $user->last_name),
			'mobile' 			=> $user->mobile,
			'phone' 			=> $user->phone,
			'address' 			=> $user->address,
		];

		$json['user']['profile_photo_path'] = $user->profile_photo_path ? $user->profile_photo_path : "https://banner2.cleanpng.com/20180920/yko/kisspng-computer-icons-portable-network-graphics-avatar-ic-5ba3c66df14d32.3051789815374598219884.jpg";
		if (!empty($user->profile_photo_path)) {
			$json['user']['profile_photo_path'] = url(str_replace(URL_PUBLIC, '', URL_CUSTOMER . str_replace(DS, '/', $user->profile_photo_path)));
		}

		return $json;
	}



}
