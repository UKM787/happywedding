<?php

use App\Wed\Happy;
use App\Models\User;
use Inertia\Inertia;
use App\Mail\EmailVerify;
use App\Models\Host\Host;
use App\Models\SiteDefault;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Article;
use Illuminate\Support\Carbon;
use App\Models\Host\Invitation;
use App\Models\Admin\Testimonial;
use App\Models\Admin\VendorMaster;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Venue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleApiController;
use App\Http\Controllers\Front\PagesController;
// use App\Http\Controllers\Admin\ArticleController;
// use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\FullCalenderController;
// use App\Http\Controllers\Vendor\CalendarController;
// use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Guest\LogisticsController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Guest\AccommodationController;
use App\Http\Controllers\Guest\GuestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Host\LogisticsController as HostLogisticsController;
use App\Models\Admin\CategoryMaster;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Host\HostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('api/sitetasks', function () {
    return view('sitetasks');
});

Route::get('api/scan-qr-code', function () {
    return view('qrcode');
});
Route::post('helo', function () {
    return 'hello';
});



// register routes
Route::get('/host/register', 'Auth\RegisterController@showRegisterForm')->name('hostRegister');
Route::get('/vendor/register', 'Auth\RegisterController@showRegisterForm')->name('vendorRegister');
Route::get('/admin/register', 'Auth\RegisterController@showRegisterForm')->name('adminRegister');


// login get routes
Route::get('/host/login', 'Auth\LoginController@showLoginForm')->name('hostLogin');
Route::get('/vendor/login', 'Auth\LoginController@showLoginForm')->name('vendorLogin');
Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('adminLogin');
Route::get('/login/company', 'Auth\LoginController@showLoginForm')->name('companyLogin');

// login post and logout routes
Route::post('/host/register', 'Auth\RegisterController@createHost')->name('hostRegisterPost');
Route::post('/host/login', 'Auth\LoginController@loginHost')->name('hostLoginPost');
Route::post('/login/company', 'Auth\LoginController@companyLogin');
Route::post('/logout/company', 'Auth\LoginController@logoutCompany')->name('logoutCompany');




// Route::post('/vendor/login', 'Auth\LoginController@loginVendor')->name('vendorLogin');
// Route::post('admin/login', 'Auth\LoginController@loginAdmin')->name('loginAdmin');
Route::post('/logout/vendor', 'Auth\LoginController@logoutVendor')->name('logoutVendor');
Route::post('logout/admin', 'Auth\LoginController@logoutAdmin')->name('logoutAdmin');
Route::post('logout/host', 'Auth\LoginController@logoutHost')->name('logoutHost');
Route::post('logout/memer', 'Auth\LoginController@logoutMember')->name('logoutMember');
Route::post('logout/all', 'Auth\LoginController@logoutAll')->name('logoutAll');

// Login Single Routes
Route::post('/user-check', 'Auth\LoginController@checkUserExists')->name('checkUserExists');

// login view form return routes




// login using otp route
Route::post('/login/sendOtp', 'Auth\LoginController@sendOtp')->middleware(['throttle:4,1'])->name('sendOtp');
Route::post('/login/verifyOtp', 'Auth\LoginController@verifyOtp')->name('verifyOtp');
Route::post('/login/retryOtp', 'Auth\LoginController@retryOtp')->middleware(['throttle:4,1'])->name('retryOtp');


// social media login routes
Route::prefix('facebook')->group(function () {
    Route::get('auth', 'Auth\FaceBookController@loginUsingFacebook')->name('fblogin');
    Route::get('callback', 'Auth\FaceBookController@callbackFromFacebook')->name('fbcallback');
});
Route::prefix('google')->group(function () {
    Route::get('auth', 'Auth\GoogleLoginController@loginUsingGoogle')->name('googleLogin');
    Route::get('callback', 'Auth\GoogleLoginController@callbackFromGoogle');
});

// Route::prefix('instagram')->group( function(){
// Route::get('auth', 'Auth\InstagramLoginController@loginUsingInstagram')->name('instagramLogin');
// Route::get('callback', 'Auth\InstagramLoginController@callbackFromInstagram');
// });
// Route::prefix('linkedin')->group( function(){
// Route::get('auth', 'Auth\LinkedinLoginController@loginUsingLinkedin')->name('linkedinLogin');
// Route::get('callback', 'Auth\LinkedinLoginController@callbackFromLinkedin');
// });
// Route::prefix('twitter')->group( function(){
// Route::get('auth', 'Auth\TwitterLoginController@loginUsingTwitter')->name('twitterLogin');
// Route::get('callback', 'Auth\TwitterLoginController@callbackFromTwitter');
// });


// email verifcation routes

