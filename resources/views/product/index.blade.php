@php
    use App\Helpers\ButtonHelper;
    use App\Helpers\NumberHelper;
    use App\Helpers\ButtonInformationHelper;
    use App\Helpers\ModalHelper;
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
                            ->setSize('md')
                            ->setClass('btn btn-success')
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
                                <th >#</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Criado em</th>
                                <th scope="col" class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                            @forelse($products ?? [] as $product)
                                <tr class="user-row">
                                    <th width="3%" scope="row">{{ $product->id }}</th>
                                    <td width="5%">
                                        @if(count($product->images) > 0)
                                            <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                                alt="{{ $product->name }}" class="img-thumbnail" 
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Sem imagem</span>
                                        @endif
                                    </td>
                                    <td>{{ ucfirst(strtolower($product->name)) }}</td>
                                    <td width="20%">{{ ucfirst(strtolower($product->category->name)) }}</td>
                                    <td width="10%">
                                        {{ NumberHelper::simple($product->stockQuantity) }} 
                                        {{ $product->unit->abbreviation }}
                                    </td>
                                    <td width="10%">{{ NumberHelper::currency($product->price) }}</td>
                                    <td>{{ $product->createdAt->format('d/m/Y') }}</td>
                                    <td width="10%" class="text-end">    
                                        {!! 
                                            ButtonInformationHelper::make()
                                                ->setCreatedBy(ucwords(strtolower($product->userCreatedName)))
                                                ->setCreatedAt($product->createdAt)
                                                ->setUpdatedBy(ucwords(strtolower($product->userUpdatedName)))
                                                ->setUpdatedAt($product->updatedAt)
                                                ->render() 
                                        !!}
                                        {!! 
                                            ModalHelper::make()
                                                ->setSize('lg')
                                                ->setTitle('#'. $product->id . ' Produto ' . ucfirst(strtolower($product->name)))
                                                ->setIcon('bi bi-eye')
                                                ->setButtonClass('btn btn-outline-warning btn-sm')
                                                ->setBody('product.product-modal')
                                                ->setData(['product' => $product])
                                                ->render()
                                        !!} 
                                        {!!
                                            ButtonHelper::make('')
                                                ->setLink(route('product.edit', $product->id))
                                                ->setSize('sm')
                                                ->setClass('btn btn-outline-primary')
                                                ->setIcon('bi bi-pencil')
                                                ->render('link') 
                                        !!}
                                        {!!
                                            ButtonHelper::make('')
                                                ->setType('button')
                                                ->setSize('sm')
                                                ->setClass('btn btn-outline-danger btn-confirm')
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
                                    <td colspan="10" class="text-center text-muted">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection