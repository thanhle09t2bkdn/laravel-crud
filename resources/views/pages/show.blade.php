@extends('layouts.app')

@section('content')
    @include('pages.show_fields')

    <div class="form-group">
           <a href="{!! route('pages.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
