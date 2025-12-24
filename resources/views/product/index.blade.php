@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\NumberHelper;
@endphp
@extends('components.app.app')
@section('title', 'Produtos')
@section('content')
    <div class="container-fluid px-4">
        @include('components.message')
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Produtos</h5>
                    <div class="d-flex gap-2 align-items-center">
                        {!! ButtonHelper::make('Novo Produto')
                            ->setLink(route('product.create'))
                            ->setSize(30)
                            ->setClass('btn btn-sm btn-success')
                            ->setIcon('bi bi-plus-lg')
                            ->render('link')
                        !!}
                    </div>
                </div>
                <!-- Filtros -->
                @include('product.filter')
                <!-- End Filtros -->
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
                                    <td>{{ ucfirst(strtolower($product->name)) }}</td>
                                    <td>{{ ucfirst(strtolower($product->description)) }}</td>
                                    <td>{{ ucfirst(strtolower($product->category->name)) }}</td>
                                    <td>
                                        {{ NumberHelper::simple($product->stockQuantity) }} 
                                        {{ $product->unit->abbreviation }}
                                    </td>
                                    <td>{{ NumberHelper::currency($product->price) }}</td>
                                    <td class="text-end">    
                                        {!!
                                            ButtonHelper::make('')
                                                ->setLink(route('product.edit', $product->id))
                                                ->setSize(30)
                                                ->setClass('btn btn-sm btn-outline-primary')
                                                ->setIcon('bi bi-pencil')
                                                ->render('link') 
                                        !!}
                                        {!!
                                            ButtonHelper::make('')
                                                ->setType('button')
                                                ->setSize(23)
                                                ->setClass('btn btn-sm btn-outline-danger btn-confirm')
                                                ->setTitle('Excluir')
                                                ->setDataMethod('DELETE')
                                                ->setDataAction(route('product.destroy', $product->id))
                                                ->setDataTitle('Excluir produto')
                                                ->setDataMessage('Deseja realmente excluir este produto?')
                                                ->setIcon('bi bi-trash')
                                                ->render('button')
                                        !!}
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
@endsection