@extends('layouts.app')

@section('content')
<div style="max-width:1100px;margin:28px auto;padding:20px;background:#fff;border-radius:12px;box-shadow:0 8px 30px rgba(15,23,42,0.06);">

    <!-- Cabeçalho da seção -->
    <header style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px">
        <div>
            <!-- Título da página -->
            <h2 style="margin:0;font-size:20px;color:#0f172a">Produtos</h2>
            <!-- Subtítulo/descrição -->
            <p style="margin:6px 0 0;color:#6b7280">Lista de produtos cadastrados</p>
        </div>

        <!-- campo de busca e link para criar novo produto -->
        <div style="display:flex;gap:10px;align-items:center">
            {{-- Form de busca usando query string 'q' --}}
            <form method="GET" action="{{ route('products.index') }}" style="display:flex;gap:8px;align-items:center">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Pesquisar nome..." style="padding:8px 10px;border-radius:10px;border:1px solid #e6e9ef;background:#fbfdff;outline:none">
                <button type="submit" style="padding:8px 12px;border-radius:10px;border:0;background:#2563eb;color:#fff;font-weight:600;cursor:pointer">Buscar</button>
            </form>

            <!-- Link para criar novo produto -->
            <a href="{{ route('products.create') }}" style="display:inline-block;padding:10px 14px;border-radius:10px;background:linear-gradient(180deg,#10b981,#059669);color:#fff;text-decoration:none;font-weight:600">Novo produto</a>
        </div>
    </header>

    <!-- Mensagem flash de sucesso -->
    @if(session('success'))
    <div style="padding:12px;border-radius:10px;background:#ecfdf5;color:#065f46;margin-bottom:14px">{{ session('success') }}</div>
    @endif

    <!-- Tabela responsiva container com overflow para dispositivos menores -->
    <div style="overflow-x:auto">
        <table style="width:100%;border-collapse:collapse;font-family:Inter,system-ui,Arial">
            <thead>
                <!-- Cabeçalho da tabela com colunas principais -->
                <tr style="text-align:left;color:#475569;border-bottom:1px solid #eef2f6">
                    <th style="padding:12px 10px">Nome</th>
                    <th style="padding:12px 10px;width:120px">Preço</th>
                    <th style="padding:12px 10px;width:100px">Quantidade</th>
                    <th style="padding:12px 10px;width:220px">Criado</th>
                    <th style="padding:12px 10px;width:200px">Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop pelos produtos; caso nenhum produto, exibe linha vazia -->
                @forelse($products as $product)
                <tr style="border-bottom:1px solid #f3f6f9">
                    <!-- Coluna Nome + descrição reduzida -->
                    <td style="padding:12px 10px;vertical-align:middle">
                        <strong style="color:#0f172a">{{ $product->name }}</strong>
                        <!-- Exibe uma descrição curta — usa Str::limit para truncar -->
                        <div style="color:#6b7280;font-size:13px;margin-top:6px">{{ \Illuminate\Support\Str::limit($product->description ?? '-', 70) }}</div>
                    </td>

                    <!-- Preço formatado com casas decimais brasileiras -->
                    <td style="padding:12px 10px;vertical-align:middle">R$ {{ number_format($product->price, 2, ',', '.') }}</td>

                    <!-- Quantidade em estoque -->
                    <td style="padding:12px 10px;vertical-align:middle">{{ $product->quantity }}</td>

                    <!-- Data de criação formatada -->
                    <td style="padding:12px 10px;vertical-align:middle;font-size:13px;color:#94a3b8">
                        {{ $product->created_at->format('d/m/Y H:i') }}
                    </td>

                    <!-- ver, editar e excluir -->
                    <td style="padding:12px 10px;vertical-align:middle">
                        {{-- Link para ver detalhes --}}
                        <a href="{{ route('products.show', $product) }}" style="margin-right:8px;text-decoration:none;color:#2563eb;font-weight:600">Ver</a>

                        <!-- Link para editar produto -->
                        <a href="{{ route('products.edit', $product) }}" style="margin-right:8px;text-decoration:none;color:#f59e0b;font-weight:600">Editar</a>

                        <!-- Formulário para exclusão utiliza método DELETE e token CSRF -->
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline" onsubmit="return confirm('Confirma exclusão do produto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#fee2e2;color:#b91c1c;border:0;padding:6px 10px;border-radius:8px;cursor:pointer;font-weight:600">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <!-- Caso não haja produtos -->
                <tr>
                    <td colspan="5" style="padding:18px;text-align:center;color:#6b7280">Nenhum produto cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- informação de paginação e links -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:16px">
        <!-- Texto mostrando intervalo atual e total de itens -->
        <div style="color:#6b7280;font-size:14px">
            Exibindo {{ $products->firstItem() ? $products->firstItem().' - '.$products->lastItem() : '0' }} de {{ $products->total() }}
        </div>

        <!-- Links de paginação, mantém query string para busca -->
        <div>
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection