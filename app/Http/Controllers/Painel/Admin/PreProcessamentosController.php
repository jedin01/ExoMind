<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreProcessamentos;
use App\Models\TreinamentoPreProcessamento;
use App\Models\Treinamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Pre de Processamentos resources in the admin panel.
 */
class PreProcessamentosController extends Controller
{
    /**
     * Display a listing of Pre de Processamentos resources.
     *
     * Retrieves all Pre de Processamentos records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = PreProcessamentos::all();
        
        return view('admin.pre_processamento.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Pre de Processamentos.
     *
     * Fetches related entities required to populate form fields for creating a new Pre de Processamentos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Pre de Processamentos', $th, true);
        }
    }

    /**
     * Store a newly created Pre de Processamentos in the database.
     *
     * Validates the request data and creates a new Pre de Processamentos record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
            ];

            PreProcessamentos::create($data);

            return redirect()->route('admin.pre_processamento.index')->with('success', 'Pre de Processamentos cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Pre de Processamentos', $th);
        }
    }

    /**
    * Display the specified Pre de Processamentos.
    *
    * Retrieves a specific Pre de Processamentos by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Pre de Processamentos
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = PreProcessamentos::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Pre de Processamentos não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['pre_processamentos_detail'] = $items->first();
            
            $resource['pre_processamentoss'] = $items;
            // Para a entidade TreinamentoPreProcessamento (hasMany)
            $resource['treinamentos'] = Treinamento::all();
            return view('admin.pre_processamento.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Pre de Processamentos não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Pre de Processamentos.
     *
     * Fetches the specified Pre de Processamentos and related entities for editing.
     *
     * @param string $id The ID of the Pre de Processamentos
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = PreProcessamentos::findOrFail($id);
            return response()->json([
                'item' => $item,
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Pre de Processamentos', $th, true);
        }
    }

    /**
     * Update the specified Pre de Processamentos in the database.
     *
     * Validates the request data and updates the specified Pre de Processamentos record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
            ];


            PreProcessamentos::findOrFail($id)->update($data);

            return redirect()->route('admin.pre_processamento.index')->with('success', 'Pre de Processamentos atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Pre de Processamentos', $th);
        }
    }

    /**
     * Soft delete the specified Pre de Processamentos.
     *
     * Marks the specified Pre de Processamentos as deleted without removing it from the database.
     *
     * @param string $id The ID of the Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            PreProcessamentos::findOrFail($id)->delete();
            return redirect()->route('admin.pre_processamento.index')->with('success', 'Pre de Processamentos eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Pre de Processamentos de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Pre de Processamentos.
     *
     * Removes the specified Pre de Processamentos from the database permanently.
     *
     * @param string $id The ID of the Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            PreProcessamentos::findOrFail($id)->forceDelete();
            return redirect()->route('admin.pre_processamento.index')->with('success', 'Pre de Processamentos eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Pre de Processamentos de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Pre de Processamentos.
     *
     * Restores a previously soft-deleted Pre de Processamentos by ID.
     *
     * @param string $id The ID of the Pre de Processamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = PreProcessamentos::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.pre_processamento.index')->with('success', 'Pre de Processamentos restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Pre de Processamentos', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Pre de Processamentos resources.
     *
     * Retrieves all soft-deleted Pre de Processamentos records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = PreProcessamentos::onlyTrashed()->get();
            
            return view('admin.pre_processamento.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Pre de Processamentos eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Pre de Processamentos resources.
     *
     * Restores all soft-deleted Pre de Processamentos records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            PreProcessamentos::onlyTrashed()->restore();
            return redirect()->route('admin.pre_processamento.index')->with('success', 'Todos os Pre de Processamentos eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Pre de Processamentos eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Pre de Processamentos resources.
     *
     * Permanently removes all soft-deleted Pre de Processamentos records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            PreProcessamentos::onlyTrashed()->forceDelete();
            return redirect()->route('admin.pre_processamento.index')->with('success', 'Todos os Pre de Processamentos eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Pre de Processamentos', $th);
        }
    }
    /**
    * Display the TreinamentoPreProcessamento by Pre de Processamentos ID.
    *
    *
    * @param string $id The ID of the Pre de Processamentos
    * @return \Illuminate\View\View
    */
    public function treinamento_pre_processamentos(string $id)
    {
        try {
            $items = TreinamentoPreProcessamento::where('it_id_pre_processamentos', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('TreinamentoPreProcessamentos não encontrado(a)');
            }

            $resource['pre_processamentoss'] = PreProcessamentos::where('id', $id)->get();
            
            
            $resource['treinamento_pre_processamentos'] = $items;
            $resource['treinamentos'] = Treinamento::all();
            return view('admin.TreinamentoPreProcessamento.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('TreinamentoPreProcessamento não encontrado(a)', $th);
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