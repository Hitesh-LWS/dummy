@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.requirements.templateTitle')??'Server Requirements' }}
@endsection

@section('title')
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.requirements.title')??'Server Requirement' }}
@endsection

@section('container')

    <H1>
        Welcome to User Registration Block
    </H1>


    {{dd(csrf_token())}}
    <form method="post" action="{{route('LaravelInstaller::getting-started')}}" >
        @csrf
        <input type="text" name="f_name" placeholder="First Name">
        <input type="text" name="l_name" placeholder="Last Name">
        <input class="btn" type="submit" value="Save">
    </form>


@endsection
