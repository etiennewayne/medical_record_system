@extends('layouts.user')

@section('content')
    <welcome-page prop-categories='@json($categories)'></welcome-page>
@endsection
