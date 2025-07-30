<?php

namespace App\Http\Controllers\Front;

use App\Wed\Happy;
use App\Models\SiteDefault;
use Illuminate\Http\Request;
use App\Models\Admin\Article;
use App\Models\Admin\Testimonial;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryMaster;
use App\Models\Admin\LocationMaster;
use App\Models\Admin\ServiceMaster;
use App\Models\Admin\VendorMaster;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        //    /return view('spa');
        //dd('ss');
        // dd(ini_get('upload_max_filesize'), phpinfo());
        $checkins = DB::select('SELECT * FROM users');
        // /dd('ss', );
        //dd(Auth::guard('host')->user());
        $sliders = SiteDefault::where('name', 'slider')->get();
        $testimonials = Happy::getActiveTestimonials();
        //dd('hello', $testimonials);
        return view('welcome', ['sliders' => $sliders, 'testimonials' => $testimonials, 'checkins' => $checkins]);
    }


    public function weddingvenues()
    {
        $vendorCat = CategoryMaster::where('name', 'Wedding Venues')->first();
        //dd($vendorCat);
        $subCat = CategoryMaster::where('parent_id', $vendorCat->id)->get();
        $testimonials = Testimonial::all();
        //$states = LocationMaster::where('parent_id', '!=', 1)->orderBy('name', 'asc')->pluck('name'); 
        // $states = Happy::getActiveLocations()->pluck('name');

        $states = LocationMaster::where('parent_id', '!=', 1)->orderBy('name', 'asc')->pluck('name');
        //dd($subCats);
        return view('front.pages.weddingvenues', compact('states', 'subCat', 'testimonials'));
    }
    public function managertools()
    {
        $testimonials = Testimonial::all();
        return view('front.pages.managertools', ['testimonials' => $testimonials]);
    }
    public function vendordirectory()
    {
       // $vendors = VendorMaster::orderBy('name')->get();
        $vendors = CategoryMaster::all();
        $cities = LocationMaster::where('parent_id', '!=', 1)->orderBy('name', 'asc')->pluck('name');
        // $testimonials = Testimonial::all();
        return view('front.pages.vendordirectory', compact('vendors', 'cities'));
    }
    public function ideasandinspiration()
    {
        $articles = Happy::getActiveArticles();
        $categories = CategoryMaster::where('parent_id', '!=', null)->get();
        $maincats  = CategoryMaster::where('parent_id', null)->get();

        // $subCat = CategoryMaster::where('parent_id', $vendorCat->id)->get();
        //dd($categories, $articles);
        return view('front.pages.ideasandinspiration', ['categories' => $categories, 'articles' => $articles, 'maincats' => $maincats]);
    }

    /**
     * Show the form for about company -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('front.pages.about');
    }

    /**
     * Show the form for ourstory -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ourstory()
    {
        return view('front.pages.ourstory');
    }

    /**
     * Show the form for benefits -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function benefits()
    {
        return view('front.pages.benefits');
    }

    /**
     * Show the form for teams -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teams()
    {
        return view('front.pages.teams');
    }

    /**
     * Show the form for help -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        return view('front.pages.help');
    }

    /**
     * Show the form for faqs -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faqs()
    {
        return view('front.pages.faqs');
    }

    /**
     * Show the form for contactus -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactus()
    {
        return view('front.pages.contactus');
    }

    public function careers()
    {
        return view('front.pages.careers');
    }

    public function sitemap()
    {
        return view('front.pages.sitemap');
    }

    /**
     * Show the form for services -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        return view('front.pages.services');
    }

    /**
     * Show the form for customfield -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customfield()
    {
        return view('front.pages.customfield');
    }

    /**
     * Show the form for listing -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing()
    {
        return view('front.pages.listing');
    }


    /**
     * Show the form for offline -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offline()
    {
        return view('front.pages.offline');
    }


    /**
     * Display a termsandconditions  resource.
     *
     *  @return \Illuminate\Http\Response
     */
    public function termsandconditions()
    {
        return view('front.pages.termsconditions');
    }


    /**
     * Display a privacypolicy  resource.
     *
     *  @return \Illuminate\Http\Response
     */
    public function privacypolicy()
    {
        return view('front.pages.privacypolicy');
    }

    /**
     * Show the form for cookiesconsent -  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cookiesconsent()
    {
        return view('front.pages.cookiesconsent');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
