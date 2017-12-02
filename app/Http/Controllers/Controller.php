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
            $this->user = User::find($this->id);
            $userType = $this->user->userType;
            $wholeName = $this->user->detail->firstName.' '.$this->user->detail->lastName;;
            $userName = $this->user->username;
            $userPicture = $this->user->detail->photo;
            View::share('user', $this->user);
            View::share('userType', $this->user->userType);
            View::share('wholeName', $wholeName);
            View::share('userName', $userName);
            View::share('userPicture', $userPicture);
            return $next($request);
        });        
    }
}
