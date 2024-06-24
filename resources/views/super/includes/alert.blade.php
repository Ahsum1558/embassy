 @if(Session::get('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style='animation: fadeOut 30s; opacity: 0; text-transform: none;'>
      <strong>Success: </strong> {{ Session::get('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

@if(Session::get('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style='animation: fadeOut 30s; opacity: 0; text-transform: none;'>
      <strong>Error: </strong> {{ Session::get('error_message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style='animation: fadeOut 30s; opacity: 0; text-transform: none;'>
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>Error: </strong> {{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif