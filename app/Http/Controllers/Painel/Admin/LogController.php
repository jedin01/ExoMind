<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Logs resources in the admin panel.
 */
class LogController extends Controller
{
    /**
     * Display a listing of Logs resources.
     *
     * Retrieves all Logs records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Log::all();
        
        $resources['users'] = User::all();
        return view('admin.log.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Logs.
     *
     * Fetches related entities required to populate form fields for creating a new Logs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'users' => User::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Logs', $th, true);
        }
    }

    /**
     * Store a newly created Logs in the database.
     *
     * Validates the request data and creates a new Logs record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lt_description' => 'required',
            'vc_agent' => 'sometimes|string',
            'vc_ip_address' => 'sometimes|string',
            'vc_level' => 'sometimes|string',
            'it_id_user' => 'required|exists:users,id',
        ], [
            'lt_description.required' => 'A descrição é obrigatória',
            'vc_agent.required' => '',
            'vc_ip_address.required' => '',
            'vc_level.required' => '',
            'it_id_user.required' => 'O user é um campo obrigatório',
            'it_id_user.exists' => 'O user selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'lt_description' => $request['lt_description'],
                'vc_agent' => $request['vc_agent'],
                'vc_ip_address' => $request['vc_ip_address'],
                'vc_level' => $request['vc_level'],
                'it_id_user' => $request['it_id_user'],
            ];

            Log::create($data);

            return redirect()->route('admin.log.index')->with('success', 'Logs cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Logs', $th);
        }
    }

    /**
    * Display the specified Logs.
    *
    * Retrieves a specific Logs by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Logs
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Log::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Logs não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['log_detail'] = $items->first();
            $resource['users'] = User::all();
            
            $resource['logs'] = $items;
            return view('admin.log.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Logs não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Logs.
     *
     * Fetches the specified Logs and related entities for editing.
     *
     * @param string $id The ID of the Logs
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Log::findOrFail($id);
            return response()->json([
                'item' => $item,
                'users' => User::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Logs', $th, true);
        }
    }

    /**
     * Update the specified Logs in the database.
     *
     * Validates the request data and updates the specified Logs record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Logs
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'lt_description' => 'required',
            'vc_agent' => 'sometimes|string',
            'vc_ip_address' => 'sometimes|string',
            'vc_level' => 'sometimes|string',
            'it_id_user' => 'required|exists:users,id',
        ], [
            'lt_description.required' => 'A descrição é obrigatória',
            'vc_agent.required' => '',
            'vc_ip_address.required' => '',
            'vc_level.required' => '',
            'it_id_user.required' => 'O user é um campo obrigatório',
            'it_id_user.exists' => 'O user selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'lt_description' => $request['lt_description'],
                'vc_agent' => $request['vc_agent'],
                'vc_ip_address' => $request['vc_ip_address'],
                'vc_level' => $request['vc_level'],
                'it_id_user' => $request['it_id_user'],
            ];


            Log::findOrFail($id)->update($data);

            return redirect()->route('admin.log.index')->with('success', 'Logs atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Logs', $th);
        }
    }

    /**
     * Soft delete the specified Logs.
     *
     * Marks the specified Logs as deleted without removing it from the database.
     *
     * @param string $id The ID of the Logs
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Log::findOrFail($id)->delete();
            return redirect()->route('admin.log.index')->with('success', 'Logs eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Logs de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Logs.
     *
     * Removes the specified Logs from the database permanently.
     *
     * @param string $id The ID of the Logs
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Log::findOrFail($id)->forceDelete();
            return redirect()->route('admin.log.index')->with('success', 'Logs eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Logs de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Logs.
     *
     * Restores a previously soft-deleted Logs by ID.
     *
     * @param string $id The ID of the Logs
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Log::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.log.index')->with('success', 'Logs restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Logs', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Logs resources.
     *
     * Retrieves all soft-deleted Logs records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Log::onlyTrashed()->get();
            
            return view('admin.log.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Logs eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Logs resources.
     *
     * Restores all soft-deleted Logs records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Log::onlyTrashed()->restore();
            return redirect()->route('admin.log.index')->with('success', 'Todos os Logs eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Logs eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Logs resources.
     *
     * Permanently removes all soft-deleted Logs records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Log::onlyTrashed()->forceDelete();
            return redirect()->route('admin.log.index')->with('success', 'Todos os Logs eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Logs', $th);
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