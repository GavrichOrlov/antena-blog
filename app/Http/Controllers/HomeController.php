<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use URL;
use Session;
use Cookie;
use Redirect;
use Input;
use App\User;
use DB;
class HomeController extends Controller
{
	public function __construct()
	{
	    // $this->middleware('auth');

	}
	public function index(Request $request){
        $categories = DB::table('category')->get();

		$rss_sites = DB::table('rss_site')
			->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
			->orderBy('rss_temp.postdatetime', 'desc')
            ->get();
        // $results = $this->setAllRssData();
        // var_dump($results);
		$results = DB::table('rss_site')
			->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
		    ->select(DB::raw("SUM(pc_in) as rss_per_pc_in, SUM(pc_out) as rss_per_pc_out, SUM(sp_in) as rss_per_sp_in, SUM(sp_out) as rss_per_sp_out"), 'rss_temp.*', 'rss_site.*')
            ->groupBy('rss_id')
	        ->paginate(30, ['*'], 'page', 1);
        return view('welcome')->with('categories', $categories)->with('rss_sites', $rss_sites)->with('results', $results)->with('active', "1")->with('class', "index");
    }

	public function categoryShowById($id = 0){
        $categories = DB::table('category')->get();
        if ($id == 1) {
        	$rss_sites = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
				->orderBy('rss_temp.postdatetime', 'desc')
	            ->get();
			$results = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
			    ->select(DB::raw("SUM(pc_in) as rss_per_pc_in, SUM(pc_out) as rss_per_pc_out, SUM(sp_in) as rss_per_sp_in, SUM(sp_out) as rss_per_sp_out"), 'rss_temp.*', 'rss_site.*')	
	            ->groupBy('rss_id')
	        	->paginate(30, ['*'], 'page', 1);
        }
        else{
        	$rss_sites = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
				->where('category_id', $id)
				->orderBy('rss_temp.postdatetime', 'desc')
	            ->get();
			$results = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
			    ->select(DB::raw("SUM(pc_in) as rss_per_pc_in, SUM(pc_out) as rss_per_pc_out, SUM(sp_in) as rss_per_sp_in, SUM(sp_out) as rss_per_sp_out"), 'rss_temp.*', 'rss_site.*')
				->where('category_id', $id)
	            ->groupBy('rss_id')
	        	->paginate(30, ['*'], 'page', 1);
        }
        return view('welcome')->with('categories', $categories)->with('rss_sites', $rss_sites)->with('results', $results)->with('active', $id)->with('class', "index");
        // return view('welcome')->with('categories', $categories)->with('active', $id)->with('class', "index");
	}

	public function blogs(Request $request){
        $categories = DB::table('category')->get();

    	$rss_sites = DB::table('rss_site')
		    ->orderBy(DB::raw("`rss_pc_in` + `rss_sp_in`"), 'desc')
		    ->get();

        $pc_in = DB::table('rss_site')
			    ->where('id', '>', 0)
			    ->sum('rss_pc_in');
        $pc_out = DB::table('rss_site')
			    ->where('id', '>', 0)
			    ->sum('rss_pc_out');
        $sp_in = DB::table('rss_site')
			    ->where('id', '>', 0)
			    ->sum('rss_sp_in');
        $sp_out = DB::table('rss_site')
			    ->where('id', '>', 0)
			    ->sum('rss_sp_out');
		$in_out_datas = array("pc_in"=>$pc_in, "pc_out"=>$pc_out, "sp_in"=>$sp_in, "sp_out"=>$sp_out, "total_in"=>($pc_in + $sp_in), "total_out"=> ($pc_out + $sp_out));

        return view('blogs')->with('categories', $categories)->with('rss_sites', $rss_sites)->with('in_out_datas', $in_out_datas)->with('active', "0")->with('class', "blogs");
	}

	public function blogById($id = 0){
        $categories = DB::table('category')->get();

    	$results = DB::table('rss_temp')
    		->where('rss_id', $id)
		    ->get();

        $in_out_datas = DB::table('rss_site')
			->where('id', $id)->first();

		$agent = new \Jenssegers\Agent\Agent;

		$result = $agent->isDesktop();
		if ($agent->isDesktop()) {
		   	$result = DB::update('update rss_site set rss_pc_in = ? where id = ?', [$in_out_datas->rss_pc_in + 1, $id]);
		} else {
		   	$result = DB::update('update rss_site set rss_sp_in = ? where id = ?', [$in_out_datas->rss_sp_in + 1, $id]);
		}

        return view('blog')->with('categories', $categories)->with('results', $results)->with('in_out_datas', $in_out_datas)->with('active', "0")->with('class', "blog");
	}

