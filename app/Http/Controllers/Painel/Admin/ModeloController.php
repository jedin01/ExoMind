<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use App\Models\Dataset;
use App\Models\CategoriaModelo;
use App\Models\Treinamento;
use App\Models\HiperparametroModelo;
use App\Models\HiperparametroCategoriaModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Modelos resources in the admin panel.
 */
class ModeloController extends Controller
{
    /**
     * Display a listing of Modelos resources.
     *
     * Retrieves all Modelos records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Modelo::all();
        
        $resources['datasets'] = Dataset::all();
        $resources['categoria_modelos'] = CategoriaModelo::all();
        $resources['treinamentos'] = Treinamento::all();
        return view('admin.modelo.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Modelos.
     *
     * Fetches related entities required to populate form fields for creating a new Modelos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'datasets' => Dataset::all(),
                'categoria_modelos' => CategoriaModelo::all(),
                'treinamentos' => Treinamento::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Modelos', $th, true);
        }
    }

    /**
     * Store a newly created Modelos in the database.
     *
     * Validates the request data and creates a new Modelos record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'data' => 'required',
            'it_id_dataset' => 'required|exists:datasets,id',
            'it_id_categoria' => 'required|exists:categoria_modelos,id',
            'it_id_treinamento' => 'required|exists:treinamentos,id',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'data.required' => 'A data é obrigatória',
            'it_id_dataset.required' => 'O dataset é um campo obrigatório',
            'it_id_dataset.exists' => 'O dataset selecionado não é válido',
            'it_id_categoria.required' => 'O categoria_modelo é um campo obrigatório',
            'it_id_categoria.exists' => 'O categoria_modelo selecionado não é válido',
            'it_id_treinamento.required' => 'O treinamento é um campo obrigatório',
            'it_id_treinamento.exists' => 'O treinamento selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'nome' => $request['nome'],
                'data' => $request['data'],
                'it_id_dataset' => $request['it_id_dataset'],
                'it_id_categoria' => $request['it_id_categoria'],
                'it_id_treinamento' => $request['it_id_treinamento'],
            ];

            Modelo::create($data);

            return redirect()->route('admin.modelo.index')->with('success', 'Modelos cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Modelos', $th);
        }
    }

    /**
    * Display the specified Modelos.
    *
    * Retrieves a specific Modelos by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Modelos
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Modelo::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Modelos não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['modelo_detail'] = $items->first();
            $resource['datasets'] = Dataset::all();
            $resource['categoria_modelos'] = CategoriaModelo::all();
            $resource['treinamentos'] = Treinamento::all();
            
            $resource['modelos'] = $items;
            // Para a entidade HiperparametroModelo (hasMany)
            $resource['hiperparametro_categoria_modelos'] = HiperparametroCategoriaModelo::all();
            return view('admin.modelo.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Modelos não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Modelos.
     *
     * Fetches the specified Modelos and related entities for editing.
     *
     * @param string $id The ID of the Modelos
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Modelo::findOrFail($id);
            return response()->json([
                'item' => $item,
                'datasets' => Dataset::all(),
                'categoria_modelos' => CategoriaModelo::all(),
                'treinamentos' => Treinamento::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Modelos', $th, true);
        }
    }

    /**
     * Update the specified Modelos in the database.
     *
     * Validates the request data and updates the specified Modelos record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Modelos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'data' => 'required',
            'it_id_dataset' => 'required|exists:datasets,id',
            'it_id_categoria' => 'required|exists:categoria_modelos,id',
            'it_id_treinamento' => 'required|exists:treinamentos,id',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'data.required' => 'A data é obrigatória',
            'it_id_dataset.required' => 'O dataset é um campo obrigatório',
            'it_id_dataset.exists' => 'O dataset selecionado não é válido',
            'it_id_categoria.required' => 'O categoria_modelo é um campo obrigatório',
            'it_id_categoria.exists' => 'O categoria_modelo selecionado não é válido',
            'it_id_treinamento.required' => 'O treinamento é um campo obrigatório',
            'it_id_treinamento.exists' => 'O treinamento selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'nome' => $request['nome'],
                'data' => $request['data'],
                'it_id_dataset' => $request['it_id_dataset'],
                'it_id_categoria' => $request['it_id_categoria'],
                'it_id_treinamento' => $request['it_id_treinamento'],
            ];


            Modelo::findOrFail($id)->update($data);

            return redirect()->route('admin.modelo.index')->with('success', 'Modelos atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Modelos', $th);
        }
    }

    /**
     * Soft delete the specified Modelos.
     *
     * Marks the specified Modelos as deleted without removing it from the database.
     *
     * @param string $id The ID of the Modelos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Modelo::findOrFail($id)->delete();
            return redirect()->route('admin.modelo.index')->with('success', 'Modelos eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Modelos de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Modelos.
     *
     * Removes the specified Modelos from the database permanently.
     *
     * @param string $id The ID of the Modelos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Modelo::findOrFail($id)->forceDelete();
            return redirect()->route('admin.modelo.index')->with('success', 'Modelos eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Modelos de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Modelos.
     *
     * Restores a previously soft-deleted Modelos by ID.
     *
     * @param string $id The ID of the Modelos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Modelo::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.modelo.index')->with('success', 'Modelos restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Modelos', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Modelos resources.
     *
     * Retrieves all soft-deleted Modelos records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Modelo::onlyTrashed()->get();
            
            return view('admin.modelo.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Modelos eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Modelos resources.
     *
     * Restores all soft-deleted Modelos records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Modelo::onlyTrashed()->restore();
            return redirect()->route('admin.modelo.index')->with('success', 'Todos os Modelos eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Modelos eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Modelos resources.
     *
     * Permanently removes all soft-deleted Modelos records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Modelo::onlyTrashed()->forceDelete();
            return redirect()->route('admin.modelo.index')->with('success', 'Todos os Modelos eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Modelos', $th);
        }
    }
    /**
    * Display the HiperparametroModelo by Modelos ID.
    *
    *
    * @param string $id The ID of the Modelos
    * @return \Illuminate\View\View
    */
    public function hiperparametro_modelos(string $id)
    {
        try {
            $items = HiperparametroModelo::where('it_id_modelo', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('HiperparametroModelos não encontrado(a)');
            }

            $resource['modelos'] = Modelo::where('id', $id)->get();
            
            
            $resource['hiperparametro_modelos'] = $items;
            $resource['hiperparametro_categoria_modelos'] = HiperparametroCategoriaModelo::all();
            return view('admin.HiperparametroModelo.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('HiperparametroModelo não encontrado(a)', $th);
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