<?php
namespace App\http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ArticleController extends Controller{
	public function articleUp(Request $request){
		$article_title=$request->input('article_title');
		$article_content=$request->input('article_content');
		$article_photo=$request->input('article_photo');
		$article_check=$request->input('article_check');
		$article_note=$request->input('article_note');
		$article_type=$request->input('article_type');
		$article_from=$request->input('article_from');
		$article_author=$request->input('article_author');
		$article_face=$request->input('article_face');
		$time = date("Y-m-d H:i:s");

		DB::table('article')->insert([
			'article_title'=>$article_title,
			'article_content'=>$article_content,
			'article_note'=>$article_note,
			'article_type'=>$article_type,
			'article_author'=>$article_author,
			'article_photo'=>$article_photo,
			'article_check'=>$article_check,
			'article_from'=>$article_from,
			'article_face'=>$article_face,
			'article_time'=>$time
		]);

		return 'done';
	}

	public function articleGet($id){
		$res_article = DB::table('article')
			->where('article_key',$id)
			->first();

		if($res_article){
			$readNum = $res_article->article_read + 1;
			DB::table('article')
				->where('article_key',$res_article->article_key)
				->update(['article_read' => $readNum]);
			return view("article",['article' => $res_article]);
		}else{
			return "文章不存在！";
		}
	}

	public function fieldGet($fie_key){
		$field = DB::table('fie')
				->where([
					['fie_del','=',false],
					['fie_key','=',$fie_key]
				])->first();
		if($field){
			return view('field',['field'=>$field]);
		}else{
			return '数据不存在！';
		}
	}

	public function memberGet($member_key){
		$person = DB::table('member')
					->where('member_key',$member_key)
					->first();
		return view("member",['member'=>$person]);
	}
}



/* 原生sql语句
$res_work = DB::select("select * from article where type=2 order by article_time desc limit 10;");

DB::insert('insert into article(article_title,article_content,article_note,article_type,article_author,article_photo,article_check,article_from,article_face,article_time) value(?,?,?,?,?,?,?,?,?,sysdate())',[$article_title,$article_content,$article_note,$article_type,$article_author,$article_photo,$article_check,$article_from,$article_face]);

