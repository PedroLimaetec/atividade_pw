<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Aplica middleware de autenticação em todas as ações do controller.
     * Garante que apenas usuários autenticados possam acessar o CRUD.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista de produtos (index).
     *
     * - Recupera os produtos ordenados por data de criação (mais novos primeiro).
     * - Pagina os resultados (10 por página).
     * - Retorna a view 'products.index' com a variável $products.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Exibe o formulário de criação de produto.
     *
     * - Retorna a view 'products.create'.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Armazena um novo produto.
     *
     * - Recebe um StoreProductRequest que já valida os dados.
     * - Cria o produto usando mass assignment (certifique-se de $fillable no model).
     * - Redireciona para a lista com mensagem de sucesso.
     */
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
    }

    /**
     * Exibe os detalhes de um produto.
     *
     * - Route model binding injeta a instância de Product.
     * - Retorna a view 'products.show' com a variável $product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Exibe o formulário de edição para um produto existente.
     *
     * - Route model binding injeta o $product.
     * - Retorna a view 'products.edit' com o produto.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Atualiza o produto.
     *
     * - Recebe um UpdateProductRequest que valida os dados.
     * - Atualiza o modelo com os dados validados.
     * - Redireciona para a lista com mensagem de sucesso.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove (deleta) o produto.
     *
     * - Executa $product->delete() e redireciona para a lista com mensagem.
     * - Considere usar soft deletes se quiser permitir restauração futura.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto removido.');
    }
}