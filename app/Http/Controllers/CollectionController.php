<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemCategory;
use App\RequestHeader;
use App\RequestDetail;
use App\CollectionHeader;
use App\CollectionDetail;
use App\User;
use Auth;
use Validator;
use Redirect;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon as Carbon;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        $collections = [];
        if($user->userType==2){
            $collections = CollectionHeader::get();
        }
        return View('collection.index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return View('collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkCode(Request $request){
        $result =0;
            if ($request->data) {
                $isExist = true;
                $isExist = RequestHeader::where('qrCode',$request->data)->first();
                if ($isExist) {
                  
                    $result =1;
                 }else{
                    $result =0;
                 }
                
            }
            
            return $result;
    }
}
