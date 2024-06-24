<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visatype;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class VisatypeController extends Controller
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
        $all_visa_type = Visatype::orderBy('visatype_name', 'asc')->get();
        return view('admin.visa.visatype.index', compact('all_visa_type'));
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

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
            return view('admin.visa.visatype.index');
        }else{
            return redirect('/visaType');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Visatype::create([
            'visatype_name'   => $request->visatype_name,
            'status'          => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Visa Type is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $single_visaType = Visatype::find($id);
        
        if ($single_visaType !== null) {
            return view('admin.visa.visatype.show', compact('single_visaType'));
        }else{
            return redirect('/visaType');
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
        $visaType_data = Visatype::find($id);

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
        
        if ($visaType_data !== null) {
            return view('admin.visa.visatype.edit', compact('visaType_data'));
            }else{
                return redirect('/visaType');
            }
        }else{
            return redirect('/visaType');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request, [
            'visatype_name'  => 'required|unique:visatypes',
        ],
        [
            'visatype_name.required' => 'Visa Type Field must not be Empty',
            'visatype_name.unique'   => 'The Visa Type is already exist',
        ]);
        $visaType_data = Visatype::findOrFail($id);

        $visaType_data->visatype_name   = $request->visatype_name;
        $visaType_data->update();              

        return back()->with('message', 'The Visa Type is Updated Successfully');
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
        $data_visaType = Visatype::find($id);
        $data_visaType -> delete();

        return redirect() -> back() -> with('message', 'The Visa Type is deleted successfully');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $Visatype_inactive = Visatype::findOrFail($id);

        $Visatype_inactive->status      = 0;
        $Visatype_inactive->update();              

        return redirect('/visaType')->with('message', 'The Visa Type is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $visaType_active = Visatype::findOrFail($id);

        $visaType_active->status    = 1;
        $visaType_active->update();              

        return redirect('/visaType')->with('message', 'The Visa Type is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'visatype_name'  => 'required|unique:visatypes',
            'status'         => 'required|in:1,0',
        ],
        [
            'visatype_name.required' => 'Visa Type Field must not be Empty',
            'visatype_name.unique'   => 'The Visa Type is already exist',
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }
}