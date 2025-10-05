<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metricas;
use App\Models\TreinamentoMetrica;
use App\Models\Treinamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Metricas resources in the admin panel.
 */
class MetricasController extends Controller
{
    /**
     * Display a listing of Metricas resources.
     *
     * Retrieves all Metricas records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Metricas::all();
        
        return view('admin.metrica.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Metricas.
     *
     * Fetches related entities required to populate form fields for creating a new Metricas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Metricas', $th, true);
        }
    }

    /**
     * Store a newly created Metricas in the database.
     *
     * Validates the request data and creates a new Metricas record.
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

            Metricas::create($data);

            return redirect()->route('admin.metrica.index')->with('success', 'Metricas cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Metricas', $th);
        }
    }

    /**
    * Display the specified Metricas.
    *
    * Retrieves a specific Metricas by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Metricas
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Metricas::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Metricas não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['metricas_detail'] = $items->first();
            
            $resource['metricass'] = $items;
            // Para a entidade TreinamentoMetrica (hasMany)
            $resource['treinamentos'] = Treinamento::all();
            return view('admin.metrica.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Metricas não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Metricas.
     *
     * Fetches the specified Metricas and related entities for editing.
     *
     * @param string $id The ID of the Metricas
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Metricas::findOrFail($id);
            return response()->json([
                'item' => $item,
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Metricas', $th, true);
        }
    }

    /**
     * Update the specified Metricas in the database.
     *
     * Validates the request data and updates the specified Metricas record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Metricas
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


            Metricas::findOrFail($id)->update($data);

            return redirect()->route('admin.metrica.index')->with('success', 'Metricas atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Metricas', $th);
        }
    }

    /**
     * Soft delete the specified Metricas.
     *
     * Marks the specified Metricas as deleted without removing it from the database.
     *
     * @param string $id The ID of the Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Metricas::findOrFail($id)->delete();
            return redirect()->route('admin.metrica.index')->with('success', 'Metricas eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Metricas de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Metricas.
     *
     * Removes the specified Metricas from the database permanently.
     *
     * @param string $id The ID of the Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Metricas::findOrFail($id)->forceDelete();
            return redirect()->route('admin.metrica.index')->with('success', 'Metricas eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Metricas de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Metricas.
     *
     * Restores a previously soft-deleted Metricas by ID.
     *
     * @param string $id The ID of the Metricas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Metricas::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.metrica.index')->with('success', 'Metricas restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Metricas', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Metricas resources.
     *
     * Retrieves all soft-deleted Metricas records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Metricas::onlyTrashed()->get();
            
            return view('admin.metrica.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Metricas eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Metricas resources.
     *
     * Restores all soft-deleted Metricas records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Metricas::onlyTrashed()->restore();
            return redirect()->route('admin.metrica.index')->with('success', 'Todos os Metricas eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Metricas eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Metricas resources.
     *
     * Permanently removes all soft-deleted Metricas records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Metricas::onlyTrashed()->forceDelete();
            return redirect()->route('admin.metrica.index')->with('success', 'Todos os Metricas eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Metricas', $th);
        }
    }
    /**
    * Display the TreinamentoMetrica by Metricas ID.
    *
    *
    * @param string $id The ID of the Metricas
    * @return \Illuminate\View\View
    */
    public function treinamento_metricas(string $id)
    {
        try {
            $items = TreinamentoMetrica::where('it_id_metricas', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('TreinamentoMetricas não encontrado(a)');
            }

            $resource['metricass'] = Metricas::where('id', $id)->get();
            
            
            $resource['treinamento_metricas'] = $items;
            $resource['treinamentos'] = Treinamento::all();
            return view('admin.TreinamentoMetrica.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('TreinamentoMetrica não encontrado(a)', $th);
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