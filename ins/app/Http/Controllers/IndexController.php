<?php
namespace App\http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class IndexController extends Controller{
	public function home(){

		$work = DB::table("article")
					->select('article_key','article_time','article_face','article_title')
					->where("article_type","=",2)
					->latest('article_key')
					->limit(8)
					->get();

		$note = DB::table("article")
					->select('article_key','article_time','article_title')
					->where("article_type","=",1)
					->latest('article_key')
					->limit(8)
					->get();

		$study = DB::table("article")
					->select('article_key','article_time','article_title')
					->where("article_type","=",3)
					->latest('article_key')
					->limit(8)
					->get();
		$member = DB::table("member")
					->select("member_name","member_face",'member_key')
					->get();
		return view('index',['work' => $work, 'note' => $note, 'study' => $study,'member'=>$member]);
		
	}

	public function Content($type){
		$res_article = DB::table('article')
			->where('article_type',$type)
			->latest('article_key')
			->first();

		if($res_article){
			return view("indexContent",['article' => $res_article]);
		}else{
			return "文章不存在！";
		}
	}

	public function articleList($type){

		$typeName[1]="通知公告";
		$typeName[3]="学术交流";
		$typeName[4]="科研成果";
		$articleList = DB::table('article')
			->select('article_title','article_key','article_time')
			->where('article_type',$type)
			->latest('article_key')
			->paginate(15);
		return view('articleList',['typeName'=>$typeName[$type],'type'=>$type,'list'=>$articleList]);	
	}

	public function double($num){
		if($num == 5)
			return view('back');
		else
			return "test";
	}

	public function GZDT(){
		$articleList = DB::table("article")
			->select('article_title','article_content','article_author','article_face','article_key','article_time')
			->where('article_type',2)
			->latest('article_key')
			->paginate(15);
		return view('articleList',['typeName'=>'工作动态','type'=>2,'list'=>$articleList]);
	}
}

		
/*原生sql语句
	$work = DB::select("select article_title,article_key,article_time,article_face from article where article_type=2 order by article_time desc limit 8;");
	
	$note = DB::select("select article_title,article_key,article_time from article where article_type=1 order by article_time desc limit 8;");
	
	$study = DB::select("select article_title,article_key,article_time from article where article_type=3 order by article_time desc limit 8;");

	$res_article = DB::select("select * from article where article_type=? order by article_time desc limit 1;",[$type]);

	$articleList = DB::select("select article_title,article_key,article_time from article where article_type=? order by article_time desc limit 15;",[$type]);
*/
