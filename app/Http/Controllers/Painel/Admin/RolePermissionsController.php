<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\RolePermissions;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Role de Permissions resources in the admin panel.
 */
class RolePermissionsController extends Controller
{
    /**
     * Display a listing of Role de Permissions resources.
     *
     * Retrieves all Role de Permissions records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = RolePermissions::all();
        
        $resources['roles'] = Role::all();
        $resources['modules'] = Module::all();
        return view('admin.role_permissions.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Role de Permissions.
     *
     * Fetches related entities required to populate form fields for creating a new Role de Permissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'roles' => Role::all(),
                'modules' => Module::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Role de Permissions', $th, true);
        }
    }

    /**
     * Store a newly created Role de Permissions in the database.
     *
     * Validates the request data and creates a new Role de Permissions record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bl_read' => 'required',
            'bl_update' => 'required',
            'bl_create' => 'required',
            'bl_delete' => 'required',
            'it_id_role' => 'required|exists:roles,id',
            'it_id_module' => 'required|exists:modules,id',
        ], [
            'bl_read.required' => 'O campo read é obrigatório',
            'bl_update.required' => 'O campo update é obrigatório',
            'bl_create.required' => 'O campo create é obrigatório',
            'bl_delete.required' => 'O campo delete é obrigatório',
            'it_id_role.required' => 'O role é um campo obrigatório',
            'it_id_role.exists' => 'O role selecionado não é válido',
            'it_id_module.required' => 'O module é um campo obrigatório',
            'it_id_module.exists' => 'O module selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'bl_read' => $request['bl_read'],
                'bl_update' => $request['bl_update'],
                'bl_create' => $request['bl_create'],
                'bl_delete' => $request['bl_delete'],
                'it_id_role' => $request['it_id_role'],
                'it_id_module' => $request['it_id_module'],
            ];

            RolePermissions::create($data);

            return redirect()->route('admin.role_permissions.index')->with('success', 'Role de Permissions cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Role de Permissions', $th);
        }
    }

    /**
    * Display the specified Role de Permissions.
    *
    * Retrieves a specific Role de Permissions by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Role de Permissions
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = RolePermissions::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Role de Permissions não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['role_permissions_detail'] = $items->first();
            $resource['roles'] = Role::all();
            $resource['modules'] = Module::all();
            
            $resource['role_permissionss'] = $items;
            return view('admin.role_permissions.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Role de Permissions não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Role de Permissions.
     *
     * Fetches the specified Role de Permissions and related entities for editing.
     *
     * @param string $id The ID of the Role de Permissions
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = RolePermissions::findOrFail($id);
            return response()->json([
                'item' => $item,
                'roles' => Role::all(),
                'modules' => Module::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Role de Permissions', $th, true);
        }
    }

    /**
     * Update the specified Role de Permissions in the database.
     *
     * Validates the request data and updates the specified Role de Permissions record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Role de Permissions
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'bl_read' => 'required',
            'bl_update' => 'required',
            'bl_create' => 'required',
            'bl_delete' => 'required',
            'it_id_role' => 'required|exists:roles,id',
            'it_id_module' => 'required|exists:modules,id',
        ], [
            'bl_read.required' => 'O campo read é obrigatório',
            'bl_update.required' => 'O campo update é obrigatório',
            'bl_create.required' => 'O campo create é obrigatório',
            'bl_delete.required' => 'O campo delete é obrigatório',
            'it_id_role.required' => 'O role é um campo obrigatório',
            'it_id_role.exists' => 'O role selecionado não é válido',
            'it_id_module.required' => 'O module é um campo obrigatório',
            'it_id_module.exists' => 'O module selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'bl_read' => $request['bl_read'],
                'bl_update' => $request['bl_update'],
                'bl_create' => $request['bl_create'],
                'bl_delete' => $request['bl_delete'],
                'it_id_role' => $request['it_id_role'],
                'it_id_module' => $request['it_id_module'],
            ];


            RolePermissions::findOrFail($id)->update($data);

            return redirect()->route('admin.role_permissions.index')->with('success', 'Role de Permissions atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Role de Permissions', $th);
        }
    }

    /**
     * Soft delete the specified Role de Permissions.
     *
     * Marks the specified Role de Permissions as deleted without removing it from the database.
     *
     * @param string $id The ID of the Role de Permissions
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            RolePermissions::findOrFail($id)->delete();
            return redirect()->route('admin.role_permissions.index')->with('success', 'Role de Permissions eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Role de Permissions de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Role de Permissions.
     *
     * Removes the specified Role de Permissions from the database permanently.
     *
     * @param string $id The ID of the Role de Permissions
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            RolePermissions::findOrFail($id)->forceDelete();
            return redirect()->route('admin.role_permissions.index')->with('success', 'Role de Permissions eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Role de Permissions de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Role de Permissions.
     *
     * Restores a previously soft-deleted Role de Permissions by ID.
     *
     * @param string $id The ID of the Role de Permissions
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = RolePermissions::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.role_permissions.index')->with('success', 'Role de Permissions restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Role de Permissions', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Role de Permissions resources.
     *
     * Retrieves all soft-deleted Role de Permissions records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = RolePermissions::onlyTrashed()->get();
            
            return view('admin.role_permissions.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Role de Permissions eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Role de Permissions resources.
     *
     * Restores all soft-deleted Role de Permissions records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            RolePermissions::onlyTrashed()->restore();
            return redirect()->route('admin.role_permissions.index')->with('success', 'Todos os Role de Permissions eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Role de Permissions eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Role de Permissions resources.
     *
     * Permanently removes all soft-deleted Role de Permissions records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            RolePermissions::onlyTrashed()->forceDelete();
            return redirect()->route('admin.role_permissions.index')->with('success', 'Todos os Role de Permissions eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Role de Permissions', $th);
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