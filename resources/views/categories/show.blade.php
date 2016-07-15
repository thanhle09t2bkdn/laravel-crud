@extends('layouts.app')

@section('content')
    @include('categories.show_fields')

    <div class="form-group">
           <a href="{!! route('categories.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
