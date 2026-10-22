<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merda;

class MerdaController extends Controller
{
    public function index()
    {
        $pendentes = Merda::where('user_id', '!=', auth()->id())
            ->whereDoesntHave('votos', function($query) {
                $query->where('user_id', auth()->id());
            })->count();

        return view('dashboard', compact('pendentes'));
    }

    public function create()
    {
        return view('registrar');
    }

    public function feed()
    {
        $merdas = Merda::with(['user', 'votos', 'comentarios.user'])->latest()->paginate(10);
        return view('feed', compact('merdas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'nivel_estresse' => 'required|integer|min:1|max:10',
        ]);

        $request->user()->merdas()->create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'nivel_estresse' => $request->nivel_estresse,
        ]);

        return redirect()->route('dashboard');
    }

    public function votar(Request $request, Merda $merda)
    {
        if ($merda->user_id === $request->user()->id) {
            return back(); 
        }

        $request->validate(['pontos' => 'required|integer|in:10,20,50,100,200,300']);

        $votoExistente = $merda->votos()->where('user_id', $request->user()->id)->first();

        if ($votoExistente) {
            if ($votoExistente->pontos == $request->pontos) {
                return back();
            }
            
            if ($votoExistente->mudou_voto) {
                return back()->with('erro', 'Tu já gastou tua única chance de mudar o voto nessa desgraça!');
            }

            $votoExistente->update([
                'pontos' => $request->pontos,
                'mudou_voto' => true
            ]);
        } else {
            $merda->votos()->create([
                'user_id' => $request->user()->id,
                'pontos' => $request->pontos,
                'mudou_voto' => false
            ]);
        }

        return back();
    }

    public function ranking()
    {
        $rankingGeral = \App\Models\User::withSum('votosRecebidos', 'pontos')
            ->orderByDesc('votos_recebidos_sum_pontos')
            ->get();

        $rankingMes = \App\Models\User::withSum(['votosRecebidos' => function ($query) {
            $query->whereMonth('votos.created_at', now()->month)
                  ->whereYear('votos.created_at', now()->year);
        }], 'pontos')
        ->orderByDesc('votos_recebidos_sum_pontos')
        ->get();

        return view('ranking', compact('rankingGeral', 'rankingMes'));
    }

    public function historico()
    {
        $minhasMerdas = Merda::with('votos')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('historico', compact('minhasMerdas'));
    }

    public function comentar(Request $request, Merda $merda)
    {
        $request->validate([
            'texto' => 'required|string|max:500' 
        ]);

        $merda->comentarios()->create([
            'user_id' => auth()->id(),
            'texto' => $request->texto
        ]);

        return back();
    }
}