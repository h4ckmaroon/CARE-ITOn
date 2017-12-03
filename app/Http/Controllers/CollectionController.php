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
        $collections = CollectionHeader::get();
        $requests = RequestHeader::get();
        return View('collection.index',compact('collections','requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return View('collection.create');

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


    public function transferFund($id)
    {
        $collection = CollectionHeader::findOrFail($id);
        $subtotal = 0.0;

        foreach($details as $detail){
            $subtotal = $detail->quantity * $detail->item->rate;
        }

        return View('collection.transferFund', compact($collection,$subtotal));
    }
}
