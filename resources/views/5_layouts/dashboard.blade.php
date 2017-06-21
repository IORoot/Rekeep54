@extends('5_layouts.1_pages.rekeep')

    @section('header')
        @include('2_variables._header')
    @endsection


    @section('menubar')
        @include('4_features/5_mobile/._menubar')
    @endsection


    @section('logo')
        @include('3_components.1_sidebar._headerlogo')
    @endsection


    @section('sidebar')
        @include('4_features.1_sidebar._userdetails')
        @include('4_features.1_sidebar._menutree')
        @include('4_features.1_sidebar._footerbar')
    @endsection


    @section('menusettings')
        @include('4_features.2_settings._menusettings')
    @endsection

    @section('pagesettings')
        @include('4_features.2_settings._pagesettings')
    @endsection

    @section('contentbar')
        @include('4_features.3_content._contentbar')
    @endsection
    @section('content')
        @include('4_features.3_content._content')
    @endsection


    @section('nodedetails')
        @include('4_features.4_details._nodedetails')
    @endsection


    @section('scripts')
        @include('2_variables/._scripts')
    @endsection

    @section('flashmessages')
        @include('3_components._flashmessages')
    @endsection