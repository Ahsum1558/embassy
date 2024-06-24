<!-- Pending -->
<div id="disableId{{ $super_user->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Disable Operator</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('super.operator.disable', ['id'=>$super_user->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Are you sure you want to Disable Operator !</h5>
                    <h2 class="text-center">{{ $super_user->name }}</h2>
                    <h4 class="text-center">{{ $super_user->username }}</h4>
                    
                    <input type="hidden" name="type" value="disable">
                </div>
                <div class="modal-footer mybtn">
                    <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                    <button type="submit" name="disable" class="form-control inline_setup btn submitbtn text-uppercase">Disable</button>
                </div>
            </form> 
        </div>
    </div>
</div>