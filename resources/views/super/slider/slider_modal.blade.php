<!-- Delete -->
<div id="delSlider{{ $slider->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Slider</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Are you sure you want to Delete !</h5>
                <h2 class="text-center">{{ $slider->slide_head }}</h2>
                <h4 class="text-center"><img class="img-fluid" src="{{ (!empty($slider->slide_img)) ? url('public/admin/uploads/slider/'.$slider->slide_img) : url('public/admin/assets/images/avatar.png') }}" width="100" alt=""></h4>
            </div>
            <div class="modal-footer mybtn">
                <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                <a href="{{ route('super.slider.destroy', ['id'=>$slider->id]) }}" class="form-control inline_setup btn submitbtn text-uppercase">Delete</a>
            </div>
        </div>
    </div>
</div>