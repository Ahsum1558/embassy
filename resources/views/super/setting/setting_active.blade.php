<!-- active -->
<div id="activeId{{ $header_footer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Active Header and Footer</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('super.setting.active', ['id'=>$header_footer->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Are you sure you want to Active Header and Footer !</h5>
                    <h2 class="text-center">{{ $header_footer->title }}</h2>
                    <h4 class="text-center">{{ $header_footer->license }}</h4>
                    
                    <input type="hidden" name="status" value="1">
                </div>
                <div class="modal-footer mybtn">
                    <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                    <button type="submit" name="active" class="form-control inline_setup btn submitbtn text-uppercase">Active</button>
                </div>
            </form> 
        </div>
    </div>
</div>