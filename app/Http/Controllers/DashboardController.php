<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\UserDetail;
use App\Item;
use App\ItemCategory;
use Validator;
use Redirect;
use Session;
use DB;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('isActive',1)->orderBy('name')->get();
        return View('dashboard',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                    $result =0; //qrCode not recognized
                 }
                
            }
            
            return $result;
    }
    
}
