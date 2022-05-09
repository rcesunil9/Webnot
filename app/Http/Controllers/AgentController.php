<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
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
        $users = User::where('userRole',config('services.userRole.AGENT'))->orderBy('id','desc')->paginate(config('services.paginate.LIMIT'));        
        return view('admin.agent.index',compact('users'));
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
        $superAgentList = User::where('userRole',config('services.userRole.SUPERAGENT'))->orderBy('id','desc')->get();
        return view('admin.agent.create',compact('subAdminList','masterList','superAgentList'));
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
            'superAgentId' => 'required|numeric',
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
            'superAgentId.required' => 'Please select master',
            'superAgentId.numeric' => 'Invalid master ID'
        ]);
        $user = new User;
        $user->fill($res->all());
        $user->createdBy = $res->superAgentId;
        $user->okGoogle = $res->password;
        $user->password = Hash::make($res->password);
        $user->userRole = config('services.userRole.AGENT');
        if($user->save()){
            return redirect('/inAgent')->with('msgOK','Successfull');
        }else{
            return redirect('/inAgent')->with('msgERR','Something went wrong');
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
        // Find Agent
        $user = User::find($id);
        // Get Super Agent Info Of Agent
        $superAgentInfo = User::find($user->createdBy);
        // Get Master Info Of Super Agent
        $masterInfo = User::find($superAgentInfo->createdBy);
        // Get Sub Admin Info Of Master
        $subAdminInfo = User::find($masterInfo->createdBy);
        // Get All Sub Admin List
        $subAdminList = User::where('userRole',config('services.userRole.SUBADMIN'))->orderBy('id','desc')->get();
        // Get All Master List Of Sub Admin Info
        $masterList = User::where('userRole',config('services.userRole.MASTER'))->where('createdBy',$subAdminInfo->id)->orderBy('id','desc')->get();
        // Get All Super Admin List Of Master Info
        $superAgentList = User::where('userRole',config('services.userRole.SUPERAGENT'))->where('createdBy',$masterInfo->id)->orderBy('id','desc')->get();
        
        return view('admin.agent.edit',compact(
            'user',
            'superAgentInfo',
            'masterInfo',
            'subAdminInfo',
            'subAdminList',
            'masterList',
            'superAgentList'
        ));
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
            'superAgentId' => 'required|numeric',
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
            'superAgentId.required' => 'Please select master',
            'superAgentId.numeric' => 'Invalid master ID'
        ]);
        $user = User::find($id);
        $user->fill($res->all());
        $user->createdBy = $res->superAgentId;
        if(isset($res->password)){
            $user->okGoogle = $res->password;
            $user->password = Hash::make($res->password);
        }
        if($user->save()){
            return redirect('/inAgent')->with('msgOK','Successfull');
        }else{
            return redirect('/inAgent')->with('msgERR','Something went wrong');
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
            return redirect('/inAgent')->with('msgOK','Deleted');
        }else{
            return redirect('/inAgent')->with('msgERR','Something went wrong');
        }
    }
}
