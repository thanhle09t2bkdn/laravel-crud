@extends('layouts.app')

@section('content')
        <h1 class="pull-left">Foods</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('foods.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @include('foods.table')
        
@endsection
