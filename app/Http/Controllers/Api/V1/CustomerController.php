<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Routing\Route;

class CustomerController extends ApiController
{
    protected $loginUser = 'api_customer';
    protected $shouldAuth = true;

    public function __construct(Route $route)
    {
        parent::__construct($route);
    }
}
