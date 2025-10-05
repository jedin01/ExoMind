<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\TreinamentoPreProcessamento;
use App\Models\Treinamento;
use App\Models\PreProcessamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Treinamento de Pre de Processamentos resources in the admin panel.
 */
class TreinamentoPreProcessamentoController extends Controller
{
    /**
     * Display a listing of Treinamento de Pre de Processamentos resources.
     *
     * Retrieves all Treinamento de Pre de Processamentos records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = TreinamentoPreProcessamento::all();
        
        $resources['treinamentos'] = Treinamento::all();
        $resources['pre_processamentoss'] = PreProcessamentos::all();
        return view('admin.treinamento_pre_processamento.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Treinamento de Pre de Processamentos.
     *
     * Fetches related entities required to populate form fields for creating a new Treinamento de Pre de Processamentos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'treinamentos' => Treinamento::all(),
                'pre_processamentoss' => PreProcessamentos::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Treinamento de Pre de Processamentos', $th, true);
        }
    }

    /**
     * Store a newly created Treinamento de Pre de Processamentos in the database.
     *
     * Validates the request data and creates a new Treinamento de Pre de Processamentos record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'it_id_treinamento' => 'required|exists:treinamentos,id',
            'it_id_pre_processamento' => 'required|exists:pre_processamentoss,id',
        ], [
            'it_id_treinamento.required' => 'O treinamento é um campo obrigatório',
            'it_id_treinamento.exists' => 'O treinamento selecionado não é válido',
            'it_id_pre_processamento.required' => 'O pre_processamentos é um campo obrigatório',
            'it_id_pre_processamento.exists' => 'O pre_processamentos selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'it_id_treinamento' => $request['it_id_treinamento'],
                'it_id_pre_processamento' => $request['it_id_pre_processamento'],
            ];

            TreinamentoPreProcessamento::create($data);

            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Treinamento de Pre de Processamentos cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Treinamento de Pre de Processamentos', $th);
        }
    }

    /**
    * Display the specified Treinamento de Pre de Processamentos.
    *
    * Retrieves a specific Treinamento de Pre de Processamentos by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Treinamento de Pre de Processamentos
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = TreinamentoPreProcessamento::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Treinamento de Pre de Processamentos não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['treinamento_pre_processamento_detail'] = $items->first();
            $resource['treinamentos'] = Treinamento::all();
            $resource['pre_processamentoss'] = PreProcessamentos::all();
            
            $resource['treinamento_pre_processamentos'] = $items;
            return view('admin.treinamento_pre_processamento.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Treinamento de Pre de Processamentos não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Treinamento de Pre de Processamentos.
     *
     * Fetches the specified Treinamento de Pre de Processamentos and related entities for editing.
     *
     * @param string $id The ID of the Treinamento de Pre de Processamentos
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = TreinamentoPreProcessamento::findOrFail($id);
            return response()->json([
                'item' => $item,
                'treinamentos' => Treinamento::all(),
                'pre_processamentoss' => PreProcessamentos::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Treinamento de Pre de Processamentos', $th, true);
        }
    }

    /**
     * Update the specified Treinamento de Pre de Processamentos in the database.
     *
     * Validates the request data and updates the specified Treinamento de Pre de Processamentos record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Treinamento de Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'it_id_treinamento' => 'required|exists:treinamentos,id',
            'it_id_pre_processamento' => 'required|exists:pre_processamentoss,id',
        ], [
            'it_id_treinamento.required' => 'O treinamento é um campo obrigatório',
            'it_id_treinamento.exists' => 'O treinamento selecionado não é válido',
            'it_id_pre_processamento.required' => 'O pre_processamentos é um campo obrigatório',
            'it_id_pre_processamento.exists' => 'O pre_processamentos selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'it_id_treinamento' => $request['it_id_treinamento'],
                'it_id_pre_processamento' => $request['it_id_pre_processamento'],
            ];


            TreinamentoPreProcessamento::findOrFail($id)->update($data);

            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Treinamento de Pre de Processamentos atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Treinamento de Pre de Processamentos', $th);
        }
    }

    /**
     * Soft delete the specified Treinamento de Pre de Processamentos.
     *
     * Marks the specified Treinamento de Pre de Processamentos as deleted without removing it from the database.
     *
     * @param string $id The ID of the Treinamento de Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            TreinamentoPreProcessamento::findOrFail($id)->delete();
            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Treinamento de Pre de Processamentos eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Treinamento de Pre de Processamentos de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Treinamento de Pre de Processamentos.
     *
     * Removes the specified Treinamento de Pre de Processamentos from the database permanently.
     *
     * @param string $id The ID of the Treinamento de Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            TreinamentoPreProcessamento::findOrFail($id)->forceDelete();
            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Treinamento de Pre de Processamentos eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Treinamento de Pre de Processamentos de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Treinamento de Pre de Processamentos.
     *
     * Restores a previously soft-deleted Treinamento de Pre de Processamentos by ID.
     *
     * @param string $id The ID of the Treinamento de Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = TreinamentoPreProcessamento::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Treinamento de Pre de Processamentos restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Treinamento de Pre de Processamentos', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Treinamento de Pre de Processamentos resources.
     *
     * Retrieves all soft-deleted Treinamento de Pre de Processamentos records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = TreinamentoPreProcessamento::onlyTrashed()->get();
            
            return view('admin.treinamento_pre_processamento.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Treinamento de Pre de Processamentos eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Treinamento de Pre de Processamentos resources.
     *
     * Restores all soft-deleted Treinamento de Pre de Processamentos records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            TreinamentoPreProcessamento::onlyTrashed()->restore();
            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Todos os Treinamento de Pre de Processamentos eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Treinamento de Pre de Processamentos eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Treinamento de Pre de Processamentos resources.
     *
     * Permanently removes all soft-deleted Treinamento de Pre de Processamentos records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            TreinamentoPreProcessamento::onlyTrashed()->forceDelete();
            return redirect()->route('admin.treinamento_pre_processamento.index')->with('success', 'Todos os Treinamento de Pre de Processamentos eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Treinamento de Pre de Processamentos', $th);
        }
    }

    /**
     * Format error response for web or JSON.
     *
     * Returns a standardized error response for the admin panel.
     *
     * @param string $message The error message to display
     * @param \Throwable $th The exception thrown
     * @param bool $isJson Whether to return a JSON response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    private function errorResponse(string $message, \Throwable $th, bool $isJson = false)
    {
        $error = [
            'toast_type' => 'error',
            'toast_message' => $message,
            'toast_text' => 'Código de erro: ' . $th->getMessage(),
        ];

        if ($isJson) {
            return response()->json($error, 500);
        }

        return redirect()->back()->with($error);
    }
}