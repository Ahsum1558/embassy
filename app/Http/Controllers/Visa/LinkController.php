<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $all_link = Link::orderBy('linkname', 'asc')->get();
        return view('admin.visa.link.index', compact('all_link'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $link_create = Link::orderBy('linkname', 'asc')->get(); 
        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.visa.link.create', [
                'link_create'       =>  $link_create
            ]);
        }else{
            return redirect('/link');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Link::create([
            'linkname'  => $request->linkname,
            'linkurl'   => $request->linkurl,
            'linktype'  => $request->linktype,
            'status'    => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Url Link is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $single_link = Link::find($id);
        
        if ($single_link !== null) {
            return view('admin.visa.link.show', compact('single_link'));
        }else{
            return redirect('/link');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $link_data = Link::find($id);

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            if ($link_data !== null) {
                return view('admin.visa.link.edit', compact('link_data'));
            }else{
                return redirect('/link');
            }
        }else{
            return redirect('/link');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validationInfo($request);
        $link_data = Link::findOrFail($id);

        $link_data->linkname   = $request->linkname;
        $link_data->linktype   = $request->linktype;
        $link_data->status   = $request->status;
        $link_data->update();              

        return back()->with('message', 'The Url Link Info is Updated Successfully');
    }

    public function editUrl(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $link_url = Link::find($id);

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){        
            if ($link_url !== null) {
                return view('admin.visa.link.editUrl', compact('link_url'));
            }else{
                return redirect('/link');
            }
        }else{
            return redirect('/link');
        }
    }

    public function updateUrl(Request $request, string $id)
    {
        $this->validationUrl($request);
        $link_url = Link::findOrFail($id);

        $link_url->linkurl   = $request->linkurl;
        $link_url->update();              

        return back()->with('message', 'The Url Link is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $data_link = Link::find($id);
        $data_link -> delete();

        return redirect() -> back() -> with('message', 'The Url Link is deleted successfully');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $link_inactive = Link::findOrFail($id);

        $link_inactive->status      = 0;
        $link_inactive->update();              

        return redirect('/link')->with('message', 'The Url Link is Inactive Successfully');
    }
    
    public function active($id)
    {
        if(Auth::check() && Auth::user()->type !== 'approve' && strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))){
            return redirect('/');
        }
        $link_active = Link::findOrFail($id);

        $link_active->status    = 1;
        $link_active->update();              

        return redirect('/link')->with('message', 'The Url Link is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'linkname'  => 'required',
            'linkurl'   => 'required|unique:links',
            'linktype'  => 'required',
            'status'    => 'required|in:1,0',
        ],
        [
            'linkname.required' => 'Link Name Field must not be Empty',
            'linktype.required' => 'Url Link Type Field is required',
            'linkurl.required'  => 'Url Link Field must not be Empty',
            'linkurl.unique'    => 'The Url Link is already exist',
            'status.in'         => 'Invalid status option selected',
            'status.required'   => 'Status Field is required',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'linkname'  => 'required',
            'linktype'  => 'required',
            'status'    => 'required|in:1,0',
        ],
        [
            'linkname.required' => 'Link Name Field must not be Empty',
            'linktype.required' => 'Url Link Type Field is required',
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid status option selected',
        ]);
    }

    protected function validationUrl($request){
        $this -> validate($request, [
            'linkurl'   => 'required|unique:links',
        ],
        [
            'linkurl.required'  => 'Url Link Field must not be Empty',
            'linkurl.unique'    => 'The Url Link is already exist',
        ]);
    }
}