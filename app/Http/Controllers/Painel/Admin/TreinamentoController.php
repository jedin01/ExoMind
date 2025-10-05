<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treinamento;
use App\Models\TreinamentoPreProcessamento;
use App\Models\TreinamentoMetrica;
use App\Models\Modelo;
use App\Models\PreProcessamentos;
use App\Models\Metricas;
use App\Models\Dataset;
use App\Models\CategoriaModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Treinamentos resources in the admin panel.
 */
class TreinamentoController extends Controller
{
    /**
     * Display a listing of Treinamentos resources.
     *
     * Retrieves all Treinamentos records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Treinamento::all();
        
        return view('admin.treinamento.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Treinamentos.
     *
     * Fetches related entities required to populate form fields for creating a new Treinamentos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Treinamentos', $th, true);
        }
    }

    /**
     * Store a newly created Treinamentos in the database.
     *
     * Validates the request data and creates a new Treinamentos record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'dt_data' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'dt_data.required' => 'A data é obrigatória',
            'hora_inicio.required' => 'A hora de início é obrigatória',
            'hora_termino.required' => 'A hora de término é obrigatória',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'dt_data' => $request['dt_data'],
                'hora_inicio' => $request['hora_inicio'],
                'hora_termino' => $request['hora_termino'],
            ];

            Treinamento::create($data);

            return redirect()->route('admin.treinamento.index')->with('success', 'Treinamentos cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Treinamentos', $th);
        }
    }

    /**
    * Display the specified Treinamentos.
    *
    * Retrieves a specific Treinamentos by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Treinamentos
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Treinamento::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Treinamentos não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['treinamento_detail'] = $items->first();
            
            $resource['treinamentos'] = $items;
            // Para a entidade TreinamentoPreProcessamento (hasMany)
            $resource['pre_processamentoss'] = PreProcessamentos::all();
            // Para a entidade TreinamentoMetrica (hasMany)
            $resource['metricass'] = Metricas::all();
            // Para a entidade Modelo (hasMany)
            $resource['datasets'] = Dataset::all();
            $resource['categoria_modelos'] = CategoriaModelo::all();
            return view('admin.treinamento.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Treinamentos não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Treinamentos.
     *
     * Fetches the specified Treinamentos and related entities for editing.
     *
     * @param string $id The ID of the Treinamentos
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Treinamento::findOrFail($id);
            return response()->json([
                'item' => $item,
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Treinamentos', $th, true);
        }
    }

    /**
     * Update the specified Treinamentos in the database.
     *
     * Validates the request data and updates the specified Treinamentos record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Treinamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'dt_data' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'dt_data.required' => 'A data é obrigatória',
            'hora_inicio.required' => 'A hora de início é obrigatória',
            'hora_termino.required' => 'A hora de término é obrigatória',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'dt_data' => $request['dt_data'],
                'hora_inicio' => $request['hora_inicio'],
                'hora_termino' => $request['hora_termino'],
            ];


            Treinamento::findOrFail($id)->update($data);

            return redirect()->route('admin.treinamento.index')->with('success', 'Treinamentos atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Treinamentos', $th);
        }
    }

    /**
     * Soft delete the specified Treinamentos.
     *
     * Marks the specified Treinamentos as deleted without removing it from the database.
     *
     * @param string $id The ID of the Treinamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Treinamento::findOrFail($id)->delete();
            return redirect()->route('admin.treinamento.index')->with('success', 'Treinamentos eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Treinamentos de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Treinamentos.
     *
     * Removes the specified Treinamentos from the database permanently.
     *
     * @param string $id The ID of the Treinamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Treinamento::findOrFail($id)->forceDelete();
            return redirect()->route('admin.treinamento.index')->with('success', 'Treinamentos eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Treinamentos de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Treinamentos.
     *
     * Restores a previously soft-deleted Treinamentos by ID.
     *
     * @param string $id The ID of the Treinamentos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Treinamento::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.treinamento.index')->with('success', 'Treinamentos restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Treinamentos', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Treinamentos resources.
     *
     * Retrieves all soft-deleted Treinamentos records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Treinamento::onlyTrashed()->get();
            
            return view('admin.treinamento.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Treinamentos eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Treinamentos resources.
     *
     * Restores all soft-deleted Treinamentos records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Treinamento::onlyTrashed()->restore();
            return redirect()->route('admin.treinamento.index')->with('success', 'Todos os Treinamentos eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Treinamentos eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Treinamentos resources.
     *
     * Permanently removes all soft-deleted Treinamentos records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Treinamento::onlyTrashed()->forceDelete();
            return redirect()->route('admin.treinamento.index')->with('success', 'Todos os Treinamentos eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Treinamentos', $th);
        }
    }
    /**
    * Display the TreinamentoPreProcessamento by Treinamentos ID.
    *
    *
    * @param string $id The ID of the Treinamentos
    * @return \Illuminate\View\View
    */
    public function treinamento_pre_processamentos(string $id)
    {
        try {
            $items = TreinamentoPreProcessamento::where('it_id_treinamento', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('TreinamentoPreProcessamentos não encontrado(a)');
            }

            $resource['treinamentos'] = Treinamento::where('id', $id)->get();
            
            
            $resource['treinamento_pre_processamentos'] = $items;
            $resource['pre_processamentoss'] = PreProcessamentos::all();
            return view('admin.TreinamentoPreProcessamento.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('TreinamentoPreProcessamento não encontrado(a)', $th);
        }
    }
    /**
    * Display the TreinamentoMetrica by Treinamentos ID.
    *
    *
    * @param string $id The ID of the Treinamentos
    * @return \Illuminate\View\View
    */
    public function treinamento_metricas(string $id)
    {
        try {
            $items = TreinamentoMetrica::where('it_id_treinamento', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('TreinamentoMetricas não encontrado(a)');
            }

            $resource['treinamentos'] = Treinamento::where('id', $id)->get();
            
            
            $resource['treinamento_metricas'] = $items;
            $resource['metricass'] = Metricas::all();
            return view('admin.TreinamentoMetrica.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('TreinamentoMetrica não encontrado(a)', $th);
        }
    }
    /**
    * Display the Modelo by Treinamentos ID.
    *
    *
    * @param string $id The ID of the Treinamentos
    * @return \Illuminate\View\View
    */
    public function modelos(string $id)
    {
        try {
            $items = Modelo::where('it_id_treinamento', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Modelos não encontrado(a)');
            }

            $resource['treinamentos'] = Treinamento::where('id', $id)->get();
            
            
            $resource['modelos'] = $items;
            $resource['datasets'] = Dataset::all();
            $resource['categoria_modelos'] = CategoriaModelo::all();
            return view('admin.Modelo.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Modelo não encontrado(a)', $th);
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