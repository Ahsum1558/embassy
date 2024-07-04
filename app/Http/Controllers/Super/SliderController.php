<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_slider = Slider::latest() -> get();
        return view('super.slider.index', compact('all_slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slider_data = Slider::latest() -> get();
        return view('super.slider.create', compact('slider_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        if ($request->hasFile('slide_img')) {
            $img = $request->file('slide_img');
            if ($img->getSize() > 4000 * 1024) {
                return back()->withErrors(['slide_img' => 'The file size should not exceed 4 MB.'])->withInput();
            }
            try {
                $unique_file_name = md5(time().rand()) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('admin/uploads/slider/'), $unique_file_name);
                Slider::create([
                    'slide_head'  => $request->slide_head,
                    'slide_des'   => $request->slide_des,
                    'img_url'     => $request->img_url,
                    'des_url'     => $request->des_url,
                    'status'      => $request->status,
                    'slide_img'   => $unique_file_name,
                ]);
                return redirect()->back()->with('message', 'Slider field is added successfully');
            } catch (\Exception $e) {
                \Log::error('File upload error: ' . $e->getMessage());
                return back()->withErrors(['error' => 'An error occurred while uploading the file. Please try again.'])->withInput();
            }
        }
        return back()->withErrors(['slide_img' => 'No file was uploaded.'])->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_slider_data = Slider::find($id);
        if ($single_slider_data !== null) {
            return view('super.slider.show', compact('single_slider_data'));
        }else{
            return redirect('/super/slider');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_slider = Slider::find($id);
        if ($data_slider !== null) {
            return view('super.slider.edit', compact('data_slider'));
        }else{
            return redirect('/super/slider');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validationInfo($request);
        $data_slider = Slider::findOrFail($id);
        $data_slider->slide_head = $request->slide_head;
        $data_slider->slide_des  = $request->slide_des;
        $data_slider->img_url    = $request->img_url;
        $data_slider->des_url    = $request->des_url;
        $data_slider->status     = $request->status;
        $data_slider->update();             

        return back()->with('message', 'The Slider Field Information is Updated Successfully');
    }

    public function editSlider($id){
        $image_slider = Slider::find($id);
        
        if ($image_slider !== null) {
            return view('super.slider.editSlider', compact('image_slider'));
        }else{
            return redirect('/super/slider');
        }
    }

    public function updateSlider(Request $request, $id){
       $image_slider = Slider::findOrFail($id);
       $request->validate([
            'new_photo' => 'required|file|max:4000', 
        ]);
        if ($request->hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            if ($img->getSize() > 4000 * 1024) {
                return back()->withErrors(['new_photo' => 'The file size should not exceed 4 MB.'])->withInput();
            }
            $img->move(public_path('admin/uploads/slider/'), $unique_file_name);
            if(File::exists('public/admin/uploads/slider/' .$request->old_photo)) {
                File::delete('public/admin/uploads/slider/' .$request->old_photo);
              }
        }else{
            $unique_file_name = $request->old_photo;
        }
        $image_slider->slide_img   = $unique_file_name;
        $image_slider->update();
        return back()->with('message', 'Slider Image is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Slider::find($id);
        $data -> delete();
        if(File::exists('public/admin/uploads/slider/' .$data->slide_img)) {
            File::delete('public/admin/uploads/slider/' .$data->slide_img);
        }
        return redirect() -> back() -> with('message', 'The Slider data is deleted successfully');
    }

    public function inactive(Request $request, $id)
    {
        $slider_inactive = Slider::findOrFail($id);
        $slider_inactive->status       = 0;
        $slider_inactive->update();              

        return redirect('/super/slider')->with('message', 'The Slider Field is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {
        $slider_active = Slider::findOrFail($id);
        $slider_active->status       = 1;
        $slider_active->update();              

        return redirect('/super/slider')->with('message', 'The Slider Field is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'slide_img'   => 'required|file', 
            'slide_head'  => 'required',
            'slide_des'   => 'required',
            'img_url'     => 'required|url',
            'des_url'     => 'required|url',
            'status'      => 'required|in:1,0',
        ],
        [
            'slide_img.required'  => 'Image Field must not be Empty',
            'slide_img.file'      => 'The Field must be jpg, jpeg or png file',
            'slide_head.required' => 'Heading Field must not be Empty',
            'slide_des.required'  => 'Description Field must not be Empty',
            'img_url.required'    => 'Image URL Field must not be Empty',
            'img_url.url'         => 'Image URL Field must be valid',
            'des_url.required'    => 'Description URL Field must not be Empty',
            'des_url.url'         => 'Description URL Field must be valid',
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'slide_head'  => 'required',
            'slide_des'   => 'required',
            'img_url'     => 'required|url',
            'des_url'     => 'required|url',
            'status'      => 'required|in:1,0',
        ],
        [
            'slide_head.required' => 'Heading Field must not be Empty',
            'slide_des.required'  => 'Description Field must not be Empty',
            'img_url.required'    => 'Image URL Field must not be Empty',
            'img_url.url'         => 'Image URL Field must be valid',
            'des_url.required'    => 'Description URL Field must not be Empty',
            'des_url.url'         => 'Description URL Field must be valid',
            'status.required'     => 'Status Field is required',
            'status.in'           => 'Invalid status option selected',
        ]);
    }
}