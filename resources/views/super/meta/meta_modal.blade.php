<div id="viewMeta{{ $meta_data->id }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Meta Information</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<div class="card card_line">
                    <div class="card-header card_headline">
                        <h4 class="card-title headline">Meta Information Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="" class="form-group" method="POST" enctype="multipart/form-data">
                            <div class="row">
                            <!--Tab slider End-->
                                <div class="col-xl-9 col-sm-12">
                                    <div class="product-detail-content">
                                        <!--Product details-->
                                        <div class="new-arrival-content pr">
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">Title<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>{{ $meta_data->title }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">Meta Title<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>{{ $meta_data->meta_title }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>{{ $meta_data->description }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">Meta Description<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>{{ $meta_data->meta_description }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">URL<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>{{ $meta_data->url }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">Meta Keywords<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>{{ $meta_data->meta_keywords }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-8"><span>
                                                    @if($meta_data->status == 1)
                                                        {{ __('Active') }}
                                                        @elseif($meta_data->status == 0)
                                                        {{ __('Inactive') }}
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-3">
                                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($meta_data->created_at)) }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer mybtn">
                        <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>