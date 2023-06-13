<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BattleController extends Controller
{
    public function show($poke1, $poke2)
    {
        
        $poke1Dados = Http::withOptions(['verify' => false])->get('https://pokeapi.co/api/v2/pokemon/' . $poke1);
        $poke2Dados = Http::withOptions(['verify' => false])->get('https://pokeapi.co/api/v2/pokemon/' . $poke2);
    
        //$poke1Nome = $poke1['name'];
        //$poke2Nome = $poke2['name'];

        //dd($poke1Nome, $poke2Nome);

        $poke1BaseStat = $poke1Dados->json()['stats'][0]['base_stat'] ?? 0;
        $poke2BaseStat = $poke2Dados->json()['stats'][0]['base_stat'] ?? 0;
    
        $winner = ($poke1BaseStat > $poke2BaseStat) ? $poke1 : $poke2;
    
        return response()->json(['winner' => ($winner)]);
    }
    
}
