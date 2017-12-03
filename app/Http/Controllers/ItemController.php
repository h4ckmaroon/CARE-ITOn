<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ItemCategory;
use App\Item;
use Validator;
use Redirect;
use Session;
use DB;
use Illuminate\Validation\Rule;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('isActive',1)->orderBy('name')->get();
        $deactivate = Item::where('isActive',0)->orderBy('name')->get();
        $categories = ItemCategory::where('isActive',1)->orderBy('name')->get();
        return View('item',compact('items','deactivate','categories'));
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
        $rules = [
            'name' => 'required|unique:item|max:50',
            'rate' => 'required',
            'categoryId' => 'required',
            'description' => 'nullable|max:140',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'name' => 'Item',
            'rate' => 'Rate',
            'categoryId' => 'Category',
            'description' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            try{
                DB::beginTransaction();
                Item::create([
                    'name' => trim($request->name),
                    'rate' => trim(str_replace(',','',$request->rate)),
                    'categoryId' => $request->categoryId,
                    'description' => trim($request->description)
                ]);
                DB::commit();
            }catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            $request->session()->flash('success', 'Successfully added.');  
            return Redirect('item');
        }
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
        $item = Item::findOrFail($id);
        return response()->json(['item'=>$item]);
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
        $rules = [
            'name' => ['required','max:50',Rule::unique('item')->ignore(trim($request->id))],
            'rate' => 'required',
            'categoryId' => 'required',
            'description' => 'nullable|max:140',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'name' => 'Item',
            'rate' => 'Rate',
            'categoryId' => 'Category',
            'description' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            try{
                DB::beginTransaction();
                $item = Item::findOrFail($id);
                $item->update([
                    'name' => trim($request->name),
                    'rate' => trim($request->rate),
                    'categoryId' => $request->categoryId,
                    'description' => trim($request->description)
                ]);
                DB::commit();
            }catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            $request->session()->flash('success', 'Successfully updated.');  
            return Redirect('item');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try{
            DB::beginTransaction();
            $checkItem = DB::table('item as i')
                ->join('request_detail as rd','rd.itemId','i.id')
                ->get();
            if(count($checkItem) > 0){
                $request->session()->flash('error', 'It seems that the record is still being used in other items. Deactivation failed.');
            }else{
                $item = Item::findOrFail($id);
                $item->update([
                    'isActive' => 0
                ]);
                $request->session()->flash('success', 'Successfully deactivated.');
            }
            DB::commit();
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errMess = $e->getMessage();
            return Redirect::back()->withErrors($errMess);
        }
        return Redirect('item');
    }

    public function reactivate(Request $request,$id)
    {
        try{
            DB::beginTransaction();
            $item = Item::findOrFail($id);
            $item->update([
                'isActive' => 1
            ]);
            DB::commit();
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errMess = $e->getMessage();
            return Redirect::back()->withErrors($errMess);
        }
        $request->session()->flash('success', 'Successfully reactivated.');  
        return Redirect('item');
    }
}
