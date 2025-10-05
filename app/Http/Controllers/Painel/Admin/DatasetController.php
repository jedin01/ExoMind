<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\Fonte;
use App\Models\Modelo;
use App\Models\CategoriaModelo;
use App\Models\Treinamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Datasets resources in the admin panel.
 */
class DatasetController extends Controller
{
    /**
     * Display a listing of Datasets resources.
     *
     * Retrieves all Datasets records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Dataset::all();
        
        $resources['fontes'] = Fonte::all();
        return view('admin.dataset.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Datasets.
     *
     * Fetches related entities required to populate form fields for creating a new Datasets.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'fontes' => Fonte::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Datasets', $th, true);
        }
    }

    /**
     * Store a newly created Datasets in the database.
     *
     * Validates the request data and creates a new Datasets record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'caminho' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'qtd_observacoes' => 'required',
            'it_id_fonte' => 'required|exists:fontes,id',
        ], [
            'titulo.required' => 'O título é obrigatório',
            'caminho.required' => 'O caminho é obrigatório',
            'caminho.file' => 'O campo caminho deve ser um arquivo válido',
            'caminho.mimes' => 'O arquivo caminho deve ser do tipo: jpeg, png, jpg, pdf, doc, docx',
            'caminho.max' => 'O arquivo caminho não pode ser maior que 10MB',
            'qtd_observacoes.required' => 'A quantidade de observações é obrigatória',
            'it_id_fonte.required' => 'O fonte é um campo obrigatório',
            'it_id_fonte.exists' => 'O fonte selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'titulo' => $request['titulo'],
                'caminho' => $request->hasFile('caminho') ? upload($request->file('caminho')) : null,
                'qtd_observacoes' => $request['qtd_observacoes'],
                'it_id_fonte' => $request['it_id_fonte'],
            ];

            Dataset::create($data);

            return redirect()->route('admin.dataset.index')->with('success', 'Datasets cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Datasets', $th);
        }
    }

    /**
    * Display the specified Datasets.
    *
    * Retrieves a specific Datasets by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Datasets
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Dataset::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Datasets não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['dataset_detail'] = $items->first();
            $resource['fontes'] = Fonte::all();
            
            $resource['datasets'] = $items;
            // Para a entidade Modelo (hasMany)
            $resource['categoria_modelos'] = CategoriaModelo::all();
            $resource['treinamentos'] = Treinamento::all();
            return view('admin.dataset.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Datasets não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Datasets.
     *
     * Fetches the specified Datasets and related entities for editing.
     *
     * @param string $id The ID of the Datasets
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Dataset::findOrFail($id);
            return response()->json([
                'item' => $item,
                'fontes' => Fonte::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Datasets', $th, true);
        }
    }

    /**
     * Update the specified Datasets in the database.
     *
     * Validates the request data and updates the specified Datasets record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Datasets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'caminho' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'qtd_observacoes' => 'required',
            'it_id_fonte' => 'required|exists:fontes,id',
        ], [
            'titulo.required' => 'O título é obrigatório',
            'caminho.required' => 'O caminho é obrigatório',
            'caminho.file' => 'O campo caminho deve ser um arquivo válido',
            'caminho.mimes' => 'O arquivo caminho deve ser do tipo: jpeg, png, jpg, pdf, doc, docx',
            'caminho.max' => 'O arquivo caminho não pode ser maior que 10MB',
            'qtd_observacoes.required' => 'A quantidade de observações é obrigatória',
            'it_id_fonte.required' => 'O fonte é um campo obrigatório',
            'it_id_fonte.exists' => 'O fonte selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'titulo' => $request['titulo'],
                'caminho' => $request->hasFile('caminho') ? upload($request->file('caminho')) : $request['caminho'],
                'qtd_observacoes' => $request['qtd_observacoes'],
                'it_id_fonte' => $request['it_id_fonte'],
            ];


            Dataset::findOrFail($id)->update($data);

            return redirect()->route('admin.dataset.index')->with('success', 'Datasets atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Datasets', $th);
        }
    }

    /**
     * Soft delete the specified Datasets.
     *
     * Marks the specified Datasets as deleted without removing it from the database.
     *
     * @param string $id The ID of the Datasets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Dataset::findOrFail($id)->delete();
            return redirect()->route('admin.dataset.index')->with('success', 'Datasets eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Datasets de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Datasets.
     *
     * Removes the specified Datasets from the database permanently.
     *
     * @param string $id The ID of the Datasets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Dataset::findOrFail($id)->forceDelete();
            return redirect()->route('admin.dataset.index')->with('success', 'Datasets eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Datasets de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Datasets.
     *
     * Restores a previously soft-deleted Datasets by ID.
     *
     * @param string $id The ID of the Datasets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Dataset::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.dataset.index')->with('success', 'Datasets restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Datasets', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Datasets resources.
     *
     * Retrieves all soft-deleted Datasets records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Dataset::onlyTrashed()->get();
            
            return view('admin.dataset.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Datasets eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Datasets resources.
     *
     * Restores all soft-deleted Datasets records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Dataset::onlyTrashed()->restore();
            return redirect()->route('admin.dataset.index')->with('success', 'Todos os Datasets eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Datasets eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Datasets resources.
     *
     * Permanently removes all soft-deleted Datasets records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Dataset::onlyTrashed()->forceDelete();
            return redirect()->route('admin.dataset.index')->with('success', 'Todos os Datasets eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Datasets', $th);
        }
    }
    /**
    * Display the Modelo by Datasets ID.
    *
    *
    * @param string $id The ID of the Datasets
    * @return \Illuminate\View\View
    */
    public function modelos(string $id)
    {
        try {
            $items = Modelo::where('it_id_dataset', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Modelos não encontrado(a)');
            }

            $resource['datasets'] = Dataset::where('id', $id)->get();
            
            
            $resource['modelos'] = $items;
            $resource['categoria_modelos'] = CategoriaModelo::all();
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