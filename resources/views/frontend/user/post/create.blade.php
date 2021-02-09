@extends('layouts.app')
@section('style')
    <link
        rel="stylesheet"
        href="{{ asset('frontend/summernote/summernote-bs4.min.css') }}" />
@endsection
@section('content')
<!-- Start Blog Area -->
<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="contact-form-wrap">
                    <h2 class="contact__title">Create Post</h2>
                    {!! Form::open(['route'=>'user.posts.store', 'method'=>'POST', 'files'=>true]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', old('title'), ['class'=>'form-control']) !!}
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', old('description'), ['class'=>'form-control summernote']) !!}
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4">
                            {!! Form::label('category_id', 'Category') !!}
                            {!! Form::select('category_id', [''=>'---']+$categories->toArray(), old('category_id'), ['class'=>'form-control']) !!}
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            {!! Form::label('comment_able', 'Allow Comments?') !!}
                            {!! Form::select('comment_able', ['1'=>'Yes','0'=>'No'], old('comment_able'), ['class'=>'form-control']) !!}
                            @error('comment_able')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', ['1'=>'Active','0'=>'Pending'], old('status'), ['class'=>'form-control']) !!}
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-12">
                            <div class="file-loading">
                                {!! Form::file('images[]', ['id'=>'post-images', 'multiple'=>'multiple']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="contact-btn">
                        {!! Form::button('Publish New Post', ['type' => 'submit', 'class'=>'btn btn-lg btn-block']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                @include('partials.frontend.user.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->
@endsection
@section('script')
    <script src="{{ asset('frontend/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            $('.summernote').summernote({
                tabsize    : 2,
                height     : 200,
                toolbar    : [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            const markupStr = $('.summernote').summernote('code');
            $('.summernote').summernote('code', markupStr);

            $('#post-images').fileinput({
                theme           : 'fa',
                maxFileCount    : 5,
                allowedFileTypes: ['image'],
                showCancel      : true,
                showRemove      : false,
                showUpload      : false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection
