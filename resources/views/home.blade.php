@extends('layouts.master')

@section('content')

        <chat-component onlineusers="{{json_encode($active_users) }}"></chat-component>

@endsection
