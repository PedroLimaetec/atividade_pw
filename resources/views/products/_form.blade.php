@php
    // Determina se estamos em modo edição (ex.: $product existe)
    $isEdit = isset($product) && $product;
@endphp

<!-- Formulário parcial usado em create e edit -->
<form action="{{ $action }}" method="POST" style="display:block;background:transparent">
    @csrf
    <!-- Se o método for PUT/PATCH, inclui o _method para o HTML suportar -->
    @if(in_array($method, ['PUT','PATCH'])) @method($method) @endif

    <!-- Linha superior: nome (flex) + preço -->
    <div style="display:grid;grid-template-columns:1fr 220px;gap:12px;margin-bottom:12px">
        <div>
            <!-- Campo nome -->
            <label style="display:block;font-size:13px;color:#6b7280;margin-bottom:6px">Nome</label>
            <input
                type="text"
                name="name"
                required
                value="{{ old('name', $product->name ?? '') }}"
                style="width:100%;padding:10px;border-radius:10px;border:1px solid #e6e9ef;background:#fbfdff;font-size:15px;">
            <!-- Erro de validação para o campo name -->
            @error('name') <div style="color:#b91c1c;margin-top:6px;font-size:13px">{{ $message }}</div> @enderror
        </div>

        <div>
            <!-- Campo preço -->
            <label style="display:block;font-size:13px;color:#6b7280;margin-bottom:6px">Preço (R$)</label>
            <input
                type="number"
                step="0.01"
                name="price"
                required
                value="{{ old('price', isset($product) ? number_format($product->price,2,'.','') : '0.00') }}"
                style="width:100%;padding:10px;border-radius:10px;border:1px solid #e6e9ef;background:#fbfdff;font-size:15px;">
            <!-- Erro de validação para o campo price -->
            @error('price') <div style="color:#b91c1c;margin-top:6px;font-size:13px">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Campo quantidade -->
    <div style="margin-bottom:12px">
        <label style="display:block;font-size:13px;color:#6b7280;margin-bottom:6px">Quantidade</label>
        <input
            type="number"
            name="quantity"
            required
            value="{{ old('quantity', $product->quantity ?? 0) }}"
            style="width:160px;padding:10px;border-radius:10px;border:1px solid #e6e9ef;background:#fbfdff;font-size:15px;">
        <!-- Erro de validação para o campo quantity -->
        @error('quantity') <div style="color:#b91c1c;margin-top:6px;font-size:13px">{{ $message }}</div> @enderror
    </div>

    <!-- Campo descrição -->
    <div style="margin-bottom:14px">
        <label style="display:block;font-size:13px;color:#6b7280;margin-bottom:6px">Descrição</label>
        <textarea
            name="description"
            rows="5"
            style="width:100%;padding:10px;border-radius:10px;border:1px solid #e6e9ef;background:#fbfdff;font-size:15px">{{ old('description', $product->description ?? '') }}</textarea>
        <!-- Erro de validação para o campo description -->
        @error('description') <div style="color:#b91c1c;margin-top:6px;font-size:13px">{{ $message }}</div> @enderror
    </div>

    <!-- Botões de ação: salvar / cancelar -->
    <div style="display:flex;gap:10px;align-items:center">
        <!-- Texto do botão muda conforme modo (criar ou editar) -->
        <button type="submit" style="padding:10px 14px;border-radius:10px;border:0;background:linear-gradient(180deg,#10b981,#059669);color:#fff;font-weight:700;cursor:pointer">
            {{ $isEdit ? 'Salvar alterações' : 'Criar produto' }}
        </button>

        <!-- Link para voltar à lista sem submeter -->
        <a href="{{ route('products.index') }}" style="padding:10px 14px;border-radius:10px;background:transparent;border:1px solid #eef2f6;color:#475569;text-decoration:none;font-weight:600">
            Cancelar
        </a>
    </div>
</form>