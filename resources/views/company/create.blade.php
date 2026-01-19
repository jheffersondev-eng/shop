@extends('components.app.app')
@section('title', 'Cadastrar Loja')
@section('content')
<form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
	@csrf
	@include('company.form')
</form>
@endsection
