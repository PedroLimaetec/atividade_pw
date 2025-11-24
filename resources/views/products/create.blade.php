@extends('layouts.app')

@section('content')
<div style="max-width:820px;margin:0 auto">
    <!-- Título da página -->
    <h1 style="margin:0 0 12px;font-size:20px;color:#0f172a">Novo produto</h1>

    <!-- Descrição/ajuda para o usuário -->
    <p style="margin:0 0 18px;color:#6b7280">Preencha os dados para criar um novo produto.</p>

    <!-- Se houver erros de validação, exibe uma mensagem geral -->
    @if($errors->any())
    <div style="padding:12px;border-radius:10px;background:#fff5f5;color:#b91c1c;margin-bottom:14px">
        Corrija os erros no formulário.
    </div>
    @endif

    <!-- Inclui o partial do formulário.
         - product: null indica criação (não edição)
         - action: rota para salvar (products.store)
         - method: método HTTP usado no partial (POST) -->
    @include('products._form', [
    'product' => null,
    'action' => route('products.store'),
    'method' => 'POST'
    ])
</div>
@endsection