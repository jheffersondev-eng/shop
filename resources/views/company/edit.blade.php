@extends('components.app.app')
@section('title', 'Editar Loja')
@section('content')
<form method="POST" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	@include('company.form')
</form>
@endsection
