<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use View;
use App\User;
use App\UserDetail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $id;
    private $user;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->id = Auth::id();
            if($this->id!=null){
                $this->user = User::find($this->id);
                View::share('userLog', $this->user);
                View::share('userType', $this->user->userType);
                View::share('wholeName', $this->user->detail->firstName.' '.$this->user->detail->lastName);
                View::share('userName', $this->user->username);
                View::share('userPicture', $this->user->detail->photo);
            }
            return $next($request);
        });        
    }
}
