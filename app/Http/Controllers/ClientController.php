<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
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
        $users = User::where('userRole',config('services.userRole.CLIENT'))->orderBy('id','desc')->paginate(config('services.paginate.LIMIT'));
        return view('admin.client.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subAdminList = User::where('userRole',config('services.userRole.SUBADMIN'))->orderBy('id','desc')->get();
        // $masterList = User::where('userRole',config('services.userRole.MASTER'))->orderBy('id','desc')->get();
        // $superAgentList = User::where('userRole',config('services.userRole.SUPERAGENT'))->orderBy('id','desc')->get();
        return view('admin.client.create',compact('subAdminList'));
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
            'agentId' => 'required|numeric',
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
            'agentId.required' => 'Please select master',
            'agentId.numeric' => 'Invalid master ID'
        ]);
        $user = new User;
        $user->fill($res->all());
        $user->createdBy = $res->agentId;
        $user->okGoogle = $res->password;
        $user->password = Hash::make($res->password);
        $user->userRole = config('services.userRole.CLIENT');
        if($user->save()){
            return redirect('/inClient')->with('msgOK','Successfull');
        }else{
            return redirect('/inClient')->with('msgERR','Something went wrong');
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
        // Find Client
        $user = User::find($id);
        
        // Get Agent Of Client
        $agentInfo = User::find($user->createdBy);
        
        // Get Super Agent Info Of Agent
        $superAgentInfo = User::find($agentInfo->createdBy);
        
        // Get Master Info Of Super Agent
        $masterInfo = User::find($superAgentInfo->createdBy);
        
        // Get Sub Admin Info Of Master
        $subAdminInfo = User::find($masterInfo->createdBy);
        
        // Get All Sub Admin List
        $subAdminList = User::where('userRole',config('services.userRole.SUBADMIN'))->orderBy('id','desc')->get();
        
        // Get All Master List Of Sub Admin Info
        $masterList = User::where('userRole',config('services.userRole.MASTER'))->where('createdBy',$subAdminInfo->id)->orderBy('id','desc')->get();
        
        // Get All Super Agent List Of Master Info
        $superAgentList = User::where('userRole',config('services.userRole.SUPERAGENT'))->where('createdBy',$masterInfo->id)->orderBy('id','desc')->get();

        // Get All Agent List Of Super Agent
        $agentList = User::where('userRole',config('services.userRole.AGENT'))->where('createdBy',$superAgentInfo->id)->orderBy('id','desc')->get();
        
        return view('admin.client.edit',compact(
            'user',
            'superAgentInfo',
            'masterInfo',
            'subAdminInfo',
            'agentInfo',
            'subAdminList',
            'masterList',
            'superAgentList',
            'agentList'
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
            'agentId' => 'required|numeric',
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
            'agentId.required' => 'Please select master',
            'agentId.numeric' => 'Invalid master ID'
        ]);
        $user = User::find($id);
        $user->fill($res->all());
        $user->createdBy = $res->agentId;
        if(isset($res->password)){
            $user->okGoogle = $res->password;
            $user->password = Hash::make($res->password);
        }
        if($user->save()){
            return redirect('/inClient')->with('msgOK','Successfull');
        }else{
            return redirect('/inClient')->with('msgERR','Something went wrong');
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
            return redirect('/inClient')->with('msgOK','Deleted');
        }else{
            return redirect('/inClient')->with('msgERR','Something went wrong');
        }
    }
}
