<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\HiperparametroCategoriaModelo;
use App\Models\CategoriaModelo;
use App\Models\HiperparametroModelo;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Hiperparametros de Categoria de Modelo resources in the admin panel.
 */
class HiperparametroCategoriaModeloController extends Controller
{
    /**
     * Display a listing of Hiperparametros de Categoria de Modelo resources.
     *
     * Retrieves all Hiperparametros de Categoria de Modelo records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = HiperparametroCategoriaModelo::all();
        
        $resources['categoria_modelos'] = CategoriaModelo::all();
        return view('admin.hiperparametro_categoria_modelo.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Hiperparametros de Categoria de Modelo.
     *
     * Fetches related entities required to populate form fields for creating a new Hiperparametros de Categoria de Modelo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'categoria_modelos' => CategoriaModelo::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Hiperparametros de Categoria de Modelo', $th, true);
        }
    }

    /**
     * Store a newly created Hiperparametros de Categoria de Modelo in the database.
     *
     * Validates the request data and creates a new Hiperparametros de Categoria de Modelo record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'it_id_categoria' => 'required|exists:categoria_modelos,id',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'it_id_categoria.required' => 'O categoria_modelo é um campo obrigatório',
            'it_id_categoria.exists' => 'O categoria_modelo selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'it_id_categoria' => $request['it_id_categoria'],
            ];

            HiperparametroCategoriaModelo::create($data);

            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Hiperparametros de Categoria de Modelo cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Hiperparametros de Categoria de Modelo', $th);
        }
    }

    /**
    * Display the specified Hiperparametros de Categoria de Modelo.
    *
    * Retrieves a specific Hiperparametros de Categoria de Modelo by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Hiperparametros de Categoria de Modelo
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = HiperparametroCategoriaModelo::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Hiperparametros de Categoria de Modelo não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['hiperparametro_categoria_modelo_detail'] = $items->first();
            $resource['categoria_modelos'] = CategoriaModelo::all();
            
            $resource['hiperparametro_categoria_modelos'] = $items;
            // Para a entidade HiperparametroModelo (hasMany)
            $resource['modelos'] = Modelo::all();
            return view('admin.hiperparametro_categoria_modelo.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Hiperparametros de Categoria de Modelo não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Hiperparametros de Categoria de Modelo.
     *
     * Fetches the specified Hiperparametros de Categoria de Modelo and related entities for editing.
     *
     * @param string $id The ID of the Hiperparametros de Categoria de Modelo
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = HiperparametroCategoriaModelo::findOrFail($id);
            return response()->json([
                'item' => $item,
                'categoria_modelos' => CategoriaModelo::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Hiperparametros de Categoria de Modelo', $th, true);
        }
    }

    /**
     * Update the specified Hiperparametros de Categoria de Modelo in the database.
     *
     * Validates the request data and updates the specified Hiperparametros de Categoria de Modelo record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Hiperparametros de Categoria de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'it_id_categoria' => 'required|exists:categoria_modelos,id',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'it_id_categoria.required' => 'O categoria_modelo é um campo obrigatório',
            'it_id_categoria.exists' => 'O categoria_modelo selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'it_id_categoria' => $request['it_id_categoria'],
            ];


            HiperparametroCategoriaModelo::findOrFail($id)->update($data);

            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Hiperparametros de Categoria de Modelo atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Hiperparametros de Categoria de Modelo', $th);
        }
    }

    /**
     * Soft delete the specified Hiperparametros de Categoria de Modelo.
     *
     * Marks the specified Hiperparametros de Categoria de Modelo as deleted without removing it from the database.
     *
     * @param string $id The ID of the Hiperparametros de Categoria de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            HiperparametroCategoriaModelo::findOrFail($id)->delete();
            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Hiperparametros de Categoria de Modelo eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Hiperparametros de Categoria de Modelo de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Hiperparametros de Categoria de Modelo.
     *
     * Removes the specified Hiperparametros de Categoria de Modelo from the database permanently.
     *
     * @param string $id The ID of the Hiperparametros de Categoria de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            HiperparametroCategoriaModelo::findOrFail($id)->forceDelete();
            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Hiperparametros de Categoria de Modelo eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Hiperparametros de Categoria de Modelo de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Hiperparametros de Categoria de Modelo.
     *
     * Restores a previously soft-deleted Hiperparametros de Categoria de Modelo by ID.
     *
     * @param string $id The ID of the Hiperparametros de Categoria de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = HiperparametroCategoriaModelo::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Hiperparametros de Categoria de Modelo restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Hiperparametros de Categoria de Modelo', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Hiperparametros de Categoria de Modelo resources.
     *
     * Retrieves all soft-deleted Hiperparametros de Categoria de Modelo records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = HiperparametroCategoriaModelo::onlyTrashed()->get();
            
            return view('admin.hiperparametro_categoria_modelo.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Hiperparametros de Categoria de Modelo eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Hiperparametros de Categoria de Modelo resources.
     *
     * Restores all soft-deleted Hiperparametros de Categoria de Modelo records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            HiperparametroCategoriaModelo::onlyTrashed()->restore();
            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Todos os Hiperparametros de Categoria de Modelo eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Hiperparametros de Categoria de Modelo eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Hiperparametros de Categoria de Modelo resources.
     *
     * Permanently removes all soft-deleted Hiperparametros de Categoria de Modelo records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            HiperparametroCategoriaModelo::onlyTrashed()->forceDelete();
            return redirect()->route('admin.hiperparametro_categoria_modelo.index')->with('success', 'Todos os Hiperparametros de Categoria de Modelo eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Hiperparametros de Categoria de Modelo', $th);
        }
    }
    /**
    * Display the HiperparametroModelo by Hiperparametros de Categoria de Modelo ID.
    *
    *
    * @param string $id The ID of the Hiperparametros de Categoria de Modelo
    * @return \Illuminate\View\View
    */
    public function hiperparametro_modelos(string $id)
    {
        try {
            $items = HiperparametroModelo::where('it_id_hiperparametro_categoria_modelo', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('HiperparametroModelos não encontrado(a)');
            }

            $resource['hiperparametro_categoria_modelos'] = HiperparametroCategoriaModelo::where('id', $id)->get();
            
            
            $resource['hiperparametro_modelos'] = $items;
            $resource['modelos'] = Modelo::all();
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