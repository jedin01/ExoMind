<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\TreinamentoMetrica;
use App\Models\Metricas;
use App\Models\Treinamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Treinamento de Metricas resources in the admin panel.
 */
class TreinamentoMetricaController extends Controller
{
    /**
     * Display a listing of Treinamento de Metricas resources.
     *
     * Retrieves all Treinamento de Metricas records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = TreinamentoMetrica::all();
        
        $resources['metricass'] = Metricas::all();
        $resources['treinamentos'] = Treinamento::all();
        return view('admin.treinamento_metrica.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Treinamento de Metricas.
     *
     * Fetches related entities required to populate form fields for creating a new Treinamento de Metricas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'metricass' => Metricas::all(),
                'treinamentos' => Treinamento::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Treinamento de Metricas', $th, true);
        }
    }

    /**
     * Store a newly created Treinamento de Metricas in the database.
     *
     * Validates the request data and creates a new Treinamento de Metricas record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'it_id_metrica' => 'required|exists:metricass,id',
            'it_id_treinamento' => 'required|exists:treinamentos,id',
        ], [
            'it_id_metrica.required' => 'O metricas é um campo obrigatório',
            'it_id_metrica.exists' => 'O metricas selecionado não é válido',
            'it_id_treinamento.required' => 'O treinamento é um campo obrigatório',
            'it_id_treinamento.exists' => 'O treinamento selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'it_id_metrica' => $request['it_id_metrica'],
                'it_id_treinamento' => $request['it_id_treinamento'],
            ];

            TreinamentoMetrica::create($data);

            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Treinamento de Metricas cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Treinamento de Metricas', $th);
        }
    }

    /**
    * Display the specified Treinamento de Metricas.
    *
    * Retrieves a specific Treinamento de Metricas by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Treinamento de Metricas
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = TreinamentoMetrica::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Treinamento de Metricas não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['treinamento_metrica_detail'] = $items->first();
            $resource['metricass'] = Metricas::all();
            $resource['treinamentos'] = Treinamento::all();
            
            $resource['treinamento_metricas'] = $items;
            return view('admin.treinamento_metrica.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Treinamento de Metricas não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Treinamento de Metricas.
     *
     * Fetches the specified Treinamento de Metricas and related entities for editing.
     *
     * @param string $id The ID of the Treinamento de Metricas
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = TreinamentoMetrica::findOrFail($id);
            return response()->json([
                'item' => $item,
                'metricass' => Metricas::all(),
                'treinamentos' => Treinamento::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Treinamento de Metricas', $th, true);
        }
    }

    /**
     * Update the specified Treinamento de Metricas in the database.
     *
     * Validates the request data and updates the specified Treinamento de Metricas record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Treinamento de Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'it_id_metrica' => 'required|exists:metricass,id',
            'it_id_treinamento' => 'required|exists:treinamentos,id',
        ], [
            'it_id_metrica.required' => 'O metricas é um campo obrigatório',
            'it_id_metrica.exists' => 'O metricas selecionado não é válido',
            'it_id_treinamento.required' => 'O treinamento é um campo obrigatório',
            'it_id_treinamento.exists' => 'O treinamento selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'it_id_metrica' => $request['it_id_metrica'],
                'it_id_treinamento' => $request['it_id_treinamento'],
            ];


            TreinamentoMetrica::findOrFail($id)->update($data);

            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Treinamento de Metricas atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Treinamento de Metricas', $th);
        }
    }

    /**
     * Soft delete the specified Treinamento de Metricas.
     *
     * Marks the specified Treinamento de Metricas as deleted without removing it from the database.
     *
     * @param string $id The ID of the Treinamento de Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            TreinamentoMetrica::findOrFail($id)->delete();
            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Treinamento de Metricas eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Treinamento de Metricas de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Treinamento de Metricas.
     *
     * Removes the specified Treinamento de Metricas from the database permanently.
     *
     * @param string $id The ID of the Treinamento de Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            TreinamentoMetrica::findOrFail($id)->forceDelete();
            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Treinamento de Metricas eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Treinamento de Metricas de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Treinamento de Metricas.
     *
     * Restores a previously soft-deleted Treinamento de Metricas by ID.
     *
     * @param string $id The ID of the Treinamento de Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = TreinamentoMetrica::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Treinamento de Metricas restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Treinamento de Metricas', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Treinamento de Metricas resources.
     *
     * Retrieves all soft-deleted Treinamento de Metricas records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = TreinamentoMetrica::onlyTrashed()->get();
            
            return view('admin.treinamento_metrica.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Treinamento de Metricas eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Treinamento de Metricas resources.
     *
     * Restores all soft-deleted Treinamento de Metricas records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            TreinamentoMetrica::onlyTrashed()->restore();
            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Todos os Treinamento de Metricas eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Treinamento de Metricas eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Treinamento de Metricas resources.
     *
     * Permanently removes all soft-deleted Treinamento de Metricas records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            TreinamentoMetrica::onlyTrashed()->forceDelete();
            return redirect()->route('admin.treinamento_metrica.index')->with('success', 'Todos os Treinamento de Metricas eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Treinamento de Metricas', $th);
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