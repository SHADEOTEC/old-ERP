@extends('backend.layouts.app')

@section('mystyles')
    <style>
        .note-icon-menu-check {
            visibility: visible !important;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('email_content.save') }}" method="post">
        @csrf
        <div class="d-flex flex-column" style="gap: 2rem">
            @foreach ($files as $template_obj)
                <div>
                    <h4>{{ $template_obj->name }}</h4>
                    <textarea name="{{ $template_obj->file_name }}" id="{{ $template_obj->file_name }}" class="aiz-text-editor" style="width: 100%" rows="10">{{ $template_obj->content }}</textarea>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $('.aiz-text-editor').next().find(".not-editable").attr("contenteditable", false);
    </script>
@endsection
