<!-- Delete -->
<div id="removeSubmission{{ $customer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Customer From List</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Are you sure you want to Delete !</h5>
                <h2 class="text-center">{{ $customer->cusFname }} {{ $customer->cusLname }}</h2>
                <h4 class="text-center">{{ $customer->passportNo }}</h4>
            </div>
            <div class="modal-footer mybtn">
                <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                <a href="{{ route('admin.submission.remove', ['id'=>$customer->id]) }}" class="form-control inline_setup btn submitbtn text-uppercase">Remove</a>
            </div>
        </div>
    </div>
</div>