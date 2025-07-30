<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin\Tag;
use Illuminate\Http\Request;
use App\Models\Admin\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TestimonialResource;
use App\Wed\Happy;

class TestimonialController extends Controller
{
    public function index()
    {
        // Get testimonials
        $testimonials = Testimonial::latest()->paginate(5);
        $testimonialCount = Testimonial::count();
        // $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(5);

        $loggedIn = auth()->guard('admin')->user();

        // Return collection of testimonials as a resource
        return view('admin.testimonials.index', compact('loggedIn', 'testimonials', 'testimonialCount'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testimonial = new Testimonial;
        $loggedIn = auth()->guard('admin')->user();
        $tags = array_filter(Tag::pluck('name', 'id')->toArray());
        return view('admin.testimonials.create', compact('testimonial', 'loggedIn', 'tags'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('ss000', Happy::getGuard());
        $loggedIn = auth()->guard('admin')->user() ?? auth()->guard('host')->user() ?? auth()->guard('web')->user();
        $data = $this->requestValidate();
        $data['slug'] = strtolower(preg_replace('/\s+/', '-', $loggedIn->name));
        if ($image = $request->file('imageOne')) {
            $destinationPath = 'assets/defaults/testimonials/images/';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $locationImage, 'public');
            $data['imageOne'] = "$locationImage";
        } else {
            unset($data['imageOne']);
        }
        try {
            $testimonial =  $loggedIn->testimonials()->create($data);
            if ($testimonial) {
                switch (Happy::getGuard()) {
                    case 'admin':
                        return redirect()->route('admintestimonials.index')->with([
                            'status' => 'success',
                            'message' => "new Testimonial Added Successfully",
                        ]);
                        break;
                    case 'host':
                        // dd('ss');
                        return response([
                            'message' => 'Testimonial Added Successfully!',
                        ]);
                        break;
                    case 'web':
                        return response([
                            'message' => 'Testimonial Added Successfully!',
                        ]);
                        break;
                    default:
                        break;
                }
            }
        } catch (Exception $e) {
            return redirect("testimonials")->with([
                'status' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.testimonials.show', compact('testimonial', 'loggedIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $tags = array_filter(Tag::pluck('name', 'id')->toArray());
        $loggedIn =  auth()->guard('admin')->user();
        return view('admin.testimonials.edit', compact(['testimonial', 'loggedIn', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * public function update(Request $request, $id) was earliest by default
     * fetching request from form and $id was passed automaticlly by laravel
     **/
    public function update(Testimonial $testimonial, Request $request)
    {
        $data = $this->requestValidate();
        $data['slug'] = strtolower(preg_replace('/\s+/', '-', request()->title));
        if ($image = $request->file('imageOne')) {
            $destinationPath = 'assets/defaults/testimonials/images/';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $locationImage, 'public');
            $data['imageOne'] = "$locationImage";
        } else {
            unset($data['imageOne']);
        }

        if (request()->priority !== $testimonial->priority) {
            $testimonial->update(request(['priority']));
        }
        $testimonial->update(['status' => request()->has('status')]);
        try {
            $testimonial->update($data + ['slug' => strtolower(preg_replace('/\s+/', '-', request()->title))]);
            //dd('reached');
            $testimonial->tags()->sync(request()->input('tag_list'));

            return redirect()->route('admintestimonials.index')->with([
                'status' => 'success',
                'message' => $testimonial->title . ' was updated successfully',
            ]);
        } catch (Exception $e) {
            //dd($e);
            return redirect("admintestimonials.index")->with([
                'status' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $deleted = $testimonial->delete();

        if ($deleted) {
            // $testimonial->tags()->detach([$testimonial->tags()->first()->id]);
            return back()->with([
                'status' => 'success',
                'message' => "Testimonial Deleted Successully"
            ]);
        }
    }

    /**
     * Validatating the form data.
     *
     * @param  \App\Testimonial  $article
     * @return \Illuminate\Http\Response
     */

    private function requestValidate()
    {

        return request()->validate(
            [
                'title' => ['sometimes', 'min:5', 'max:255'],
                'body' => ['required', 'min:10', 'max:1024'],
                'excerpt' => ['sometimes'],
                'status' => ['sometimes'],
                'priority' => ['sometimes'],
                'published_at' => ['sometimes'],
                'imageOne' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'idea & inspiration name is required & minimum 3 characters are required',
                'body.required' => 'idea and inspiration Description is required',
                'priority.required' => 'Choose Task Priority',
                'published_at.required' => 'chose publishing status'
            ]
        );
    }
}
