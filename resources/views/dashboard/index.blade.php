@extends('components.app.app')
@section('title', 'Dashboard')
@section('content')
    <div class="dashboard-cards">
        <div class="card-stat">
            <div class="stat-title">Novos usuários (30 dias)</div>
            <div class="stat-value">1.434.023</div>
            <div class="stat-change">+2.3%</div>
        </div>
        <div class="card-stat">
            <div class="stat-title">Receita (30 dias)</div>
            <div class="stat-value">R$ 231,4M</div>
            <div class="stat-change">+6.3%</div>
        </div>
        <div class="card-stat">
            <div class="stat-title">Produtos</div>
            <div class="stat-value">2.340</div>
            <div class="stat-change">+1.1%</div>
        </div>
        <div class="card-stat">
            <div class="stat-title">Vendas (30 dias)</div>
            <div class="stat-value">12.430</div>
            <div class="stat-change">+3.8%</div>
        </div>
    </div>
    <div class="dashboard-graphs">
        <div class="graph-card">
            <div class="stat-title mb-2">Usuários por fonte</div>
            <img src="https://dummyimage.com/320x120/00aaff/fff.png&text=Gráfico+Pizza" alt="Gráfico Pizza"
                class="img-fluid rounded">
        </div>
        <div class="graph-card">
            <div class="stat-title mb-2">Participação por região</div>
            <img src="https://dummyimage.com/320x120/1a2332/fff.png&text=Gráfico+Área" alt="Gráfico Área"
                class="img-fluid rounded">
        </div>
        <div class="graph-card">
            <div class="stat-title mb-2">Performance</div>
            <img src="https://dummyimage.com/320x120/00aaff/fff.png&text=Gráfico+Linha" alt="Gráfico Linha"
                class="img-fluid rounded">
        </div>
        <div class="graph-card">
            <div class="stat-title mb-2">Produtos por fonte</div>
            <img src="https://dummyimage.com/320x120/1a2332/fff.png&text=Gráfico+Dispersão" alt="Gráfico Dispersão"
                class="img-fluid rounded">
        </div>
    </div>
@endsection