Route::get('/email/verify', function () {
    if (request()->user(Auth::getDefaultDriver())->hasVerifiedEmail()) {
        return redirect('/');
    } else {
        return view('auth.verify');
    }
})->middleware('auth:company,host,vendor')->name('verification.notice');

Route::get('/email/verify/{token}', function (Request $request) {
    $exists = DB::table('email_verification')->where([
        'email' => $request->email,
        'token' => $request->token,
        'type' => $request->type,
    ])->first();
    if(!$exists){
        return redirect('/')->with([
            'status' => 'success',
            'message' => 'Invalid Link'
        ]);
    }
    if($exists && $request->type == 'host'){
        DB::table('email_verification')->where(['email' => $request->email])->delete();
        $user = Host::where('email', $request->email)->first();
        $guard = 'host';
        $redirect = 'hostwelcome';
    }
    $user->update(['email_verified_at' => Carbon::now()]);
    if(request()->user($guard) && request()->user($guard)->email == $request->email){
        return redirect()->intended(route($redirect, auth()->guard($guard)->user()))
        ->with([
            'status' => 'success',
            'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
        ]);
    }else{
        return redirect('/')->with([
            'status' => 'success',
            'message' => 'Email Verified!! Login to Continue!'
        ]);
    }
})->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $user = request()->user(Auth::getDefaultDriver());
    $token = Str::random(64);
    $action_link = route('verification.verify', ['token' => $token, 'email' => $user->email, 'type' => Auth::getDefaultDriver()]);
    DB::table('email_verification')->insert([
        'email' => $user->email,
        'token' => $token,
        'type' => Auth::getDefaultDriver(),
        'created_at' => Carbon::now(),
    ]);
    Mail::to($user->email)->send(new EmailVerify($action_link, $user));
    return back()->with(['status' => 'success', 'message' => 'Verification link sent!']);
})->middleware(['auth:company,vendor,host', 'throttle:2,1'])->name('verification.send');


