<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\HiperparametroModelo;
use App\Models\Modelo;
use App\Models\HiperparametroCategoriaModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Hiperparametros de Modelo resources in the admin panel.
 */
class HiperparametroModeloController extends Controller
{
    /**
     * Display a listing of Hiperparametros de Modelo resources.
     *
     * Retrieves all Hiperparametros de Modelo records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = HiperparametroModelo::all();
        
        $resources['modelos'] = Modelo::all();
        $resources['hiperparametro_categoria_modelos'] = HiperparametroCategoriaModelo::all();
        return view('admin.hiperparametro_modelo.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Hiperparametros de Modelo.
     *
     * Fetches related entities required to populate form fields for creating a new Hiperparametros de Modelo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'modelos' => Modelo::all(),
                'hiperparametro_categoria_modelos' => HiperparametroCategoriaModelo::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Hiperparametros de Modelo', $th, true);
        }
    }

    /**
     * Store a newly created Hiperparametros de Modelo in the database.
     *
     * Validates the request data and creates a new Hiperparametros de Modelo record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valor' => 'required|string',
            'it_id_modelo' => 'required|exists:modelos,id',
            'it_id_hiperparametro' => 'required|exists:hiperparametro_categoria_modelos,id',
        ], [
            'valor.required' => 'O valor é obrigatório',
            'it_id_modelo.required' => 'O modelo é um campo obrigatório',
            'it_id_modelo.exists' => 'O modelo selecionado não é válido',
            'it_id_hiperparametro.required' => 'O hiperparametro_categoria_modelo é um campo obrigatório',
            'it_id_hiperparametro.exists' => 'O hiperparametro_categoria_modelo selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'valor' => $request['valor'],
                'it_id_modelo' => $request['it_id_modelo'],
                'it_id_hiperparametro' => $request['it_id_hiperparametro'],
            ];

            HiperparametroModelo::create($data);

            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Hiperparametros de Modelo cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Hiperparametros de Modelo', $th);
        }
    }

    /**
    * Display the specified Hiperparametros de Modelo.
    *
    * Retrieves a specific Hiperparametros de Modelo by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Hiperparametros de Modelo
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = HiperparametroModelo::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Hiperparametros de Modelo não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['hiperparametro_modelo_detail'] = $items->first();
            $resource['modelos'] = Modelo::all();
            $resource['hiperparametro_categoria_modelos'] = HiperparametroCategoriaModelo::all();
            
            $resource['hiperparametro_modelos'] = $items;
            return view('admin.hiperparametro_modelo.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Hiperparametros de Modelo não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Hiperparametros de Modelo.
     *
     * Fetches the specified Hiperparametros de Modelo and related entities for editing.
     *
     * @param string $id The ID of the Hiperparametros de Modelo
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = HiperparametroModelo::findOrFail($id);
            return response()->json([
                'item' => $item,
                'modelos' => Modelo::all(),
                'hiperparametro_categoria_modelos' => HiperparametroCategoriaModelo::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Hiperparametros de Modelo', $th, true);
        }
    }

    /**
     * Update the specified Hiperparametros de Modelo in the database.
     *
     * Validates the request data and updates the specified Hiperparametros de Modelo record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Hiperparametros de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'valor' => 'required|string',
            'it_id_modelo' => 'required|exists:modelos,id',
            'it_id_hiperparametro' => 'required|exists:hiperparametro_categoria_modelos,id',
        ], [
            'valor.required' => 'O valor é obrigatório',
            'it_id_modelo.required' => 'O modelo é um campo obrigatório',
            'it_id_modelo.exists' => 'O modelo selecionado não é válido',
            'it_id_hiperparametro.required' => 'O hiperparametro_categoria_modelo é um campo obrigatório',
            'it_id_hiperparametro.exists' => 'O hiperparametro_categoria_modelo selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'valor' => $request['valor'],
                'it_id_modelo' => $request['it_id_modelo'],
                'it_id_hiperparametro' => $request['it_id_hiperparametro'],
            ];


            HiperparametroModelo::findOrFail($id)->update($data);

            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Hiperparametros de Modelo atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Hiperparametros de Modelo', $th);
        }
    }

    /**
     * Soft delete the specified Hiperparametros de Modelo.
     *
     * Marks the specified Hiperparametros de Modelo as deleted without removing it from the database.
     *
     * @param string $id The ID of the Hiperparametros de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            HiperparametroModelo::findOrFail($id)->delete();
            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Hiperparametros de Modelo eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Hiperparametros de Modelo de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Hiperparametros de Modelo.
     *
     * Removes the specified Hiperparametros de Modelo from the database permanently.
     *
     * @param string $id The ID of the Hiperparametros de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            HiperparametroModelo::findOrFail($id)->forceDelete();
            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Hiperparametros de Modelo eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Hiperparametros de Modelo de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Hiperparametros de Modelo.
     *
     * Restores a previously soft-deleted Hiperparametros de Modelo by ID.
     *
     * @param string $id The ID of the Hiperparametros de Modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = HiperparametroModelo::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Hiperparametros de Modelo restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Hiperparametros de Modelo', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Hiperparametros de Modelo resources.
     *
     * Retrieves all soft-deleted Hiperparametros de Modelo records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = HiperparametroModelo::onlyTrashed()->get();
            
            return view('admin.hiperparametro_modelo.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Hiperparametros de Modelo eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Hiperparametros de Modelo resources.
     *
     * Restores all soft-deleted Hiperparametros de Modelo records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            HiperparametroModelo::onlyTrashed()->restore();
            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Todos os Hiperparametros de Modelo eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Hiperparametros de Modelo eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Hiperparametros de Modelo resources.
     *
     * Permanently removes all soft-deleted Hiperparametros de Modelo records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            HiperparametroModelo::onlyTrashed()->forceDelete();
            return redirect()->route('admin.hiperparametro_modelo.index')->with('success', 'Todos os Hiperparametros de Modelo eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Hiperparametros de Modelo', $th);
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