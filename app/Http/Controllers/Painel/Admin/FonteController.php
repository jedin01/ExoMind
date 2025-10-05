<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fonte;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Fontes resources in the admin panel.
 */
class FonteController extends Controller
{
    /**
     * Display a listing of Fontes resources.
     *
     * Retrieves all Fontes records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Fonte::all();
        
        return view('admin.fonte.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Fontes.
     *
     * Fetches related entities required to populate form fields for creating a new Fontes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Fontes', $th, true);
        }
    }

    /**
     * Store a newly created Fontes in the database.
     *
     * Validates the request data and creates a new Fontes record.
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

            Fonte::create($data);

            return redirect()->route('admin.fonte.index')->with('success', 'Fontes cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Fontes', $th);
        }
    }

    /**
    * Display the specified Fontes.
    *
    * Retrieves a specific Fontes by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Fontes
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Fonte::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Fontes não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['fonte_detail'] = $items->first();
            
            $resource['fontes'] = $items;
            // Para a entidade Dataset (hasMany)
            return view('admin.fonte.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Fontes não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Fontes.
     *
     * Fetches the specified Fontes and related entities for editing.
     *
     * @param string $id The ID of the Fontes
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Fonte::findOrFail($id);
            return response()->json([
                'item' => $item,
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Fontes', $th, true);
        }
    }

    /**
     * Update the specified Fontes in the database.
     *
     * Validates the request data and updates the specified Fontes record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Fontes
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


            Fonte::findOrFail($id)->update($data);

            return redirect()->route('admin.fonte.index')->with('success', 'Fontes atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Fontes', $th);
        }
    }

    /**
     * Soft delete the specified Fontes.
     *
     * Marks the specified Fontes as deleted without removing it from the database.
     *
     * @param string $id The ID of the Fontes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Fonte::findOrFail($id)->delete();
            return redirect()->route('admin.fonte.index')->with('success', 'Fontes eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Fontes de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Fontes.
     *
     * Removes the specified Fontes from the database permanently.
     *
     * @param string $id The ID of the Fontes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Fonte::findOrFail($id)->forceDelete();
            return redirect()->route('admin.fonte.index')->with('success', 'Fontes eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Fontes de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Fontes.
     *
     * Restores a previously soft-deleted Fontes by ID.
     *
     * @param string $id The ID of the Fontes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Fonte::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.fonte.index')->with('success', 'Fontes restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Fontes', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Fontes resources.
     *
     * Retrieves all soft-deleted Fontes records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Fonte::onlyTrashed()->get();
            
            return view('admin.fonte.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Fontes eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Fontes resources.
     *
     * Restores all soft-deleted Fontes records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Fonte::onlyTrashed()->restore();
            return redirect()->route('admin.fonte.index')->with('success', 'Todos os Fontes eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Fontes eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Fontes resources.
     *
     * Permanently removes all soft-deleted Fontes records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Fonte::onlyTrashed()->forceDelete();
            return redirect()->route('admin.fonte.index')->with('success', 'Todos os Fontes eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Fontes', $th);
        }
    }
    /**
    * Display the Dataset by Fontes ID.
    *
    *
    * @param string $id The ID of the Fontes
    * @return \Illuminate\View\View
    */
    public function datasets(string $id)
    {
        try {
            $items = Dataset::where('it_id_fonte', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Datasets não encontrado(a)');
            }

            $resource['fontes'] = Fonte::where('id', $id)->get();
            
            
            $resource['datasets'] = $items;
            return view('admin.Dataset.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Dataset não encontrado(a)', $th);
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