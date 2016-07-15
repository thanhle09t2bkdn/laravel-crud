@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Food</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($food, ['route' => ['foods.update', $food->id], 'method' => 'patch']) !!}

            @include('foods.fields')

            {!! Form::close() !!}
        </div>
@endsection
