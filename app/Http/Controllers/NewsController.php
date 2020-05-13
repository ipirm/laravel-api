<?php

namespace App\Http\Controllers;

use App\Language;
use App\News;
use App\Order;
use App\Cat;
use App\Banner;
use App\World;
use App\Locals;
use App\Maps;
use App\Contacts;
use App\Russians;
use App\Locations;
use App\Sources;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
class NewsController extends Controller
{

 public function getSources() {
     $data = Sources::orderBy('created_at', 'desc')->get();
       return response()->json(compact('data'));
 }
    public function index(Request $request)
    {
               $per_page = (int)$request->per_page ?: 100;
        $news = News::orderBy('created_at', 'desc')->where('video', null)->paginate($per_page)->withPath('custom/url');
        $news->appends(['per_page' => $per_page]);
        return response()->json(compact('news'));
    }
    
        public function contactsGet(Request $request)
    {

        $data = Contacts::orderBy('created_at', 'desc')->get();
        return response()->json(compact('data'));
    }
    
    
    public function changeLang($lang)
    {
        $language = Language::where('language', $lang)->exists();
        if($language){
            \App::setLocale($lang);
        }
        return response()->json(compact('language'));
    }
    public function item(Request $request)
    {
        $news = News::where('slug', $request->id)->first();
        return response()->json(compact('news'));
    }

    public function interesting(Request $request)
    {
        $per_page = (int)$request->per_page ?: 100;
        $news = News::where('interesting', 1)->where('video', null)->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
             $news->appends(['per_page' => $per_page]);
        return response()->json(compact('news'));
    }
    public function slides(Request $request)
    {
        $request->header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
        $news = News::where('add_main_slide', 1)->orderBy('created_at', 'desc')->get();
        return response()->json(compact('news'));
    }
   public function cats()
   {
       $cats = Cat::all();
       return response()->json(compact('cats'));
   }
   public function catsNews(Request $request)
   {
    
   $per_page = (int)$request->per_page ?: 100;
     if($request->slug != 'undefined'){
      $news = News::where('cat_id', $request->id)->where('slug', '!=', $request->slug)->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
      
     }else{
            $news = News::where('cat_id', $request->id)->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
     }
      
      $news->appends(['per_page' => $per_page]);
      return response()->json(compact('news'));
   }
       public function newsVideos(Request $request)
      
    { 
         $per_page = (int)$request->per_page ?: 100;
        $news = News::whereNotNull('video')->where('interesting', 1)->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
         $news->appends(['per_page' => $per_page]);
        return response()->json(compact('news'));
    }
    
    public function banners()
    {
        $banner = Banner::first();
        return response()->json(compact('banner'));
    }
        public function worldMap()
    {
        $world = World::all();
        return response()->json(compact('world'));
    }
          public function paths()
    {
        $locals = Locals::all();
        return response()->json(compact('locals'));
    }
           public function mapLocal()
    {
        $maps = Maps::all();
        return response()->json(compact('maps'));
    }
        public function  locations()
    {
        $countries = Locations::all();
        return response()->json(compact('countries'));
    }

    public function getCountrylocations(Request $request)
    {
        $news = News::all();
            $news_array = [];
          
        foreach ($news as $item) {
            if(strtolower($item->country) == strtolower($request->name)){
            array_push($news_array, $item);
            }
        }
        return response()->json(compact('news_array'));
    }
           public function allVideos(Request $request)
    {
       $per_page = (int)$request->per_page ?: 100;
        $news = News::whereNotNull('video')->where('interesting', 0)->where('cat_id', '!=' , 13)->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
         $news->appends(['per_page' => $per_page]);
        return response()->json(compact('news'));
    }
           public function allNatureVideos(Request $request)
    {
       $per_page = (int)$request->per_page ?: 100;
        $news = News::whereNotNull('video')->where('interesting', 0)->where('cat_id', 13)->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
         $news->appends(['per_page' => $per_page]);
        return response()->json(compact('news'));
    }
      public function getRussia(Request $request)
    {
          $maps = Russians::all();
        return response()->json(compact('maps'));
    }
  public function mailSend(Request $request)
    {
             Mail::to('ilham.pirm@gmail.com')->send(new SendMail($request));
                Mail::to('sabiwalieva@gmail.com')->send(new SendMail($request));
         return response()->json($request->name);
    }
    public function findNews(Request $request){
        $news = News::query();
         $per_page = (int)$request->per_page ?: 100;
          if($request->has('country')){
       $news->where('country->'.$request->lang, 'like', '%' . $request->country . '%');
       }
           if($request->has('source')){
       $news->where('source', 'like', '%' . $request->source . '%');
       }
          if($request->has('title')){
       $news->where('title->'.$request->lang, 'like', '%' . $request->title . '%')->orWhere('description->'.$request->lang, 'like', '%' . $request->title);
       }
          if($request->has('cat_id')){
       $news->where('cat_id', 'like', '%' . $request->cat_id . '%');
       }
          if($request->has('created_at')){
       $news->where('created_at', 'like', '%' . $request->created_at . '%');
       }
          if($request->has('type')){
       $news->where('type', 'like', '%' . $request->type . '%');
       }
         if($request->has('video')){
       $news->whereNotNull('video');
       }
         if($request->has('interesting')){
       $news->where('interesting', 1);
       }
          $newsData = $news->orderBy('created_at', 'desc')->paginate($per_page)->withPath('custom/url');
           $newsData->appends(['per_page' => $per_page]);
          return response()->json($newsData);
    }

}
