    <meta name="language" content="English">
@foreach($meta_data as $meta)
    <meta name="description" content="{{ $meta->meta_description }}">
    <meta name="keywords" content="{{ $meta->title }}">
    <meta name="keywords" content="{{ $meta->meta_keywords }}">
    <meta name="author" content="{{ $meta->meta_title }}">
@endforeach