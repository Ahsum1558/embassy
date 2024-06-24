<div id="addNewVisaTrade" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Visa Trade</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card_line">
                    <div class="card-header card_headline">
                        <h4 class="card-title headline">Add New Visa Trade</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.visaTrade.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                                 @csrf
                                <div class="profile-personal-info">

                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Visa Trade<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="visatrade_name" class="form-control d-inline-block inline_setup" placeholder="Enter Visa Trade" value="{{ old('visatrade_name') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                          <option selected="selected">Select Type</option>
                                          <option value="1">Active</option>
                                          <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="modal-footer col-9 mybtn">
                                        <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                                        <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>