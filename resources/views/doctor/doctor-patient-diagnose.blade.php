@extends('layouts.doctor-layout')

@section('content')
    <doctor-patient-diagnose prop-data='@json($data)'>

    </doctor-patient-diagnose>
@endsection

