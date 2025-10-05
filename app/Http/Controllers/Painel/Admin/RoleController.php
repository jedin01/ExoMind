<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RolePermissions;
use App\Models\User;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Roles resources in the admin panel.
 */
class RoleController extends Controller
{
    /**
     * Display a listing of Roles resources.
     *
     * Retrieves all Roles records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Role::all();
        
        return view('admin.role.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Roles.
     *
     * Fetches related entities required to populate form fields for creating a new Roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Roles', $th, true);
        }
    }

    /**
     * Store a newly created Roles in the database.
     *
     * Validates the request data and creates a new Roles record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'lt_descricao' => 'sometimes',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'lt_descricao.required' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'lt_descricao' => $request['lt_descricao'],
            ];

            Role::create($data);

            return redirect()->route('admin.role.index')->with('success', 'Roles cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Roles', $th);
        }
    }

    /**
    * Display the specified Roles.
    *
    * Retrieves a specific Roles by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Roles
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Role::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Roles não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['role_detail'] = $items->first();
            
            $resource['roles'] = $items;
            // Para a entidade RolePermissions (hasMany)
            $resource['modules'] = Module::all();
            // Para a entidade User (hasMany)
            return view('admin.role.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Roles não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Roles.
     *
     * Fetches the specified Roles and related entities for editing.
     *
     * @param string $id The ID of the Roles
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Role::findOrFail($id);
            return response()->json([
                'item' => $item,
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Roles', $th, true);
        }
    }

    /**
     * Update the specified Roles in the database.
     *
     * Validates the request data and updates the specified Roles record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Roles
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'lt_descricao' => 'sometimes',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'lt_descricao.required' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'lt_descricao' => $request['lt_descricao'],
            ];


            Role::findOrFail($id)->update($data);

            return redirect()->route('admin.role.index')->with('success', 'Roles atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Roles', $th);
        }
    }

    /**
     * Soft delete the specified Roles.
     *
     * Marks the specified Roles as deleted without removing it from the database.
     *
     * @param string $id The ID of the Roles
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Role::findOrFail($id)->delete();
            return redirect()->route('admin.role.index')->with('success', 'Roles eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Roles de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Roles.
     *
     * Removes the specified Roles from the database permanently.
     *
     * @param string $id The ID of the Roles
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Role::findOrFail($id)->forceDelete();
            return redirect()->route('admin.role.index')->with('success', 'Roles eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Roles de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Roles.
     *
     * Restores a previously soft-deleted Roles by ID.
     *
     * @param string $id The ID of the Roles
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Role::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.role.index')->with('success', 'Roles restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Roles', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Roles resources.
     *
     * Retrieves all soft-deleted Roles records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Role::onlyTrashed()->get();
            
            return view('admin.role.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Roles eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Roles resources.
     *
     * Restores all soft-deleted Roles records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Role::onlyTrashed()->restore();
            return redirect()->route('admin.role.index')->with('success', 'Todos os Roles eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Roles eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Roles resources.
     *
     * Permanently removes all soft-deleted Roles records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Role::onlyTrashed()->forceDelete();
            return redirect()->route('admin.role.index')->with('success', 'Todos os Roles eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Roles', $th);
        }
    }
    /**
    * Display the RolePermissions by Roles ID.
    *
    *
    * @param string $id The ID of the Roles
    * @return \Illuminate\View\View
    */
    public function role_permissionss(string $id)
    {
        try {
            $items = RolePermissions::where('it_id_role', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('RolePermissionss não encontrado(a)');
            }

            $resource['roles'] = Role::where('id', $id)->get();
            
            
            $resource['role_permissionss'] = $items;
            $resource['modules'] = Module::all();
            return view('admin.RolePermissions.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('RolePermissions não encontrado(a)', $th);
        }
    }
    /**
    * Display the User by Roles ID.
    *
    *
    * @param string $id The ID of the Roles
    * @return \Illuminate\View\View
    */
    public function users(string $id)
    {
        try {
            $items = User::where('it_id_role', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Users não encontrado(a)');
            }

            $resource['roles'] = Role::where('id', $id)->get();
            
            
            $resource['users'] = $items;
            return view('admin.User.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('User não encontrado(a)', $th);
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