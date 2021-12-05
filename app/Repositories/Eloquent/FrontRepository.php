<?php

namespace App\Repositories\Eloquent;

use App\Models\{About, Banner, Category, Faq, General, Link, Page, Partner, Pcategory, Portfolio, Post, Tag, Testimonial, Service, Subscriber};
use App\Models\Team\Team;
use App\Models\Team\TeamTranslation;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

use App\Repositories\Interfaces\FrontRepositoryInterface;
use Illuminate\Http\Request;

class FrontRepository implements FrontRepositoryInterface{
    

    private $tag;
    private $category;
    private $team;
    private $TeamTranslation;
    private $about;
    private $banner;
    private $faq;
    private $general;
    private $link;
    private $page;
    private $partner;
    private $pcategories;
    private $portfolio;
    private $post;
    private $testimonial;
    private $service;
    private $subscriber;
    private $request;
    use GeneralTrait;

    public function __construct(Request $request, Tag $tag,Category $category ,Team $team,TeamTranslation $teamTranslation,About $about, Banner $banner, Faq $faq, General $general, Link $link, Page $page, Partner $partner, Pcategory $pcategories, Portfolio $portfolio, Post $post, Testimonial $testimonial, Service $service, Subscriber $subscriber)
    {
        $this->request = $request;
        $this->team = $team;
        $this->teamTranslation = $teamTranslation;
        $this->tag = $tag;
        $this->category = $category;
        $this->about = $about;
        $this->banner = $banner;
        $this->faq = $faq;
        $this->general = $general;
        $this->link = $link;
        $this->page = $page;
        $this->partner = $partner;
        $this->pcategories = $pcategories;
        $this->portfolio = $portfolio;
        $this->post = $post;
        $this->testimonial = $testimonial;
        $this->service = $service;
        $this->subscriber = $subscriber;
    }
    public function home()
    {
        $about = $this->about->find(1);
        $banner = $this->banner->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = $this->partner->orderBy('name','asc')->limit(8)->get();
        $pcategories = $this->pcategories->all();
        $portfolio = $this->portfolio->all();
        $service = $this->service->orderBy('title','asc')->get();
        return $response = $this->returnData(compact('about','banner','general','link','lpost','partner','pcategories','portfolio','service'));
    }

    public function about()
    {
        $about = $this->about->find(1);
        $faq = $this->faq->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = $this->partner->orderBy('name','asc')->get();
        $team = $this->team->orderBy('id','asc')->get();
        return $response = $this->returnData(compact('about','faq','general','link','lpost','partner','team'));

    }

    public function testi()
    {
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $testi = $this->testimonial->orderBy('name','asc')->paginate(6);
        return $response = $this->returnData(compact('general','link','lpost','testi'));
    }
    public function service()
    {
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $service = $this->service->orderBy('title','asc')->get();
        return $response = $this->returnData(compact('general','link','lpost','service'));
    }

    public function serviceshow($slug)
    {
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $service = $this->service->where('slug', $slug)->firstOrFail();
        return $response = $this->returnData(compact('general','link','lpost','service'));
    }

    public function portfolio()
    {
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $pcategories = $this->pcategories->all();
        $portfolio = $this->portfolio->all();
        return $response = $this->returnData(compact('general','link','lpost','pcategories','portfolio'));
    }

    public function portfolioshow($slug)
    {
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $portfolio = $this->portfolio->where('slug', $slug)->firstOrFail();
        return $response = $this->returnData(compact('general','link','lpost','portfolio'));
    }

    public function blog()
    {
        $categories = $this->category->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->paginate(3);
        $recent = $this->post->orderBy('id','desc')->limit(5)->get();
        $tags = $this->tag->all();
        return $response = $this->returnData(compact('categories','general','link','lpost','posts','recent','tags'));

    }

    public function blogshow($slug)
    {
        $categories = $this->category->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $post = $this->post->where('slug', $slug)->firstOrFail();
        $old = $post->views;
        $new = $old + 1;
        $post->views = $new;
        $post->update();
        $recent = $this->post->orderBy('id','desc')->limit(5)->get();
        $tags = $this->tag->get();
        return $response = $this->returnData(compact('categories','general','link','lpost','post','recent','tags'));
    }

    public function category()
    {
        $categories = $this->category->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = $this->category->posts()->latest()->paginate(6);
        $recent = $this->post->orderBy('id','desc')->limit(5)->get();
        $tags = $this->tag->all();
        return $response = $this->returnData(compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function tag()
    {
        $categories = $this->category->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = $this->tag->posts()->latest()->paginate(12);
        $recent = $this->post->orderBy('id','desc')->limit(5)->get();
        $tags = $this->tag->all();
        return $response = $this->returnData(compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function search()
    {

        $query = request("query");

        $categories = $this->category->all();
        $general = $this->general->find(1);
        $link = $this->link->orderBy('name','asc')->get();
        $lpost = $this->post->where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = $this->post->where("title","like","%$query%")->latest()->paginate(9);
        $recent = $this->post->orderBy('id','desc')->limit(5)->get();
        $tags = $this->tag->all();
        return $response = $this->returnData(compact('categories','general','link','lpost','posts','query','recent','tags'));
    }

    public function page($slug)
    {
        $general = $this->general::find(1);
        $link = $this->link::orderBy('name','asc')->get();
        $lpost = $this->post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $page = $this->page::where('slug', $slug)->firstOrFail();
        return $response = $this->returnData(compact('general','link','lpost','page'));
    }

    public function subscribe()
    {
        Validator::make($this->request->all(), [
            "email" => "required|unique:subscribers,email",
        ])->validate();

        $subs = new Subscriber();
        $subs->email = $this->request->email;
        if ( $subs->save()) {

            return redirect()->route('homepage')->with('success', 'You have successfully subscribed');

           } else {

            return redirect()->back();

           }
    }
}