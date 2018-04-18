<?php
namespace App\http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BackController extends Controller{

	public function main(Request $request){
		$studyList=DB::table('article')->where('article_type',3)->oldest('article_key')->get();
		$workList=DB::table('article')->where('article_type',2)->oldest('article_key')->get();
		$scienceList=DB::table('article')->where('article_type',4)->oldest('article_key')->get();
		$noteList=DB::table('article')->where('article_type',1)->oldest('article_key')->get();

		return view('back',[
			'userName' => $request->session()->get('userName'),
			"studyList" =>$studyList,
			"workList"=>$workList,
			"noteList"=>$noteList,
			"scienceList"=>$scienceList
		]);
	}

	public function refresh(){
		$res=array();
		$res['member']['tot'] = 2;
		$res['field']['tot'] = 2;
		$fieldSet = DB::table('fie')->latest('fie_key')->where('fie_del',false)->get();
		$i=0;
		foreach ($fieldSet as $fie){
			$res['field'][$i]['field_key'] = $fie->fie_key;
			$res['field'][$i]['field_name'] = $fie->fie_name;
			$res['field'][$i]['field_article'] = htmlentities($fie->fie_article,ENT_QUOTES,"UTF-8");
			$res['field'][$i]['field_del'] = $fie->fie_del;
			$i++;
		}
		$res['field']['tot'] = $i;
		$memberSet = DB::table('member')
			->oldest('member_key')
			->leftJoin('fie','member.member_fie','=','fie.fie_key')
			->select('member.member_key','member.member_name','fie.fie_name','member.member_time','fie.fie_del')
			->get();
		$i=0;
		foreach ($memberSet as $member) {
			$res['member'][$i]['member_key'] = $member->member_key;
			$res['member'][$i]['member_name'] = $member->member_name;
			//判断一下研究方向有没有被删除
			if($member->fie_del)
				$res['member'][$i]['member_fie'] = '无';
			else
				$res['member'][$i]['member_fie'] = $member->fie_name;
			$res['member'][$i]['member_time'] = $member->member_time;
			$i++;
		}
		$res['member']['tot'] = $i;
		return json_encode($res);
	}

	public function login(Request $request){
		if($request->session()->has('userName')){
			return redirect('/manage');
		}
		if($request->has('userName')){
			$userName = $request->input("userName");
			$passWord = $request->input("passWord");
			$user = DB::table('admin')
					->where('user_name',$userName)
					->first();
			if($user){
				if($user->user_pwd == $passWord){
					$request->session()->put("userName",$userName);
					return redirect('/manage');
				}
			}

			return view("login",["note" => "用户名或密码不正确"]);
		}else
			return view('login',['note' => '']);
	}
	public function logout(Request $request){
		$request->session()->forget("userName");
		return redirect('/manage');
	}

	public function changePwd(Request $request,$new_pwd){
		if($request->session()->has('userName')){
			$userName = $request->session()->get('userName');
			DB::table("admin")->where('user_name',$userName)->update(['user_pwd'=>$new_pwd]);
			return 'y';
		}else{
			return 'n';
		}
	}

	public function createField(Request $request){
		$fieldName = $request->input('fieldName');
		$fieldText = $request->input('fieldText');
		$done = Db::table('fie')->insert(['fie_name'=>$fieldName,'fie_article'=>$fieldText,'fie_del'=>false]);
		if($done)
			return 'y';
		return 'n';
	}

	public function delField($field_key){
		$num = DB::table('fie')->where('fie_key',$field_key)->update(['fie_del' => true]);
		return $num;
	}

	public function createMember(Request $request){
		$time = date("Y-m-d H:i:s");
		$check = DB::table('member')->insert([
			'member_name'=>$request->input('memberName'),
			'member_face'=>$request->input('memberFace'),
			'member_fie'=>$request->input('memberField'),
			'member_article'=>$request->input('memberArticle'),
			'member_time'=>$time
		]);
		if($check)
			return 'y';
		return 'n';
	}

	public function delMember($memberKey){
		$num = DB::table('member')->where('member_key',$memberKey)->delete();
		return $num;
	}

	public function delArticle($id){
		$num = DB::table("article")->where('article_key',$id)->delete();
		return $num;
	}
}