<?php
namespace App\http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class FileController extends Controller{
	public function uploadImg(Request $request){
		$response=array();
		if(!$request->hasFile('file')){
			$response['code']=1;
			$response['msg']="图片上传失败";
			$response['data']['src']='';
			return json_encode($response);
		}
		$path = $request->file('file')->store('image');
		$url = Storage::url($path);
		$response['code'] = 0;
		$response['msg'] = '';
		$response['data']['src']=$url;
		return json_encode($response);
	}

	public function addFace(Request $request){
		$res = array();
		if($request->hasFile('file')){
			$path = $request->file('file')->store('face');
			$url = Storage::url($path);
			$res['src'] = $url;
		}
		return json_encode($res);
	}
}