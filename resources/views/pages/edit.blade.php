@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Page</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($page, ['route' => ['pages.update', $page->id], 'method' => 'patch']) !!}

            @include('pages.fields')

            {!! Form::close() !!}
        </div>
@endsection
