<!-- active -->
<div id="activeId{{ $district->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Active District</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.district.active', ['id'=>$district->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Are you sure you want to Active !</h5>
                    <h2 class="text-center">{{ $district->districtname }}</h2>
                    <h4 class="text-center">{{ $district->countryname }}</h4>
                    
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