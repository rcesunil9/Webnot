<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SubadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('userRole',config('services.userRole.SUBADMIN'))->orderBy('id','desc')->paginate(config('services.paginate.LIMIT'));
        return view('admin.subadmin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $res
     * @return \Illuminate\Http\Response
     */
    public function store(Request $res)
    {
        $res->validate([
            'name' => 'required|min:3|max:30',
            'contact' => 'required|unique:users|numeric',
            'email' => 'required|unique:users|max:191',
            'password' => 'required|max:191|min:6',
            'is_active' => 'required|boolean',
            'state' => 'max:191',
            'city' => 'max:191',
            'zipcode' => 'nullable|numeric',
            'address_line1' => 'max:191',
            'address_line2' => 'max:191'
        ],[
            'email.required'=>'Sub Admin ID is required',
            'email.unique'=>'Sub Admin ID is duplicate'
        ]);
        $user = new User;
        $user->fill($res->all());
        $user->createdBy = Auth::id();
        $user->okGoogle = $res->password;
        $user->password = Hash::make($res->password);
        $user->userRole = config('services.userRole.SUBADMIN');
        if($user->save()){
            return redirect('/inSubAdmin')->with('msgOK','Successfull');
        }else{
            return redirect('/inSubAdmin')->with('msgERR','Something went wrong');
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
        $user = User::find($id);
        return view('admin.subadmin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $res
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $res, $id)
    {
        $res->validate([
            'name' => 'required|min:3|max:30',
            'contact' => 'required|numeric|unique:users,id',
            'email' => 'required|max:191|unique:users,id',
            'password' => 'required|max:191|min:6',
            'is_active' => 'required|boolean',
            'state' => 'max:191',
            'city' => 'max:191',
            'zipcode' => 'nullable|numeric',
            'address_line1' => 'max:191',
            'address_line2' => 'max:191'
        ],[
            'email.required'=>'Sub Admin ID is required',
            'email.unique'=>'Sub Admin ID is duplicate'
        ]);
        $user = User::find($id);
        $user->fill($res->all());
        if(isset($res->password)){
            $user->okGoogle = $res->password;
            $user->password = Hash::make($res->password);
        }
        if($user->save()){
            return redirect('/inSubAdmin')->with('msgOK','Successfull');
        }else{
            return redirect('/inSubAdmin')->with('msgERR','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = User::find($id);
        if($id->delete()){
            return redirect('/inSubAdmin')->with('msgOK','Deleted');
        }else{
            return redirect('/inSubAdmin')->with('msgERR','Something went wrong');
        }
    }
}
