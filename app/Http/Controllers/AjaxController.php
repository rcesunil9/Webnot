<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\User;
class AjaxController extends Controller
{
    protected $response;
    public $statusOk = 200;

    public function __construct(Request $res) {
	   
		$this->response = [
            "status" 	=> false,
			"error" 	=> "",
			"result" 	=> []
        ];
	}
    public function getUsersByType(Request $res)
    {
        $userType = $res->utype;
        $options = '<option value="">---Select---</option>';
        $data = User::where('createdBy',$res->parentId)->where('userRole',$userType)->orderBy('id','desc')->get();
        foreach ($data as $key => $d) {
            $options .='<option value="'.$d->id.'">'.$d->name.'/( '.$d->email.' )</option>';
        }
        $this->response['status'] = true;
        $this->response['result'] = $options;
        return response()->json($this->response, $this->statusOk);
    }
}
