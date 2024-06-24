<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Field;
use Illuminate\Support\Facades\File;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_field = Field::latest() -> get(); // as latest
        return view('super.field.index', compact('all_field'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super.field.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('logo')) {

            $request->validate([
            'logo' => 'required|file|max:40', 
            ]);
            $img = $request -> file('logo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            if ($img->getSize() > 40 * 1024) {
                return back()->withErrors(['logo' => 'The file size should not exceed 40 KB.'])->withInput();
            }
            $img->move(public_path('admin/uploads/field/'), $unique_file_name);

            $this->validation($request);

        Field::create([
            'title'             => $request->title,
            'smalltitle'        => $request->smalltitle,
            'license'           => $request->license,
            'licenseExpiry'     => $request->licenseExpiry,
            'description'       => $request->description,
            'address'           => $request->address,
            'proprietor'        => $request->proprietor,
            'proprietortitle'   => $request->proprietortitle,
            'telephone'         => $request->telephone,
            'cellphone'         => $request->cellphone,
            'helpline'          => $request->helpline,
            'web'               => $request->web,
            'email'             => $request->email,
            'status'            => $request->status,
            'logo'              => $unique_file_name,
        ]);
        return redirect() -> back() -> with('message', 'Field Option in English is added successfully');
        }else{
            $this->validation($request);

        Field::create([
            'title'             => $request->title,
            'smalltitle'        => $request->smalltitle,
            'license'           => $request->license,
            'licenseExpiry'     => $request->licenseExpiry,
            'description'       => $request->description,
            'address'           => $request->address,
            'proprietor'        => $request->proprietor,
            'proprietortitle'   => $request->proprietortitle,
            'telephone'         => $request->telephone,
            'cellphone'         => $request->cellphone,
            'helpline'          => $request->helpline,
            'web'               => $request->web,
            'email'             => $request->email,
            'status'            => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Field Option in English is added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_field_data = Field::find($id);
        
        if ($single_field_data !== null) {
            return view('super.field.show', compact('single_field_data'));
        }else{
            return redirect('/super/field');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $field_data = Field::find($id);
        if ($field_data !== null) {
            return view('super.field.edit', compact('field_data'));
        }else{
            return redirect('/super/field');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validationInfo($request);

        $field_data = Field::findOrFail($id);

        $field_data->licenseExpiry      = $request->licenseExpiry;
        $field_data->description        = $request->description;
        $field_data->address            = $request->address;
        $field_data->proprietor         = $request->proprietor;
        $field_data->proprietortitle    = $request->proprietortitle;
        $field_data->telephone          = $request->telephone;
        $field_data->cellphone          = $request->cellphone;
        $field_data->helpline           = $request->helpline;
        $field_data->web                = $request->web;
        $field_data->email              = $request->email;
        $field_data->status             = $request->status;
        $field_data->update();              

        return back()->with('message', 'The English Site Option Information is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Field::find($id);
        $data -> delete();

        if(File::exists('public/admin/uploads/field/' .$data->logo)) {
            File::delete('public/admin/uploads/field/' .$data->logo);
        }

        return redirect() -> back() -> with('message', 'The English Site Option data is deleted successfully');
    }

    public function editTitle($id)
    {
        $field_data_title = Field::find($id);
        
        if ($field_data_title !== null) {
            return view('super.field.edit_title', compact('field_data_title'));
        }else{
            return redirect('/super/field');
        }
    }

    public function updateTitle(Request $request, $id)
    {
        $this->validationTitle($request);
        
        $field_data_title = Field::findOrFail($id);

        $field_data_title->title        = $request->title;
        $field_data_title->update();              

        return back()->with('message', 'The English Site Option Title is Updated Successfully');
    }

    public function editSmallTitle($id)
    {
        $field_data_small_title = Field::find($id);
        if ($field_data_small_title !== null) {
            return view('super.field.edit_small_title', compact('field_data_small_title'));
        } else {
            return redirect('/super/field');
        }
    }

    public function updateSmallTitle(Request $request, $id)
    {
        $this->validationSmallTitle($request);

        $field_data_small_title = Field::findOrFail($id);

        $field_data_small_title->smalltitle        = $request->smalltitle;
        $field_data_small_title->update();              

        return back()->with('message', 'The English Site Option Small Title is Updated Successfully');
    }

    public function editLicense($id)
    {
        $field_data_license = Field::find($id);
        
        if ($field_data_license !== null) {
            return view('super.field.edit_license', compact('field_data_license'));
        }else{
            return redirect('/super/field');
        }
    }

    public function updateLicense(Request $request, $id)
    {
        
        $this->validationLicense($request);

        $field_data_license = Field::findOrFail($id);

        $field_data_license->license        = $request->license;
        $field_data_license->update();              

        return back()->with('message', 'The English Site Option License Number is Updated Successfully');
    }

    public function editLogo($id){
        $field_data_logo = Field::find($id);
        
        if ($field_data_logo !== null) {
            return view('super.field.edit_logo', compact('field_data_logo'));
        }else{
            return redirect('/super/field');
        }
    }

    public function updateLogo(Request $request, $id){
       $field_data_logo = Field::findOrFail($id);

       $request->validate([
            'new_photo' => 'required|file|max:40', 
        ]);

        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();

            if ($img->getSize() > 40 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 40 KB.'])->withInput();
            }

            $img->move(public_path('admin/uploads/field/'), $unique_file_name);
            // if(file_exists('public/admin/uploads/field/' .$request->old_photo)){
            //     unlink('public/admin/uploads/field/' .$request->old_photo);
            // }
            if(File::exists('public/admin/uploads/field/' .$request->old_photo)) {
                File::delete('public/admin/uploads/field/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }

        $field_data_logo->logo     = $unique_file_name;
        $field_data_logo->update();
        
        return back()->with('message', 'Logo is Updated Successfully');
    }

    public function inactive(Request $request, $id)
    {

        $field_inactive = Field::findOrFail($id);

        $field_inactive->title        = $request->title;
        $field_inactive->status       = 0;
        $field_inactive->update();              

        return redirect('/super/field')->with('message', 'The English Site Option is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $field_active = Field::findOrFail($id);

        $field_active->title        = $request->title;
        $field_active->status       = 1;
        $field_active->update();              

        return redirect('/super/field')->with('message', 'The English Site Option is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'title'         => 'required|unique:fields',
            'smalltitle'    => 'required|unique:fields',
            'license'       => 'required|unique:fields',
            'email'         => 'required|email|max:255',
            'licenseExpiry' => 'required|date',
            'description'   => 'required',
            'proprietor'    => 'required',
            'address'       => 'required',
            'cellphone'     => 'required',
            'status'        => 'required|in:1,0',
        ],
        [
            'title.required'        => 'Title Field must not be Empty',
            'title.unique'          => 'The Title is already exist',
            'smalltitle.required'   => 'Small Title Field must not be Empty',
            'smalltitle.unique'     => 'The Small Title is already exist',
            'email.required'        => 'E-Mail Field must not be Empty',
            'email.email'           => "E-Mail Address is not valid !!",
            'licenseExpiry.required' => 'License Expiry Date Field must not be Empty',
            'description.required'  => 'Description Field must not be Empty',
            'license.required'      => 'License Field is required',
            'license.unique'        => 'The License Number is already exist',
            'proprietor.required'   => 'Proprietor Name Field must not be Empty',
            'address.required'      => 'Address Field must not be Empty',
            'cellphone.required'    => 'Cellphone Field must not be Empty',
            'status.required'       => 'Status Field is required',
            'status.in'             => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'email'         => 'required|email|max:255',
            'licenseExpiry' => 'required|date',
            'description'   => 'required',
            'proprietor'    => 'required',
            'address'       => 'required',
            'cellphone'     => 'required',
            'status'        => 'required|in:1,0',
        ],
        [
            'email.required'        => 'E-Mail Field must not be Empty',
            'email.email'           => "E-Mail Address is not valid !!",
            'licenseExpiry.required' => 'License Expiry Date Field must not be Empty',
            'description.required'  => 'Description Field must not be Empty',
            'proprietor.required'   => 'Proprietor Name Field must not be Empty',
            'address.required'      => 'Address Field must not be Empty',
            'cellphone.required'    => 'Cellphone Field must not be Empty',
            'status.required'       => 'Status Field is required',
            'status.in'             => 'Invalid status option selected',
        ]);
    }

    protected function validationTitle($request){
        $this -> validate($request, [
            'title'         => 'required|unique:fields',
        ],
        [
            'title.required'        => 'Title Field must not be Empty',
            'title.unique'          => 'The Title is already exist',
        ]);
    }

     protected function validationSmallTitle($request){
        $this -> validate($request, [
            'smalltitle'         => 'required|unique:fields',
        ],
        [
            'smalltitle.required'        => 'Small Title Field must not be Empty',
            'smalltitle.unique'          => 'The Small Title is already exist',
        ]);
    }

    protected function validationLicense($request){
        $this -> validate($request, [
            'license'       => 'required|unique:fields',
        ],
        [
            'license.required'      => 'License Field is required',
            'license.unique'        => 'The License Number is already exist',
        ]);
    }
}