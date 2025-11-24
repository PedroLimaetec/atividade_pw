@extends('layouts.app')

@section('content')
<!-- Título do produto -->
<h1>{{ $product->name }}</h1>

<!-- Descrição completa do produto -->
<p>{{ $product->description }}</p>

<!-- Preço formatado no padrão -->
<p>Preço: R$ {{ number_format($product->price, 2, ',', '.') }}</p>

<!-- Quantidade em estoque -->
<p>Quantidade: {{ $product->quantity }}</p>

<!-- link para editar e voltar para a lista -->
<a href="{{ route('products.edit', $product) }}">Editar</a>
<a href="{{ route('products.index') }}">Voltar</a>
@endsection