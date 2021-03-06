<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\UserDetail;
use Validator;
use Redirect;
use Session;
use DB;
use Illuminate\Validation\Rule;


class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('Auth.register');
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
            'username' => 'required|string|max:255',
            'password' => 'required|min:6',
            'cpassword' => 'required|min:6|same:password',
            'accountNo' => 'required|max:12',
            'firstName' => ['required','max:50',Rule::unique('user_detail')->where('middleName',trim($request->middleName))->where('lastName',trim($request->lastName))],
            'middleName' => 'nullable|max:50',
            'lastName' => 'required|max:50',
            'contactNo' => 'required|max:50',
            'email' => 'required|email|max:75|unique:user_detail',
        ];
        $messages = [
            'firstName.unique' => 'Name is already taken',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'                
        ];
        $niceNames = [
            'username' => 'Username',
            'password' => 'Password',
            'cpassword' => 'Confirm Password',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'contactNo' => 'Contact No.',
            'email' => 'Email',
            'accountNo' => 'Account No.',
            'photo' => 'User Picture'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->except('photo'));
        }
        else{
            try{
                DB::beginTransaction();
                $file = $request->file('photo');
                $userPic = "";
                if($file == '' || $file == null){
                    $userPic = "pics/steve.jpg";
                }else{
                    $date = date("Ymdhis");
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $userPic = "pics/".$date.'.'.$extension;
                    $request->file('photo')->move("pics",$userPic);    
                }
                $user = User::create([
                    'username' => trim($request->username),
                    'password' => bcrypt(trim($request->password)),
                    'userType' => 2,
                    'accountNo' => trim($request->accountNo)
                ]);
                UserDetail::create([
                    'userId' => $user->id,
                    'firstName' => trim($request->firstName),
                    'middleName' => trim($request->middleName),
                    'lastName' => trim($request->lastName),
                    'contactNo' => trim($request->contact),
                    'email' => trim($request->email),
                    'photo' => $userPic
                ]);
                DB::commit();
            }catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            $request->session()->flash('success', 'Successfully added.');  
            return Redirect('login');
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
}
