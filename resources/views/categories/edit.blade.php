@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Categories</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($categories, ['route' => ['categories.update', $categories->id], 'method' => 'patch']) !!}

            @include('categories.fields')

            {!! Form::close() !!}
        </div>
@endsection
