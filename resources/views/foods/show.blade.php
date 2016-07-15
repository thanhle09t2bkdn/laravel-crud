@extends('layouts.app')

@section('content')
    @include('foods.show_fields')

    <div class="form-group">
           <a href="{!! route('foods.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
