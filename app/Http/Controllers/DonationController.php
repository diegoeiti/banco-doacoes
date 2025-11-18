<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\Recebimento;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function publicIndex()
    {
        $donations = Donation::where('status', 'disponivel')->get();
        return view('donations.public', compact('donations'));
    }

    public function index()
    {
        $donations = Donation::where('user_id', Auth::id())->get();
        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        Donation::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'status' => 'disponivel',
            'user_id' => Auth::id() // ← AGORA USA O USUÁRIO LOGADO!
        ]);

        return redirect()->route('donations.index')
            ->with('success', 'Doação cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doacao = Donation::find($id);
        $recebimentos = $doacao->recebimentos; // Todos os recebimentos desta doação

        return view('donations.show', compact('doacao', 'recebimentos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation = Donation::findOrFail($id);
        return view('donations.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donation = Donation::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $donation->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('donations.index')
            ->with('success', 'Doação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donation = Donation::findOrFail($id);

        // Só permite excluir se estiver esgotada
        if ($donation->status !== 'entregue') {
            return redirect()->back()
                ->with('error', 'Só é possível excluir doações esgotadas.');
        }

        $donation->delete();

        return redirect()->route('donations.index')
            ->with('success', 'Doação excluída com sucesso!');
    }

    public function receber(Request $request, $id)
    {
        $doacao = Donation::findOrFail($id);

        // IMPEDIR que o dono receba seus próprios itens
        if ($doacao->user_id == Auth::id()) {
            return redirect()->back()
                ->with('error', 'Você não pode receber seus próprios itens!');
        }

        $request->validate([
            'quantidade' => "required|integer|min:1|max:{$doacao->quantity}"
        ]);

        Recebimento::create([
            'donation_id' => $doacao->id,
            'user_id' => Auth::id(), // ← QUEM RECEBEU É O USUÁRIO LOGADO!
            'quantidade_recebida' => $request->quantidade
        ]);

        $doacao->update([
            'quantity' => $doacao->quantity - $request->quantidade
        ]);

        if ($doacao->quantity == 0) {
            $doacao->update(['status' => 'entregue']);
        }

        return redirect()->route('donations.public')
            ->with('success', 'Itens recebidos com sucesso!');
    }
}
