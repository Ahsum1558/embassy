<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Cmspage;
use Illuminate\Support\Facades\DB;

class CmspageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_meta = Cmspage::latest() -> get(); // as latest
        return view('super.meta.index', compact('all_meta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super.meta.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Cmspage::create([
            'title'             => $request->title,
            'meta_title'        => $request->meta_title,
            'description'       => $request->description,
            'meta_description'  => $request->meta_description,
            'url'               => $request->url,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Meta added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $single_meta_data = Cmspage::find($id);

        if ($single_meta_data !== null) {
            return view('super.meta.show', compact('single_meta_data'));
        }else{
            return redirect('/super/meta');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $meta_data = Cmspage::find($id);

        if ($meta_data !== null) {
            return view('super.meta.edit', compact('meta_data'));
        }else{
            return redirect('/super/meta');
        }

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        $meta_data = Cmspage::findOrFail($id);

        $meta_data->title               = $request->title;
        $meta_data->meta_title          = $request->meta_title;
        $meta_data->description         = $request->description;
        $meta_data->meta_description    = $request->meta_description;
        $meta_data->meta_keywords       = $request->meta_keywords;
        $meta_data->status              = $request->status;
        $meta_data->update();              

        return back()->with('message', 'Meta Information is Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Cmspage::find($id);
        $data -> delete();

        return redirect() -> back() -> with('message', 'Meta data deleted successfully');
    }

    public function inactive($id)
    {

        $meta_inactive = Cmspage::findOrFail($id);

        $meta_inactive->status       = 0;
        $meta_inactive->update();              

        return redirect('/super/meta')->with('message', 'The Meta Info is Inactive Successfully');
    }
    
    public function active($id)
    {

        $meta_active = Cmspage::findOrFail($id);

        $meta_active->status       = 1;
        $meta_active->update();              

        return redirect('/super/meta')->with('message', 'The Meta Info is Active Successfully');
    }

    public function metaSuper(Request $request)
    {
         // $session_meta = DB::table('cmspages')->get();
        $session_meta = Cmspage::latest() -> get();
        if ($session_meta) {
            $request->session()->put('session_meta', $session_meta);
        }
        return view('super.home.index');
    }

    protected function validation($request){
        $this -> validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'url'           => 'required',
            'meta_keywords' => 'required',
            'status'        => 'required|in:1,0',
        ],
        [
            'title.required'         => 'Title Field must not be Empty',
            'description.required'   => 'Description Field must not be Empty',
            'url.required'           => 'URL Field is required',
            'meta_keywords.required' => 'Travel Meta Keywords Field is required',
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }
}