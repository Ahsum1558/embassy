<!-- Delete -->
<div id="delUpzila{{ $upzila->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Police Station</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Are you sure you want to Delete !</h5>
                <h2 class="text-center">{{ $upzila->policestationname }}</h2>
                <h4 class="text-center">{{ $upzila->districtname }}</h4>
            </div>
            <div class="modal-footer mybtn">
                <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                <a href="{{ route('super.policestation.destroy', ['id'=>$upzila->id]) }}" class="form-control inline_setup btn submitbtn text-uppercase">Delete</a>
            </div>
        </div>
    </div>
</div>