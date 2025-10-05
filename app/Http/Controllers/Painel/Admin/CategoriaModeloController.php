<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaModelo;
use App\Models\HiperparametroCategoriaModelo;
use App\Models\Modelo;
use App\Models\Dataset;
use App\Models\Treinamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Categorias de Modelo resources in the admin panel.
 */
class CategoriaModeloController extends Controller
{
    /**
     * Display a listing of Categorias de Modelo resources.
     *
     * Retrieves all Categorias de Modelo records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = CategoriaModelo::all();
        
        return view('admin.categoria_modelo.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Categorias de Modelo.
     *
     * Fetches related entities required to populate form fields for creating a new Categorias de Modelo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Categorias de Modelo', $th, true);
        }
    }

    /**
     * Store a newly created Categorias de Modelo in the database.
     *
     * Validates the request data and creates a new Categorias de Modelo record.
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

            CategoriaModelo::create($data);

            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Categorias de Modelo cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Categorias de Modelo', $th);
        }
    }

    /**
    * Display the specified Categorias de Modelo.
    *
    * Retrieves a specific Categorias de Modelo by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Categorias de Modelo
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = CategoriaModelo::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Categorias de Modelo não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['categoria_modelo_detail'] = $items->first();
            
            $resource['categoria_modelos'] = $items;
            // Para a entidade HiperparametroCategoriaModelo (hasMany)
            // Para a entidade Modelo (hasMany)
            $resource['datasets'] = Dataset::all();
            $resource['treinamentos'] = Treinamento::all();
            return view('admin.categoria_modelo.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Categorias de Modelo não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Categorias de Modelo.
     *
     * Fetches the specified Categorias de Modelo and related entities for editing.
     *
     * @param string $id The ID of the Categorias de Modelo
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = CategoriaModelo::findOrFail($id);
            return response()->json([
                'item' => $item,
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Categorias de Modelo', $th, true);
        }
    }

    /**
     * Update the specified Categorias de Modelo in the database.
     *
     * Validates the request data and updates the specified Categorias de Modelo record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Categorias de Modelo
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


            CategoriaModelo::findOrFail($id)->update($data);

            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Categorias de Modelo atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Categorias de Modelo', $th);
        }
    }

    /**
     * Soft delete the specified Categorias de Modelo.
     *
     * Marks the specified Categorias de Modelo as deleted without removing it from the database.
     *
     * @param string $id The ID of the Categorias de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            CategoriaModelo::findOrFail($id)->delete();
            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Categorias de Modelo eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Categorias de Modelo de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Categorias de Modelo.
     *
     * Removes the specified Categorias de Modelo from the database permanently.
     *
     * @param string $id The ID of the Categorias de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            CategoriaModelo::findOrFail($id)->forceDelete();
            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Categorias de Modelo eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Categorias de Modelo de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Categorias de Modelo.
     *
     * Restores a previously soft-deleted Categorias de Modelo by ID.
     *
     * @param string $id The ID of the Categorias de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = CategoriaModelo::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Categorias de Modelo restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Categorias de Modelo', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Categorias de Modelo resources.
     *
     * Retrieves all soft-deleted Categorias de Modelo records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = CategoriaModelo::onlyTrashed()->get();
            
            return view('admin.categoria_modelo.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Categorias de Modelo eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Categorias de Modelo resources.
     *
     * Restores all soft-deleted Categorias de Modelo records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            CategoriaModelo::onlyTrashed()->restore();
            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Todos os Categorias de Modelo eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Categorias de Modelo eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Categorias de Modelo resources.
     *
     * Permanently removes all soft-deleted Categorias de Modelo records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            CategoriaModelo::onlyTrashed()->forceDelete();
            return redirect()->route('admin.categoria_modelo.index')->with('success', 'Todos os Categorias de Modelo eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Categorias de Modelo', $th);
        }
    }
    /**
    * Display the HiperparametroCategoriaModelo by Categorias de Modelo ID.
    *
    *
    * @param string $id The ID of the Categorias de Modelo
    * @return \Illuminate\View\View
    */
    public function hiperparametro_categoria_modelos(string $id)
    {
        try {
            $items = HiperparametroCategoriaModelo::where('it_id_categoria_modelo', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('HiperparametroCategoriaModelos não encontrado(a)');
            }

            $resource['categoria_modelos'] = CategoriaModelo::where('id', $id)->get();
            
            
            $resource['hiperparametro_categoria_modelos'] = $items;
            return view('admin.HiperparametroCategoriaModelo.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('HiperparametroCategoriaModelo não encontrado(a)', $th);
        }
    }
    /**
    * Display the Modelo by Categorias de Modelo ID.
    *
    *
    * @param string $id The ID of the Categorias de Modelo
    * @return \Illuminate\View\View
    */
    public function modelos(string $id)
    {
        try {
            $items = Modelo::where('it_id_categoria_modelo', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Modelos não encontrado(a)');
            }

            $resource['categoria_modelos'] = CategoriaModelo::where('id', $id)->get();
            
            
            $resource['modelos'] = $items;
            $resource['datasets'] = Dataset::all();
            $resource['treinamentos'] = Treinamento::all();
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