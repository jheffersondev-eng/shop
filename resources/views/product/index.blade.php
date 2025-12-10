@extends('components.app.app')
@section('title', 'Usuários')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Produtos</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <input id="table-search" type="search" class="form-control form-control-sm" placeholder="Pesquisar..."
                            style="min-width:200px;">
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Novo</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Valor</th>

                                <th scope="col" class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                            @forelse($products ?? [] as $product)
                                <tr class="user-row">
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Sem imagem</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->quantity }} {{ $product->unit->abbreviation ?? '' }}</td>
                                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                    <td class="text-end">                         
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    
    @endsection
@endsection