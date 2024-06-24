<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visatrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class VisatradeController extends Controller
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
        $all_visa_trade = Visatrade::orderBy('visatrade_name', 'asc')->get();
        return view('admin.visa.visatrade.index', compact('all_visa_trade'));
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
            return view('admin.visa.visatrade.index');
        }else{
            return redirect('/visaTrade');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Visatrade::create([
            'visatrade_name'  => $request->visatrade_name,
            'status'          => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Visa Trade is added successfully');
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
        $single_visaTrade = Visatrade::find($id);
        
        if ($single_visaTrade !== null) {
            return view('admin.visa.visatrade.show', compact('single_visaTrade'));
        }else{
            return redirect('/visaTrade');
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
        $visaTrade_data = Visatrade::find($id);

        if(Auth::check() && Auth::user()->role == 'admin' && (Auth::user()->title || Auth::user()->license || Auth::user()->title_bn || Auth::user()->license_bn || Auth::user()->title_ar || Auth::user()->license_ar)){
        
        if ($visaTrade_data !== null) {
            return view('admin.visa.visatrade.edit', compact('visaTrade_data'));
            }else{
                return redirect('/visaTrade');
            }
        }else{
            return redirect('/visaTrade');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request, [
            'visatrade_name'  => 'required|unique:visatrades',
        ],
        [
            'visatrade_name.required' => 'Visa Trade Field must not be Empty',
            'visatrade_name.unique'   => 'The Visa Trade is already exist',
        ]);
        $visaTrade_data = Visatrade::findOrFail($id);

        $visaTrade_data->visatrade_name   = $request->visatrade_name;
        $visaTrade_data->update();              

        return back()->with('message', 'The Visa Trade is Updated Successfully');
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
        $data_visaTrade = Visatrade::find($id);
        $data_visaTrade -> delete();

        return redirect() -> back() -> with('message', 'The Visa Trade is deleted successfully');
    }

    public function inactive($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $visatrade_inactive = Visatrade::findOrFail($id);

        $visatrade_inactive->status      = 0;
        $visatrade_inactive->update();              

        return redirect('/visaTrade')->with('message', 'The Visa Trade is Inactive Successfully');
    }
    
    public function active($id)
    {
        if (Auth::check() && Auth::user()->type !== 'approve') {
            return redirect('/');
        }
         if (strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d'))) {
            return redirect('/');
        }
        $visatrade_active = Visatrade::findOrFail($id);

        $visatrade_active->status    = 1;
        $visatrade_active->update();              

        return redirect('/visaTrade')->with('message', 'The Visa Trade is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'visatrade_name'  => 'required|unique:visatrades',
            'status'          => 'required|in:1,0',
        ],
        [
            'visatrade_name.required' => 'Visa Trade Field must not be Empty',
            'visatrade_name.unique'   => 'The Visa Trade is already exist',
            'status.required'         => 'Status Field is required',
            'status.in'               => 'Invalid status option selected',
        ]);
    }
}