	public function register_out(Request $request){
		$id = $request->get('id');

        $in_out_datas = DB::table('rss_site')
			->where('id', $id)->first();

		$agent = new \Jenssegers\Agent\Agent;

		$result = $agent->isDesktop();
		if ($agent->isDesktop()) {
		   	$result = DB::update('update rss_site set rss_pc_out = ? where id = ?', [$in_out_datas->rss_pc_out + 1, $id]);
		} else {
		   	$result = DB::update('update rss_site set rss_sp_out = ? where id = ?', [$in_out_datas->rss_sp_out + 1, $id]);
		}
		exit(json_encode(array("status" => "success")));
	}
	public function about(Request $request){
        $categories = DB::select('select * from category');
        return view('about')->with('categories', $categories)->with('active', "0")->with('class', "about");
	}

	public function paginationByCategoryId($category_id = 0, $pagination = 1){
		$categories = DB::table('category')->get();

        if ($category_id == 1) {
        	$rss_sites = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
				->orderBy('rss_temp.postdatetime', 'desc')
	            ->get();
			$results = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
			    ->select(DB::raw("SUM(pc_in) as rss_per_pc_in, SUM(pc_out) as rss_per_pc_out, SUM(sp_in) as rss_per_sp_in, SUM(sp_out) as rss_per_sp_out"), 'rss_temp.*', 'rss_site.*')	
	            ->groupBy('rss_id')
	            ->paginate(30, ['*'], 'page', $pagination);
        }
        else{
        	$rss_sites = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
				->where('category_id', $category_id)
				->orderBy('rss_temp.postdatetime', 'desc')
	            ->get();
			$results = DB::table('rss_site')
				->join('rss_temp', 'rss_site.id', '=', 'rss_temp.rss_id')
			    ->select(DB::raw("SUM(pc_in) as rss_per_pc_in, SUM(pc_out) as rss_per_pc_out, SUM(sp_in) as rss_per_sp_in, SUM(sp_out) as rss_per_sp_out"), 'rss_temp.*', 'rss_site.*')
				->where('category_id', $category_id)
	            ->groupBy('rss_id')
	            ->paginate(30, ['*'], 'page', $pagination);
        }
        return view('welcome')->with('categories', $categories)->with('rss_sites', $rss_sites)->with('results', $results)->with('active', $category_id)->with('class', "index");
	}

	public function getCategory_data($id = 0){
		$resut['data'] = DB::select('select * from category where id = ?', [$id]);
		echo json_encode($resut);
		exit;
	}
	
