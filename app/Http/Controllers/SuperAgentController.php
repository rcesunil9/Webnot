<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAgentController extends Controller
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
        $users = User::where('userRole',config('services.userRole.SUPERAGENT'))->orderBy('id','desc')->paginate(config('services.paginate.LIMIT'));
        return view('admin.superAgent.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subAdminList = User::where('userRole',config('services.userRole.SUBADMIN'))->orderBy('id','desc')->get();
        $masterList = User::where('userRole',config('services.userRole.MASTER'))->orderBy('id','desc')->get();
        return view('admin.superAgent.create',compact('subAdminList','masterList'));
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
            'masterId' => 'required|numeric',
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
            'email.required'=>'Super Agent ID is required',
            'email.unique'=>'Super Agent ID is duplicate',
            'masterId.required' => 'Please select master',
            'masterId.numeric' => 'Invalid master ID'
        ]);
        $user = new User;
        $user->fill($res->all());
        $user->createdBy = $res->masterId;
        $user->okGoogle = $res->password;
        $user->password = Hash::make($res->password);
        $user->userRole = config('services.userRole.SUPERAGENT');
        if($user->save()){
            return redirect('/inSuperAgent')->with('msgOK','Successfull');
        }else{
            return redirect('/inSuperAgent')->with('msgERR','Something went wrong');
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
        $subAdminList = User::where('userRole',config('services.userRole.SUBADMIN'))->orderBy('id','desc')->get();
        $masterInfo = User::find($user->createdBy);        
        $masterList = User::where('userRole',config('services.userRole.MASTER'))->where('createdBy',$masterInfo->createdBy)->orderBy('id','desc')->get();
        return view('admin.superAgent.edit',compact('user','masterList','subAdminList'));
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
            'masterId' => 'required|numeric',
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
            'email.required'=>'Super Agent ID is required',
            'email.unique'=>'Super Agent ID is duplicate',
            'masterId.required' => 'Please select master',
            'masterId.numeric' => 'Invalid master ID'
        ]);
        $user = User::find($id);
        $user->fill($res->all());
        $user->createdBy = $res->masterId;
        if(isset($res->password)){
            $user->okGoogle = $res->password;
            $user->password = Hash::make($res->password);
        }
        if($user->save()){
            return redirect('/inSuperAgent')->with('msgOK','Successfull');
        }else{
            return redirect('/inSuperAgent')->with('msgERR','Something went wrong');
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
            return redirect('/inSuperAgent')->with('msgOK','Deleted');
        }else{
            return redirect('/inSuperAgent')->with('msgERR','Something went wrong');
        }
    }
}
