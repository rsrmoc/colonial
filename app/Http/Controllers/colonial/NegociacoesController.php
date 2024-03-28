<?php

namespace App\Http\Controllers\brcondos_adv;

use App\Http\Controllers\Controller;
use App\Models\Negociacao;
use Exception;
use Illuminate\Http\Request;

class NegociacoesController extends Controller {
    public function createJson(Request $request) {
        $validated = $request->validate([
            'dt_negociacao' => 'required|date_format:Y-m-d',
            'nr_contato' => 'required|string',
            'email_cliente' => 'required|string|email',
            'valor' => 'required|numeric',
            'obs' => 'nullable|string',
            'cd_condominio' => 'required|integer|exists:condominios,cd_condominio',
            'cpf_cnpj_cliente' => 'required|string',
            'nm_cliente' => 'required|string'
        ]);

        try {
            $validated['id_usuario'] = $request->user()->id;
            $validated['valor'] = str_replace('.', '', $request->valor);
            $validated['valor'] = str_replace(',', '.', $validated['valor']);
            $validated['status'] = 'AGUARDANDO';

            $negociacao = Negociacao::create($validated);

            return response()->json([
                'message' => 'Negociação criada com sucesso!',
                'negociacao' => $negociacao
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateJson(Request $request) {
        $validated = $request->validate([
            'cd_negociacao' => 'required|integer|exists:negociacoes,cd_negociacao',
            'dt_negociacao' => 'required|date_format:Y-m-d',
            'nr_contato' => 'required|string',
            'email_cliente' => 'required|string|email',
            'valor' => 'required|numeric',
            'obs' => 'nullable|string'
        ]);

        try {
            $validated['valor'] = str_replace('.', '', $request->valor);
            $validated['valor'] = str_replace(',', '.', $validated['valor']);

            unset($validated['cd_negociacao']);

            $negociacao = Negociacao::find($request->cd_negociacao);
            $negociacao->update($validated);

            return response()->json([
                'message' => 'Negociação atualizado com sucesso!',
                'negociacao' => $negociacao
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteJson($cdNegociacao) {
        try {
            Negociacao::find($cdNegociacao)->delete();

            return response()->json(['message' => 'Negociação excluida com sucesso!']);
        }
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}