	public function update(Request $request){
		$name = $request->get("mfullname");
		// $email = $request->get("memail");
		$url = $request->get("cat_url");
		// $status = $request->get("mstatus");
		$id = $request->get("mid");

		if (!empty($id)) {
		      $result = DB::update('update category set name = ?, url = ? where id = ?', [$name, $url, $id]);
		}
		else {
			DB::table('category')->insert(['name' => $name, 'url' => $url]);
		}  
		return redirect('/dashboard');
	}
	public function categorypdate(Request $request){
		$name = $request->get("mfullname");
		// $email = $request->get("memail");
		$url = $request->get("cat_url");
		// $status = $request->get("mstatus");
		$id = $request->get("mid");

		if (!empty($id)) {
		      $result = DB::update('update category set name = ?, url = ? where id = ?', [$name, $url, $id]);
		}
		else {
			DB::table('category')->insert(['name' => $name, 'url' => $url]);
		}  
		return redirect('/dashboard');
	} 	
	public function delete($id = 0){
		DB::delete('delete from category where id = ?', [$id]);
		return redirect('/dashboard');
	}
	public function category_show($id = 0){
        $status = Session::get('status');
        if ($status == 2) {
            $results = DB::select('select * from rss_site where category_id = ?', [$id]);
            return view('auth.category_show')->with('results', $results)->with('cat_id', $id);
        }
        else{
            return redirect('/');
        }
	}
	public function getrssData($id = 0){
		$resut['data'] = DB::select('select * from rss_site where id = ?', [$id]);
		echo json_encode($resut);
		exit;
	}
	public function rss_update(Request $request){
		$name = $request->get("mfullname");
		$url = $request->get("rss_url");
		$id = $request->get("mid");
		$cid = $request->get("cid");
		$file = $request->file('icon_file');
		
		$screen_shot_json_data = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url&screenshot=true");
		// $screen_shot_result = json_decode($screen_shot_json_data);
		$screen_shot_result = json_decode($screen_shot_json_data, null, 512, JSON_OBJECT_AS_ARRAY);
		$screen_shot = $screen_shot_result['screenshot']['data'];
		$screen_shot = str_replace(array('_', '-'), array('/', '+'), $screen_shot);

		$screen_shot_image = "<img class='ovr img-responsive img-thumbnail' src=\"data:image/jpeg;base64,".$screen_shot."\" />";

		if(!empty($file)){
			$file_original_name = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$real_file_path = $file->getRealPath();
			$date = date("Y").date("m").date("d").date("H").date("i").date("s");
			$destinationPath = '/uploads/icons';
			$destinationName = $date.$file_original_name;
			$file->move('.'.$destinationPath, $destinationName);
			$icon_url = $destinationPath.'/'.$destinationName;
		}

		if (!empty($id)) {
				if (empty($icon_url)) {
		      		$result = DB::update('update rss_site set name = ?, rss_url = ?, category_id = ?, img = ? where id = ?', [$name, $url, $cid, $screen_shot_image, $id]);
				} else {
					$result = DB::update('update rss_site set name = ?, rss_url = ?, category_id = ?, img = ?, icon_url = ? where id = ?', [$name, $url, $cid, $screen_shot_image, $icon_url, $id]);
				}
		}
		else {
			if (empty($icon_url)) {
				DB::table('rss_site')->insert(['name' => $name, 'rss_url' => $url, 'category_id' => $cid, 'img' => $screen_shot_image]);
			} else {
				DB::table('rss_site')->insert(['name' => $name, 'rss_url' => $url, 'category_id' => $cid, 'img' => $screen_shot_image, 'icon_url' => $icon_url]);
			}
		}  
		return redirect('/category_show/'.$cid);
	} 	
	public function rssdelete($id = 0){
		$result = DB::select('select * from rss_site where id = ? ', [$id]);
		$cid = $result[0]->category_id;
		DB::delete('delete from rss_site where id = ?', [$id]);
		return redirect('/category_show/'.$cid);
	}

	public function setAllRssData(){
		$rss_sites = DB::table('rss_site')->get();
		$i=0;
		DB::table('rss_temp')->truncate();
		foreach ($rss_sites as $key => $rss_site) {
			// $url = "http://blog.livedoor.jp/love120331/index.rdf";
			$url = $rss_site->rss_url;
			$invalidurl = false;
			if(@simplexml_load_file($url)){
				$feeds = simplexml_load_file($url);
			}else{
				$invalidurl = true;
				$feeds = "";
			}
			if(!empty($feeds)){
				$site = $feeds->channel->title;
				$sitelink = $feeds->channel->link;
				$j = 0;
				$results = array();
				foreach ($feeds->item as $num => $item) {
					if ($j > 6) {
						break;
					}
					// $rss_sites[$key]->child[$num]->link = $item->link;
					// $rss_sites[$key]->child[$num]->description = $item->description;
					$dc = $item->children('http://purl.org/dc/elements/1.1/');
				    $itemDate = date_parse($dc->date);
				    $itemYear = $itemDate['year'];
				    $itemMonth = $itemDate['month'];
				    $itemDay = $itemDate['day'];
				    $itemHour = $itemDate['hour'];
				    $itemMinute = $itemDate['minute'];
				    $itemSecond = $itemDate['second'];
				    $itemMonth =  $itemMonth;
				    if ($itemDay < 10) {
				    	 $itemDay =  "0".$itemDay;
				    }
				    if ($itemMonth < 10) {
				    	 $itemMonth =  "0".$itemMonth;
				    }
				    if ($itemMinute < 10) {
				    	 $itemMinute =  "0".$itemMinute;
				    }
				    $date = $itemMonth.'月'.$itemDay.'日 ';
				   	$time = $itemHour.':'.$itemMinute;
				   	$datetime = $itemYear.'-'.$itemMonth.'-'.$itemDay.' '.$itemHour.':'.$itemMinute.':'.$itemSecond;
					DB::table('rss_temp')->insert(['rss_id' => $rss_sites[$key]->id,'cat_id' => $rss_sites[$key]->category_id, 'title' => $item->title, 'date' => $date, 'time' => $time, 'article_url' => $item->link, 'postdatetime' => $datetime]);
					$i++;
					$j++;
				}
			}
		}
		return true;
	}

}
