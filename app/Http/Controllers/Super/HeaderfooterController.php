<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Field;
use App\Models\Headerfooter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class HeaderfooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $header_footer_data = $this->getInfo();
        return view('super.setting.index', compact('header_footer_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $header_footer_data = Headerfooter::latest() -> get(); // as latest
        $field_data = Field::latest()->where('status','=',1) -> get(); // as latest

        return view('super.setting.create', [
            'header_footer_data'=>$header_footer_data,
            'field_data'=>$field_data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        // $field_data = Field::findOrFail($request->field_id); 

        $header_footer_data = new Headerfooter();

        // $header_footer_data->field_id   = $field_data->id;
        $header_footer_data->field_id       = $request->field_id; 
        $header_footer_data->footer_title   = $request->footer_title; 
        $header_footer_data->content        = $request->content; 
        $header_footer_data->type           = $request->type; 
        $header_footer_data->menu           = $request->menu; 
        $header_footer_data->contact_info   = $request->contact_info; 
        $header_footer_data->links          = $request->links; 
        $header_footer_data->status         = $request->status;

        $existingRecord = Headerfooter::first();
        if (!$existingRecord) {
            // Headerfooter::create($header_footer_data);
            $header_footer_data->save();
        return redirect() -> back() -> with('message', 'Header and Footer Option is added successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'Header and Footer Option is already exist in the table !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $header_footer_single_data = $this->getDetails($id);
        
        if($header_footer_single_data->count() > 0){
            return view('super.setting.show', compact('header_footer_single_data'));
        }else{
            return redirect('/super/setting');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $header_footer_info = $this->getDetails($id);
        $field_data_info = Field::all()->where('status','=',1); 

        if($header_footer_info->count() > 0){
                return view('super.setting.edit', [
                'header_footer_info'=>$header_footer_info,
                'field_data_info'=>$field_data_info
            ]);
        }else{
            return redirect('/super/setting');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        $header_footer_info = Headerfooter::findOrFail($id);

        $header_footer_info->field_id       = $request->field_id; 
        $header_footer_info->footer_title   = $request->footer_title; 
        $header_footer_info->content        = $request->content; 
        $header_footer_info->type           = $request->type; 
        $header_footer_info->menu           = $request->menu; 
        $header_footer_info->contact_info   = $request->contact_info; 
        $header_footer_info->links          = $request->links; 
        $header_footer_info->status         = $request->status;
        $header_footer_info->update();              

        return back()->with('message', 'Header and Footer Option is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_header_footer = Headerfooter::find($id);
        $data_header_footer -> delete();

        return redirect() -> back() -> with('message', 'The Header and Footer data is deleted successfully');
    }

    public function infoSuper(Request $request)
    {
        $session_info = $this->getInfo();
        if ($session_info) {
            $request->session()->put('session_info', $session_info);
        }
        return view('super.home.index');
    }

    public function inactive($id)
    {

        $setting_inactive = Headerfooter::findOrFail($id);

        $setting_inactive->status          = 0;
        $setting_inactive->update();              

        return redirect('/super/setting')->with('message', 'The Header and Footer Option is Inactive Successfully');
    }
    
    public function active($id)
    {

        $setting_active = Headerfooter::findOrFail($id);

        $setting_active->status        = 1;
        $setting_active->update();              

        return redirect('/super/setting')->with('message', 'The Header and Footer Option is Active Successfully');
    }

    protected function getDetails($id){
        $header_footer_single_data_info = Headerfooter::leftJoin('fields','headerfooters.field_id','=','fields.id')
        ->where('headerfooters.id', $id)
        ->select('headerfooters.*', 'fields.title', 'fields.smalltitle', 'fields.license','fields.licenseExpiry', 'fields.address', 'fields.proprietor', 'fields.proprietortitle', 'fields.telephone', 'fields.cellphone', 'fields.helpline','fields.email', 'fields.web', 'fields.logo')->get();
        return $header_footer_single_data_info;
    }

    protected function getInfo(){
        $data_info = Headerfooter::leftJoin('fields','headerfooters.field_id','=','fields.id')
        ->select('headerfooters.*', 'fields.title', 'fields.smalltitle', 'fields.license', 'fields.licenseExpiry', 'fields.address', 'fields.logo')
        ->limit(1)->get();
        return $data_info;
    }

    protected function validation($request){
        $this -> validate($request, [
            'field_id'      => 'required|exists:fields,id',
            'footer_title'  => 'required',
            'contact_info'  => 'required',
            'content'       => 'required',
            'links'         => 'required',
            'status'        => 'required|in:1,0',
        ],
        [
            'footer_title.required' => 'Footer Title Field must not be Empty',
            'contact_info.required' => 'Contact Info Field must not be Empty',
            'content.required'      => 'Content Field must not be Empty',
            'links.required'        => 'Links Field must not be Empty',
            'field_id.required'     => "Office Field is required !!",
            'field_id.exists'       => "Invalid Office Field !!",
            'status.required'       => 'Status Field is required',
            'status.in'             => 'Invalid status option selected',
        ]);
    }
}