// route for dummy verification for testing purposes
Route::post('custom-verify', function(Request $request){
    if(auth()->guard('host')->check()){
        //auth()->guard('host')->user->email
        //$request->fulfill();
        auth()->guard('host')->user()->update(['email_verified_at' => Carbon::now()]);
        return redirect()->intended(route('hostwelcome', auth()->guard('host')->user()))
                    ->with([
                        'status' => 'success',
                        'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                    ]);
        //dd();
    }else{
        return redirect('/');
    }
})->name('customEmailVerify');


//Subscription route
Route::get('/subscribe', 'SubscriptionController@index')->name('subscribePage');
Route::get('/subscribe/createOrder/{id}', 'SubscriptionController@createOrder')->name('subscribeCreateOrder');
Route::post('/subscribe/verifyPayment', 'SubscriptionController@verifyPayment')->name('subscribeVerifyPayment');

//Reccuring Subscription route
Route::get('/subscribe-rec', 'SubscriptionReccuringController@index')->name('subscribeReccuringPage');
Route::get('/subscribe/createSubscription/{id}', 'SubscriptionReccuringController@createSubscription')->name('subscribeCreateSubscribe');
Route::post('/cancelSub/{id?}', 'SubscriptionReccuringController@cancel')->name('cancelSubscription');


// webhk route
Route::post('/subscribe-webhook', 'SubscriptionReccuringController@webhook')->name('subscribeWebhook');
Route::post('/push', 'PushController@store');
Route::post('/push-user', 'PushController@checkUser');


// front pages


foreach (Happy::PAGES as $key => $val) {
    Route::get($key, [PagesController::class, $val])->name($val);
}


// footer links routes
//Route::get('/', [PagesController::class, 'index'])->name("welcome");
//Route::get('/about', [PagesController::class, 'about'])->name("about");
//Route::get('/our-story', [PagesController::class, 'ourstory'])->name("ourstory");
//Route::get('/benefits', [PagesController::class, 'benefits'])->name("benefits");
// Route::get('/teams', [PagesController::class, 'teams'])->name("teams");
// Route::get('/help', [PagesController::class, 'help'])->name("help");
// Route::get('/faqs', [PagesController::class, 'faqs'])->name("faqs");
// Route::get('/contact-us', [PagesController::class, 'contactus'])->name("contactus");
// Route::get('/services', [PagesController::class, 'services'])->name("services");
// Route::get('/customfield', [PagesController::class, 'customfield'])->name("customfield");
// Route::get('/listing', [PagesController::class, 'listing'])->name("listing");
// Route::get('/offline', [PagesController::class, 'offline'])->name("offline");
// Route::get('/terms-and-conditions', [PagesController::class, 'termsandconditions'])->name("termsandconditions");
// Route::get('/privacy-policy', [PagesController::class, 'privacypolicy'])->name("privacypolicy");
// Route::get('/careers', [PagesController::class, 'careers'])->name("careers");
// Route::get('/sitemap', [PagesController::class, 'sitemap'])->name("sitemap");
// Route::get('/cookies-consent', [PagesController::class, 'cookiesconsent'])->name("cookiesconsent");


/**
 * wedding-venues, manager-tools, direcoty and ideas-and-inspiration
 */

// Route::get('wedding-venues', function () {
//     $vendorCat = VendorMaster::where('name', 'Wedding Venues')->first();
//     //dd($vendorCat);
//     $subCat = VendorMaster::where('parent_id', $vendorCat->id)->get();
//     $testimonials = Testimonial::all();
//     $states = LocationMaster::where('parent_id', '!=', 1)->orderBy('name', 'asc')->pluck('name');
//     //dd($states);
//     return view('wedding_venues', compact('states', 'subCat', 'testimonials'));
// });
// Route::get('manager-tools', function () {
//     $testimonials = Testimonial::all();
//     return view('manager_tools', ['testimonials' => $testimonials]);
// });
// Route::resource('/directory', 'DirectoryController');
// Route::get('ideas-and-inspiration', function () {
//     $articles = Article::with('tags')->get();
//     $categories = VendorMaster::where('parent_id', null)->get();
//     //dd($categories, $articles);
//     return view('ideas_and_inspiration', ['categories' => $categories, 'articles' => $articles]);
// });
// Route::resource('/news', 'NewsController');
Route::get('wedding/vendorMasterList', function () {
    $vendors = CategoryMaster::where('parent_id', '!=', null)->get();
    return $vendors;
});





//...
Route::get('event', [FullCalenderController::class, 'index']);
Route::post('eventAjax', [FullCalenderController::class, 'ajax']);

Route::get('putaddress', [GoogleApiController::class, 'putaddress'])->name('putaddress');
Route::post('getcordinates', [GoogleApiController::class, 'getcordinates'])->name('getcordinates');



/**
 * @guest Routes
 */

Route::get('view-invitation/{id}/{slug}/{num}', [GuestController::class, 'inviDisplay'])->name('view-invitation');

Route::get('view-invite/{route}', function(){
    $short = ShortUrl::where('short_url', request()->route)->first();
    if($short){
        return redirect($short->long_url);
    }else{
        return redirect()->route('welcome')->with([
            'message'    => 'Not Authorised!',
        ]);
    }
})->name('view-invite');

Route::get('hashcreator/{var}', function () {
    dd(Crypt::encrypt(request('var')));
});

// Emergency Cache Clearing Routes (Remove in production or add authentication)
Route::get('clear-all-cache/{secret?}', function($secret = null) {
    // Add your secret key for security
    if ($secret !== 'your-secret-key-here') {
        abort(403, 'Unauthorized');
    }

    $output = [];

    try {
        // Clear Laravel caches
        Artisan::call('cache:clear');
        $output[] = 'Application cache cleared';

        Artisan::call('config:clear');
        $output[] = 'Configuration cache cleared';

        Artisan::call('route:clear');
        $output[] = 'Route cache cleared';

        Artisan::call('view:clear');
        $output[] = 'View cache cleared';

        Artisan::call('clear-compiled');
        $output[] = 'Compiled classes cleared';

        // Clear permission cache
        if (class_exists('Spatie\Permission\PermissionServiceProvider')) {
            Artisan::call('permission:cache-reset');
            $output[] = 'Permission cache cleared';
        }

        // Clear OPcache if available
        if (function_exists('opcache_reset')) {
            opcache_reset();
            $output[] = 'OPcache cleared';
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All caches cleared successfully',
            'details' => $output
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error clearing cache: ' . $e->getMessage()
        ], 500);
    }
})->name('clear-all-cache');

Route::get('optimize-app/{secret?}', function($secret = null) {
    // Add your secret key for security
    if ($secret !== 'your-secret-key-here') {
        abort(403, 'Unauthorized');
    }

    $output = [];

    try {
        // Clear first
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        // Then optimize
        Artisan::call('config:cache');
        $output[] = 'Configuration cached';

        Artisan::call('route:cache');
        $output[] = 'Routes cached';

        Artisan::call('view:cache');
        $output[] = 'Views cached';

        return response()->json([
            'status' => 'success',
            'message' => 'Application optimized successfully',
            'details' => $output
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error optimizing app: ' . $e->getMessage()
        ], 500);
    }
})->name('optimize-app');



Route::group(['namespace' => 'Guest', 'prefix' => 'guest', 'as' => 'guest'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('throttle:6,1')->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});
Route::group(['namespace' => 'Guest', 'prefix' => 'guest', 'as' => 'guest'], function () {
    // GuestController - welcome.blade.php, declined.blade.php, going.blde.php, new.blade.php, pending.blade.php
    Route::get('{user}/testify', 'GuestController@testify')->name('testify');
    Route::resource('{user}/welcome', 'GuestController');
    Route::get('{user}/new-invitations', 'GuestController@newinvitations')->name('new-invitations');
    Route::get('{user}/accepted-invitations', 'GuestController@acceptedinvitations')->name('accepted-invitations');
    Route::get('{user}/invitations-declined', 'GuestController@declinedinvitations')->name('declined-invitations');
    Route::get('{user}/invitations-pending', 'GuestController@pendinginvitations')->name('pending-invitations');

    Route::post('{user}/{invitation}/noted', 'GuestController@noted')->name('noted');
    Route::post('{user}/{invitation}/accepted', 'GuestController@accepted')->name('accepted');
    Route::post('{user}/{invitation}/declined', 'GuestController@declined')->name('declined');
    Route::get('{user}/invitation/{invitation}', 'GuestController@invitation')->name('invitation');
    Route::resource('{user}/profile', 'ProfileController');
    Route::resource('{user}/home', 'HomeController');
    Route::resource('{user}/office', 'OfficeController');
    Route::resource('{user}/family', 'FamilyController');
    //Route::resource('{user}/{invitation}/arrival', 'ArrivalController');
    //Route::resource('{user}/{invitation}/departure', 'DepartureController');
    Route::resource('{user}/invitation/{invitation}/accommodation', 'AccommodationController');
    Route::get('{user}/invitation/{invitation}/accommodationExport', 'AccommodationController@export')->name('acc.export');
    Route::post('{user}/invitation/{invitation}/guestupdate', [AccommodationController::class, 'guestupdate'])->name('privilege.update');
    Route::post('{user}/invitation/{invitation}/guestfamily', [AccommodationController::class, 'familyupdate'])->name('familyprivilege.update');
    Route::resource('{user}/invitation/{invitation}/logistics', 'LogisticsController');
    Route::post('{user}/invitation/{invitation}/arrival', [LogisticsController::class, 'arrival'])->name('logistics.arrival');
    Route::post('{user}/invitation/{invitation}/departure', [LogisticsController::class, 'departure'])->name('logistics.departure');
    Route::post('{user}/invitation/{invitation}/guestarrival', [LogisticsController::class, 'guestarrival'])->name('logistics.privilege');
    Route::post('{user}/invitation/{invitation}/guestfamilyarrival', [LogisticsController::class, 'familyarrival'])->name('logistics.familyprivilege');
    Route::resource('{user}/invitation/{invitation}/foodmenu', 'FoodController');
    Route::resource('{user}/invitation/{invitation}/gallery', 'GalleryController');
});
Route::group(['namespace' => 'Guest', 'prefix' => 'guest'], function () {
    Route::resource('{user}/{invitation}/guests', 'GuestController');
});
Route::group(['namespace' => 'Guest', 'prefix' => 'guest'], function () {
    Route::get('{user}/invitation/{invitation}/cover', 'GuestController@cover')->name('invitationCover');
    Route::get('{user}/invitation/{invitation}/savedate', 'GuestController@savedate')->name('saveDate');
    Route::get('{user}/invitation/{invitation}/story', 'GuestController@story')->name('ourStory');
    Route::get('{user}/invitation/{invitation}/ceramonies', 'GuestController@ceramonies')->name('ceramonies');
});



/**
 * @host routes
 */



Route::post('{host}/hostmobile', 'Host\HostController@mobilenumber')->name('addHostmobile');
Route::post('{host}/createAlbum', 'Host\GalleryController@createAlbum')->name('addAlbum');
Route::post('{host}/hostgallery', 'Host\GalleryController@store')->name('hostgallery.store');
Route::post('{host}/hostvideoUpload', 'Host\GalleryController@videoStore')->name('hostvideoUpload');
Route::delete('{host}/deleteAlbum/{album}', 'Host\GalleryController@deleteAlbum')->name('deleteAlbum');
Route::delete('{host}/deleteVideo/{video}', 'Host\GalleryController@videoDestroy')->name('deleteVideo');

Route::group(['namespace' => 'Host', 'prefix' => 'host', 'as' => 'host'], function () {
    //password reset links for hosts
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('throttle:6,1')->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

//Route::group(['namespace' => 'Host', 'middleware' => ['auth:company,vendor,host','verified']], function()
//Route::group(['namespace' => 'Host'], function()
Route::group(['namespace' => 'Host', 'middleware' => ['auth:host', 'checkHostSubscription']], function () {
    Route::get('/host/members', 'MemberController@index')->name('hostmembers.index');
    Route::get('/getmembers', 'MemberController@getmembers');
    Route::post('/storemember', 'MemberController@storemember');
    Route::post('/updatemembers/{id}', 'MemberController@updatemembers');
    Route::post('/deletemembers/{id}', 'MemberController@deletemember');
    Route::get('/host/{host}/bulkloadmember', 'MemberController@bulkupload')->name('hostmembers.bulkupload');

    Route::get('/tasks', 'TaskController@index')->name('hosttasks.index');
    Route::get('/gettasks', 'TaskController@gettasks');
    Route::post('/submittask', 'TaskController@submittask');
    Route::patch('updatetask/{id}', 'TaskController@updatetask');
    Route::post('/edittask/{id}', 'TaskController@edittask');
    Route::post('/deletetask/{id}', 'TaskController@deletetask');
    Route::get('/{host}/bulkloadtask', 'TaskController@bulkupload')->name('hosttasks.bulkupload');

    Route::post('/submit', 'Invitation\ContactController@submit');
    Route::get('/getcontacts', 'Invitation\ContactController@getcontacts');
    Route::post('/host/{host}/memories', [HostController::class, 'addMemories'])->name('addMemories');
});
//Route::group(['namespace' => 'Host', 'middleware' => ['auth:company,vendor,host','verified'], 'prefix' => 'host', 'as' => 'host'], function ()
//Route::group(['namespace' => 'Host', 'prefix' => 'host', 'as' => 'host'], function ()
Route::group(['namespace' => 'Host', 'middleware' => ['auth:host', 'checkHostSubscription'], 'prefix' => 'host'], function () {
    // Route::get('welcome', 'HostController@index')->middleware('verified:null,host')->name('welcome');
    Route::get('testify', 'HostController@testify')->name('testify');
    //Route::post('testify', 'HostController@testify')->name('testifysend');
    Route::get('welcome', 'HostController@index')->name('hostwelcome');
    Route::get('host-invi', 'HostController@getinvi')->name('getinvi');
    Route::resource('profile', 'ProfileController');
    Route::resource('home', 'HomeController');
    Route::resource('office', 'OfficeController');
    Route::get('invitations/{invitation?}', 'InvitationController@index')->name('hostinvitations.index');
    Route::get('invitations/create', 'InvitationController@create')->name('hostinvitations.create');
    Route::post('invitations', 'InvitationController@store')->name('hostinvitations.store');
    Route::get('invitations/{invitation}/show', 'InvitationController@show')->name('hostinvitations.show');
    Route::get('invitations/{invitation}/edit', 'InvitationController@edit')->name('hostinvitations.edit');
    Route::put('invitations/{invitation}', 'InvitationController@update')->name('hostinvitations.update');
    Route::delete('invitations/{invitation}', 'InvitationController@destroy')->name('hostinvitations.destroy');

    Route::get('invitation/{invitation?}', 'InvitationController@index')->name('hostinvitation.custom');

    Route::resource('venues', 'VenueController', ['names' => [
        'create' => 'hostvenues.create'
    ]]);
    Route::resource('finalizedvendors', 'FinalizedvendorController');
    Route::resource('members', 'MemberController');
    Route::resource('tasks', 'TaskController');
    Route::resource('gallery', 'GalleryController');
    Route::resource('fooddepartment', 'FoodController');
    Route::resource('reports', 'ReportController');
    Route::post('{host}/video', 'GalleryController@videoStore')->name('videoUpload');

    Route::get('ceramony/{invitation?}', 'CeramonyController@index')->name('hostceremony.custom');
    Route::resource('{invitation}/ceramony', 'CeramonyController');

    Route::get('savedate/{invitation?}', 'SavedateController@index')->name('hostsavedate.custom');
    Route::resource('{invitation}/savedate', 'SavedateController', ['names' => [
        'create' => 'hostsavedate.create',
        'store' => 'hostsavedate.store',
        'show' => 'hostsavedate.show',
        'edit' => 'hostsavedate.edit',
        'update' => 'hostsavedate.update',
        'destroy' => 'hostsavedate.destroy'
    ]]);

    Route::get('story/{invitation?}', 'StoryController@index')->name('hoststory.custom');
    Route::resource('{invitation}/story', 'StoryController', ['names' => [
        'create' => 'hoststory.create',
        'store' => 'hoststory.store',
        'show' => 'hoststory.show',
        'edit' => 'hoststory.edit',
        'update' => 'hoststory.update',
        'destroy' => 'hoststory.destroy'
    ]]);

    Route::get('invitationcontact/{invitation?}', 'Invitation\ContactController@index')->name('hostinvitationcontact.custom');
    Route::resource('{invitation}/invitationcontact', 'Invitation\ContactController', ['names' => [
        'create' => 'hostinvitationcontact.create',
        'store' => 'hostinvitationcontact.store',
        'show' => 'hostinvitationcontact.show',
        'edit' => 'hostinvitationcontact.edit',
        'update' => 'hostinvitationcontact.update',
        'destroy' => 'hostinvitationcontact.destroy'
    ]]);

    Route::resource('{user}/{invitation}/guestceramony', 'GuestCeramonyController');

    Route::resource('{invitation}/address', 'AddressController');
    Route::resource('logistics', 'LogisticsController');
    Route::resource('accommodation', 'AccommodationController');
    Route::resource('{invitation}/foodmenu', 'FoodmenuController');

    Route::resource('{invitation}/ecard', 'Invitation\ECardController');
    Route::resource('{invitation}/website', 'Invitation\WebsiteController');

    // routes by gokul
    Route::post('{host}/storeAccomm', 'AccommodationController@storeAccomm')->name('storeAccomm');
    Route::post('{host}/AddBlock', 'AccommodationController@storeBlock')->name('storeBlock');
    Route::post('{host}/storeFloor', 'AccommodationController@storeFloor')->name('storeFloor');
    Route::post('{host}/storeRoom', 'AccommodationController@storeRoom')->name('storeRoom');

    Route::get('/getBlock/{id}', 'AccommodationController@getBlock');
    Route::get('/getFloor/{id}', 'AccommodationController@getFloor');
    Route::get('/getRoom/{id}', 'AccommodationController@getRoom');
    Route::get('{host}/roomIndex', 'AccommodationController@roomIndex')->name('roomIndex');
});

//Route::group(['namespace' => 'Host', 'middleware' => ['auth:company,vendor,host','verified'], 'prefix' => 'host'],function()
Route::group(['namespace' => 'Host', 'middleware' => ['auth:host', 'checkHostSubscription'], 'prefix' => 'host'], function () {
    Route::get('invitedguests/{invitation?}', 'GuestInvitationController@index')->name('invitedguests.custom');
    Route::resource('{invitation}/invitedguests', 'GuestInvitationController');


    Route::get('{invitation}/guestlist', 'GuestInvitationController@invite')->name('invitedguestlist');
    Route::get('{invitation}/guestupload', 'GuestInvitationController@guestupload')->name('guestupload');
    Route::post('{invitation}/sendinvite', 'GuestInvitationController@sendinvite')->name('sendinvite');
    Route::post('{invitation}/guestprofiles', 'GuestInvitationController@guestprofiles')->name('guestprofiles');
    Route::post('{invitation}/guesthomes', 'GuestInvitationController@guesthomes')->name('guesthomes');
    Route::post('{invitation}/guestoffices', 'GuestInvitationController@guestoffices')->name('guestoffices');
    // Route::get('sample/{filename}', 'GuestInvitationController@sampleDownload')->name('sampleXls');
    Route::get('{filename}/sample', 'GuestInvitationController@downloadSample')->name('sampleGuest');
    Route::get('{invitation}/watsapp/export', 'GuestInvitationController@exportWatsapp')->name('exportWatsapp');


    Route::post('{invitation}/guestfamily', 'GuestInvitationController@guestfamily')->name('guestfamily');
    Route::post('{host}/{invitation}/guestall', 'GuestInvitationController@guestAll')->name('guestall');
    Route::delete('{host}/{invitation}/deleteguest/{guest}', 'GuestInvitationController@deleteGuest')->name('deleteguest');

    Route::post('{host}/{invitation}/ceremonyUpdate/{guest}', 'GuestInvitationController@ceremonyUpdate')->name('ceremonyUpdate');

    Route::get('{invitation}/guestexport', 'GuestInvitationController@export')->name('guestexport');
    Route::get('{invitation}/guestallexport', 'GuestInvitationController@allexport')->name('allguestexport');
    Route::get('{invitation}/familyguestexport1', 'GuestInvitationController@family1')->name('familyguestexport1');
    Route::get('{invitation}/profileexport', 'GuestInvitationController@exportGuestprofile')->name('profileexport');
    Route::get('{invitation}/guestHomeexport', 'GuestInvitationController@exportGuesthome')->name('guestHomeexport');
    Route::get('{invitation}/guestOfficeexport', 'GuestInvitationController@exportGuestoffice')->name('guestOfficeexport');
    Route::get('{invitation}/guestfamilyexport', 'GuestInvitationController@exportGuestfamily')->name('guestFamilyexport');
    
    //
    //Route::resource('{user}/{invitation}/guestceramony', 'CeramonyController');

});


/**
 * @member routes
 */
Route::get('member/welcome', 'Host\MemberDashboardController@index')->name('memberwelcome');
Route::group(['namespace' => 'Member', 'prefix' => 'member', 'as' => 'member'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});



/**
 * @bride routes
 */
Route::group(['namespace' => 'Bride', 'prefix' => 'bride', 'as' => 'bride'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::resource('{bride}/profile', 'ProfileController');
    Route::resource('{bride}/Welcome', 'BrideController');
    Route::resource('{bride}/shortlisted', 'ShortlistedController');
    Route::resource('{bride}/todolist', 'TodolistController');
    Route::resource('{bride}/worklist', 'WorklistController');
    Route::resource('{bride}/favpost', 'FavpostController');
});


/**
 * @groom routes
 */
Route::group(['namespace' => 'Groom', 'prefix' => 'groom', 'as' => 'groom'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::resource('{groom}/profile', 'ProfileController');
    Route::resource('{groom}/Welcome', 'GroomController');
    Route::resource('{groom}/shortlisted', 'ShortlistedController');
    Route::resource('{groom}/todolist', 'TodolistController');
    Route::resource('{groom}/worklist', 'WorklistController');
    Route::resource('{groom}/favpost', 'FavpostController');
});




/**
 * @vendor routes
 */
//Route::get('vendor/welcome', 'Vendor\VendorController@index')->middleware(['auth:company,vendor,host','verified'])->name('vendorwelcome');
Route::get('vendor/welcome', 'Vendor\VendorController@index')->name('vendorwelcome');


//Route::group(['namepspace' => 'Vendor', 'middleware' => ['auth:company,vendor,host','verified'], 'prefix' => 'vendor', 'as' => 'vendor'], function()
Route::group(['namepspace' => 'Vendor', 'prefix' => 'vendor', 'as' => 'vendor'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::resource('vendor', 'Vendor\VendorController');




    Route::resource('vendor/{vendor?}/profile', 'Vendor\ProfileController');


    Route::resource('vendor/{vendor?}/products', 'Vendor\ProductController');
    Route::resource('vendor/{vendor?}/category', 'Vendor\CategoryController');
    //old services controller and route
    Route::resource('vendor/{vendor?}/services', 'Vendor\ServiceController');
    //new services controller and route
    Route::resource('vendor/{vendor?}/servicesnew', 'Vendor\ServiceNewController');

    Route::resource('vendor/{vendor?}/servicesmultiple', 'Vendor\ServiceMultipleController');


    Route::resource('vendor/{vendor?}/leads', 'Vendor\LeadController');
    Route::resource('vendor/{vendor?}/projects', 'Vendor\ProjectController');
    Route::resource('vendor/{vendor?}/reviews', 'Vendor\ReviewController');
    Route::resource('vendor/{vendor?}/calendar', 'Vendor\CalendarController');
});

//vendor services routes
Route::get('vendorsProducts/{id}/{catid}', 'Vendor\ServiceNewController@productGet');


//Route::group(['namespace' => 'Vendor\Service', 'middleware' => ['auth:company,vendor,host','verified'],  'as' => 'vendor'], function()
Route::group(['namespace' => 'Vendor\Service',  'as' => 'vendor'], function () {
    Route::resource('{vendor?}/wservices', 'WVendorController');


    // accomodation and venue routes

    Route::resource('{services?}/{vendor?}/accommodation', 'AccommodationController');
    Route::resource('services/{vendor?}/logistics-and-accommodation', 'AccommodationController');

    Route::resource('{services?}/{vendor?}/venues', 'VenueController');
    Route::resource('{services?}/{vendor?}/wear-style-makeup', 'WearStyleMakeupController');









    Route::resource('{vendor?}/anchors', 'AnchorController');
    Route::resource('{vendor?}/bandbaja', 'BandbajaController');
    Route::resource('{vendor?}/bartenders', 'BartenderController');
    Route::resource('{vendor?}/bridal-jewellery', 'BridalJewelleryController');
    Route::resource('{vendor?}/bridal-jewellery-on-rent', 'JewelleryOnRentController');
    Route::resource('{vendor?}/bridal-styles-and-wears', 'BridalStyleController');
    Route::resource('{vendor?}/bridal-makeup-artists', 'BridalMakeupController');
    Route::resource('{vendor?}/bridal-mehendi-artists', 'BridalMehendiController');
    Route::resource('{vendor?}/cakes', 'CakeController');
    Route::resource('{vendor?}/car-rental-service', 'CarRentalController');
    Route::resource('{vendor?}/catering', 'CateringController');
    Route::resource('{vendor?}/chaat-and-food-stalls', 'ChaatBhandarController');
    Route::resource('{vendor?}/choreographers', 'ChoreographerController');
    Route::resource('{vendor?}/clothing-rentals', 'ClothingRentalController');
    Route::resource('{vendor?}/dj-musicians-entertainment', 'DjArtistController');
    Route::resource('{vendor?}/entertainment', 'EntertainmentController');
    Route::resource('{vendor?}/family-makeup-artists', 'FamilyMakeupController');
    Route::resource('{vendor?}/favors-and-gifts', 'FavorsGiftController');
    Route::resource('{vendor?}/flower-decorators', 'FlowerDecoratorController');
    Route::resource('{vendor?}/ghoriwala-baggi-and-palkiwale', 'GhoriwalaController');
    Route::resource('{vendor?}/groom-makeup-artists', 'GroomMakeupController');
    Route::resource('{vendor?}/groom-styles-and-wears', 'GroomStyleController');
    Route::resource('{vendor?}/health-and-beauty', 'HealthBeautyController');
    Route::resource('{vendor?}/home-catering', 'HomeCateringController');
    Route::resource('{vendor?}/honeymoon-planners', 'HoneymoonPlannerController');
    Route::resource('{vendor?}/honeymoon-packages', 'HoneymoonPackageController');
    Route::resource('{vendor?}/invitation-cards', 'InvitationCardController');
    Route::resource('{vendor?}/jewellery-stores', 'JewelleryStoreController');
    Route::resource('{vendor?}/lighting-designers', 'LightingDesignerController');
    Route::resource('{vendor?}/miscellenous', 'MiscellenousController');
    Route::resource('{vendor?}/photographers', 'PhotographerController');
    Route::resource('{vendor?}/prewed-photographers', 'PrewedPhotographerController');
    Route::resource('{vendor?}/prewed-videographers', 'PrewedVideographerController');
    Route::resource('{vendor?}/security-services', 'SecurityServiceController');
    Route::resource('{vendor?}/transportation', 'TransportationController');
    Route::resource('{vendor?}/videographers', 'VideographerController');
    Route::resource('{vendor?}/wedding-decors', 'WeddingDecorsController');
    Route::resource('{vendor?}/wedding-planners', 'WeddingPlannerController');
    Route::resource('{vendor?}/wedding-priests', 'WeddingPriestController');
    Route::resource('{vendor?}/wedding-stationery', 'WeddingStationeryController');
    Route::resource('{vendor?}/wedding-stylists-and-designers', 'WeddingStylistController');
});



/**
 * @company routes
 */
Route::get('company/welcome', 'Company\CompanyController@index')->name('companywelcome');
//Route::group(['namepspace' => 'Company', 'middleware' => ['auth:company,vendor,host','verified'], 'prefix' => 'company', 'as' => 'company'], function()
Route::group(['namepspace' => 'Company', 'prefix' => 'company', 'as' => 'company'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::resource('company/{company?}/leads', 'Company\LeadController');
    Route::resource('company/{company?}/projects', 'Company\ProjectController');
    Route::resource('company/{company?}/profile', 'Company\ProfileController');
    Route::resource('company/{company?}/reviews', 'Company\ReviewController');
    Route::resource('company/{company?}/calendar', 'Company\CalendarController');
});

/**
 * admin routes
 */
//Import Routes
Route::get('admin/import', 'Admin\AdminController@getimport')->name('getimportform');
Route::post('admin/import/{type}', 'Admin\AdminController@import')->name('adminimport');

Route::get('admin/export/{type}', 'Admin\AdminController@export')->name('adminexport');

Route::get('admin/sample-export/{type}', 'Admin\AdminController@sample')->name('adminsampleexport');


//Export Routes
// Route::get('admin/export/{type}', 'Admin\VendorController@export')->name('adminexport');
Route::get('admin/exports/task', 'Admin\TaskController@export')->name('admintaskexport');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin'], function () {
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/{url}', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('/welcome', 'AdminController@index')->name('welcome');
    Route::resource('/location', LocationController::class);
    Route::resource('/venues', VenueController::class);
    Route::resource('/accommodation', 'AccommodationController');
    Route::resource('/anchors', AnchorController::class);
    Route::resource('/ceramony', CeramonyController::class);
    Route::resource('/task', TaskController::class);
    Route::resource('/vendor', VendorController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/articles', ArticleController::class);
    Route::resource('/testimonials', TestimonialController::class);
    Route::resource('/tag', TagController::class);
    Route::resource('/service', ServiceController::class);
    // Route::post('/vendor', 'VendorController@importguests')->name('importguests');

    // Route::get('vendor-categories', ['as' => 'vendorfilter', 'uses' => 'VendorController@filter']);
    Route::get('vendor-categories', ['as' => 'categoryfilter', 'uses' => 'CategoryController@filter']);
    Route::get('service-categories', ['as' => 'servicefilter', 'uses' => 'ServiceController@filter']);
    Route::get('task-categories', ['as' => 'taskfilter', 'uses' => 'TaskController@filter']);
    Route::get('location-cities', ['as' => 'locationfilter', 'uses' => 'LocationController@filter']);
});


// Route::get('category', ['uses' => 'Admin\CategoryController@manageCategory']);
// Route::post('category', ['as' => 'addcategory', 'uses' => 'Admin\CategoryController@addCategory']);
/**
 * @login, @register routes
 */





/**
 * main app routes
 */
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


//fallback route
Route::get('nodisplay', function (Host $host) {
    return view('404', ['message' => 'Nothing to Display, try again?']);
})->name('nodisplay');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');















