@extends('components.app.app')
@section('title', 'Usuários')
@section('content')
<div class="container-fluid px-4">
	@include('components.message')

	<div class="card shadow-sm border-0 mt-3">
		<div class="card-body">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h5 class="mb-0">Editar usuário</h5>
				<a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
			</div>

			<form method="POST" action="{{ route('user.update', $user->id ?? 0) }}">
				@csrf
				@method('PUT')

				<ul class="nav nav-tabs" id="editUserTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="true">Conta</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="false">Dados pessoais</button>
					</li>
				</ul>

				<div class="tab-content p-3 border border-top-0" id="editUserTabContent">
						<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
							<div class="row g-3">
								<div class="col-md-6">
									<label for="email" class="form-label">E-mail</label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-envelope"></i></span>
										<input type="email" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com" value="{{ old('email', $user->email) }}" required>
									</div>
								</div>

								<div class="col-md-6">
									<label for="profile_id" class="form-label">Perfil</label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-person-badge"></i></span>
										<select class="form-select" id="profile_id" name="profile_id" required>
											<option value="">Selecione</option>
											@foreach($profiles ?? [] as $p)
												<option value="{{ $p->id }}" {{ (string)old('profile_id', $user->profile_id ?? '') === (string)$p->id ? 'selected' : '' }}>{{ $p->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<label for="password" class="form-label">Senha (deixe em branco para manter)</label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-key"></i></span>
										<input type="password" class="form-control" id="password" name="password" placeholder="Nova senha">
									</div>
								</div>

								<div class="col-md-6">
									<label for="password_confirmation" class="form-label">Confirme a senha</label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-key"></i></span>
										<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme a nova senha">
									</div>
								</div>
							</div>
						</div>

					<div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
						<div class="row g-3">
							<div class="col-md-6">
								<label for="name" class="form-label">Nome</label>
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-person"></i></span>
									<input type="text" class="form-control" id="name" name="name" placeholder="Nome completo" value="{{ old('name', optional($user->client)->name_and_surname ?? $user->name) }}" required>
								</div>
							</div>

							<div class="col-md-6">
								<label for="document" class="form-label">Documento</label>
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-person-badge"></i></span>
									<input type="text" class="form-control" id="document" name="document" placeholder="CPF/CNPJ" value="{{ old('document', optional($user->client)->document) }}">
								</div>
							</div>

							<div class="col-md-4">
								<label for="phone" class="form-label">Telefone</label>
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-phone"></i></span>
									<input type="text" class="form-control" id="phone" name="phone" placeholder="(00) 00000-0000" value="{{ old('phone', optional($user->client)->phone) }}">
								</div>
							</div>

							<div class="col-md-4">
								<label for="birth_date" class="form-label">Data de Nascimento</label>
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-calendar"></i></span>
									<input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date', optional($user->client)->birth_date ? optional($user->client)->birth_date->format('Y-m-d') : null) }}">
								</div>
							</div>

							<div class="col-12">
								<label for="address" class="form-label">Endereço</label>
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
									<input type="text" class="form-control" id="address" name="address" placeholder="Rua/Bairro/Apto." value="{{ old('address', optional($user->client)->address) }}">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="mt-4 d-flex gap-2">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Cancelar</a>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection