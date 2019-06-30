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
class CategoryController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	public function dashboard(Request $request){
        $status = Session::get('status');

        if ($status == 2) {
            $categories = DB::table('category')->where('id', '>', 1)->get();
            return view('auth.dashboard')->with('categories', $categories);
        }
        else{
            return redirect('/signin');
        }
        
    }
	public function getCategories($id = 0){
		$resut['data'] = DB::select('select * from category where id = ?', [$id]);
		echo json_encode($resut);
		exit;
	}
	public function getCategory_data($id = 0){
		$resut['data'] = DB::select('select * from category where id = ?', [$id]);
		echo json_encode($resut);
		exit;
	}
	
	public function update(Request $request){
		$name = $request->get("mfullname");
		// $email = $request->get("memail");
		// $status = $request->get("mstatus");
		$id = $request->get("mid");

		if (!empty($id)) {
		      $result = DB::update('update category set name = ? where id = ?', [$name, $id]);
		}
		else {
		    $result = DB::update('update category set name = ?, where id = ?', [$name, $row->id]);
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
			$id = DB::table('category')->insert(['name' => $name, 'url' => $url]);
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
		$site_url = $request->get("site_url");
		$rss_url = $request->get("rss_url");
		$id = $request->get("mid");
		$cid = $request->get("cid");
		$file = $request->file('icon_file');

		$screen_shot_json_data = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$site_url&screenshot=true");
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
		      		$result = DB::update('update rss_site set name = ?, rss_url = ?, site_url = ?, category_id = ?, img = ? where id = ?', [$name, $rss_url, $site_url, $cid, $screen_shot_image, $id]);
				} else {
					$result = DB::update('update rss_site set name = ?, rss_url = ?, site_url = ?, category_id = ?, img = ?, icon_url = ? where id = ?', [$name, $rss_url, $url, $cid, $screen_shot_image, $icon_url, $id]);
				}
		}
		else {
			if (empty($icon_url)) {
				DB::table('rss_site')->insert(['name' => $name, 'rss_url' => $rss_url, 'site_url' => $site_url, 'category_id' => $cid, 'img' => $screen_shot_image]);
			} else {
				DB::table('rss_site')->insert(['name' => $name, 'rss_url' => $url, 'site_url' => $site_url, 'category_id' => $cid, 'img' => $screen_shot_image, 'icon_url' => $icon_url]);
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

}
