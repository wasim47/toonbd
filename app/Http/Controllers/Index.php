<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Menu;
use App\Content;
use App\Banner;
use App\Gallery;
use App\Service;
use App\Blog;
use App\Partner;
use App\Management;
use App\Employee;
use App\Product;
use App\Counter;
use App\VideoGallery;
use App\Circular;
use App\Protfolio;

class Index extends Controller
{
    public function __construct()
    {	
        
    }
	
    public function index()
    {      
		$menus = Menu::where('parent_id',NULL)->get();	
		$banners = Banner::all();	
		$articles = Content::where('menu_id',1)->first();	
		
		$services = Service::where('status',1)->orderBy('id', 'DESC')->take(6)->get();	
		$whychoose = Blog::where('status',1)->orderBy('id', 'DESC')->take(10)->get();	
		$ourteam = Employee::where('status', 1)->orderBy('id', 'DESC')->get();
		$partners = Partner::where('status', 1)->orderBy('id', 'ASC')->get();
		$protfolios = Protfolio::where('status', 1)->orderBy('id', 'ASC')->get();
		$galleries = Gallery::where('status',1)->orderBy('sequence', 'ASC')->get();
		$counters = Counter::where('status', 1)->orderBy('sequence', 'ASC')->get();
		 
		return view('frontend.home',compact('menus','banners','articles','services','whychoose','ourteam','partners','services','galleries','counters','protfolios'));
    }
	
	public function contents()
    {      
		$slug = request()->segment(2);
		$sslug = request()->segment(3);
		$ssslug = request()->segment(4);
		
		$menus = Menu::where('parent_id',NULL)->get();
		if($slug!='' && $sslug!='' && $ssslug!=""){
			$getParentID = Menu::where('uri', $ssslug)->select('parent_id','sparent_id')->first();
			$menuslug = Menu::where([['parent_id', $slug],['sparent_id', $sslug],['uri', $ssslug]])->first();
		}
		elseif($slug!='' && $sslug!='' && $ssslug==""){
			$getParentID = Menu::where('uri', $sslug)->select('parent_id')->first();
			$menuslug = Menu::where([['parent_id', $slug],['uri', $sslug]])->first();
		}
		elseif($slug!='' && $sslug=='' && $ssslug==""){
			$menuslug = Menu::where('uri', $slug)->first();
		}	
		else{
			return redirect(route('home'));
		}				
		
		
		$articles = Content::where('menu_id',$menuslug->id)->first();			
		$allsubmenus = Menu::where('parent_id', $menuslug->id);			
		return view('frontend.article',compact('articles','menus','menuslug','allsubmenus'));
    }
	
	public function service_details($id)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$services = Service::where('id',$id)->first();				
		return view('frontend.service',compact('menus','services'));
    }
		
	public function news() 
    {      
		$menus = Menu::where('parent_id',NULL)->get();	
		$allnews = Blog::where('status',1)->orderBy('id', 'DESC')->paginate(50);	
		return view('frontend.news',compact('menus','allnews'));
    }
	
	public function news_details($slug) 
    {      
		$menus = Menu::where('parent_id',NULL)->get();	
		$news = Blog::where('slug',$slug)->first();	
		
		$relatednews = Blog::where('id','!=',$news->id)->take(5)->get();	
		$latestnews = Blog::orderBy('id','DESC')->take(10)->get();	
		
		return view('frontend.news_details',compact('menus','news','relatednews','latestnews'));
    }
	
	

	
	public function management(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();
		$managements = Management::all();					
		return view('frontend.management',compact('managements','menus'));
    }
	
	public function circular(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$directors = Circular::all();				
		return view('frontend.circular',compact('menus','directors'));
    }
	
	
	public function employee(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$allemployee = Employee::orderBy('id','desc')->get();
		return view('frontend.employee',compact('menus','allemployee'));
    }
	
	public function product(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$products = Product::all();				
		return view('frontend.product',compact('menus','products'));
    }
	
	
	public function product_details($id)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$products = Product::where('id',$id)->first();				
		return view('frontend.product_details',compact('menus','products'));
    }
	
	
		
	public function faqs(Request $req)
    {		   
		$menus = Menu::where('parent_id',NULL)->get();			
		$faqtopic = FaqTopic::all();

		if($req->has('q') && $req->q!=""){
			$faqs = Faq::where('topic',$req->q)->get();
		}
		else{
			$faqs = Faq::all();
		}
		return view('frontend.faq',compact('faqtopic','menus','faqs','menus'));
    }
	
	
	public function reports($slug)
    {      
		$menus = Menu::where('parent_id',NULL)->get();					
		$selectedmenu = Menu::where('uri', $slug)->first();	
		$reportingyear = Report::select('years')->where('menu_id',$selectedmenu->id)->groupBy('years')->orderBy('years','DESC')->get();	
		$reports = Report::where('menu_id',$selectedmenu->id)->orderBy('id','ASC')->get();	
				
		return view('frontend.report',compact('menus','reports','selectedmenu','reportingyear'));
    }
	
	public function getDownload($name,$files)
	{
		$file= "uploads/report/".$files;
	
		$headers = array('Content-Type: application/pdf');
	
		return Response::download($file, $files, $headers);
	}
	
	
	public function photos(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$photos = Gallery::all();				
		return view('frontend.photos',compact('menus','photos'));
    }
	
	
	
	public function videos(Request $req)
    {      
		$menus = Menu::where('parent_id',NULL)->get();		
		$videos = VideoGallery::all();				
		return view('frontend.videos',compact('menus','videos'));
    }
	

}
