@extends('auth.app')

@section('content')
@csrf

@endsection

@section('js_after')
<script type="text/javascript" src="{{ asset('js-chat/twiliochat-boot.js?1') }}"></script>

@endsection