@extends('layouts.app')

@section('content')
<!-- Título da página de edição -->
<h1>Editar produto</h1>

<!-- Inclui o formulário parcial _form.blade.php
     Passa a variável $product, a rota de ação e o método PUT-->
@include('products._form', [
'product' => $product,
'action' => route('products.update', $product),
'method' => 'PUT'
])
@endsection