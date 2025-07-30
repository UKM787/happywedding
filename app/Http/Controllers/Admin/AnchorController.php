<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\CategoryMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Anchor;
use App\Models\Vendor\Service\Accommodation;

class AnchorController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        if (Anchor::all()->isEmpty()) {
            $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
            $categories = VendorMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
            $Anchor = new Anchor();
            return view('admin.anchors.create', compact('admin', 'Anchor', 'locations', 'categories'));
        } else {
            $Anchors = Anchor::latest()->orderBy('name', 'ASC')->get();
            return view('admin.anchors.index')->with(['admin' => $admin, 'Anchors' =>  $Anchors]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = auth()->guard('admin')->user();
        $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
        $categories = VendorMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
        $anchor = new Anchor();
        return view('admin.anchors.create', compact('admin', 'anchor', 'locations', 'categories'));
    }
}
