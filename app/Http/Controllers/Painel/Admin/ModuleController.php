<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Group;
use App\Models\RolePermissions;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Modules resources in the admin panel.
 */
class ModuleController extends Controller
{
    /**
     * Display a listing of Modules resources.
     *
     * Retrieves all Modules records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = Module::all();
        
        $resources['groups'] = Group::all();
        return view('admin.module.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Modules.
     *
     * Fetches related entities required to populate form fields for creating a new Modules.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'groups' => Group::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Modules', $th, true);
        }
    }

    /**
     * Store a newly created Modules in the database.
     *
     * Validates the request data and creates a new Modules record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'vc_prefix' => 'required|string',
            'vc_route_subgroup' => 'required|string',
            'vc_url' => 'required|string',
            'vc_sub_group' => 'sometimes|string',
            'vc_icon' => 'sometimes|string',                                    
            'it_id_group' => 'required|exists:groups,id',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'vc_prefix.required' => 'O prefixo é obrigatório',
            'vc_route_subgroup.required' => 'O subgrupo de rota é obrigatório',
            'vc_url.required' => 'A URL é obrigatória',
            'vc_sub_group.required' => 'O subgrupo é opcional',
            'vc_icon.required' => 'O ícone é opcional',
            'it_id_group.required' => 'O group é um campo obrigatório',
            'it_id_group.exists' => 'O group selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'vc_prefix' => $request['vc_prefix'],
                'vc_url' => $request['vc_url'],
                'vc_route_subgroup' => $request['vc_route_subgroup'],
                'vc_icon' => $request['vc_icon'],
                'it_id_group' => $request['it_id_group'],
            ];

            Module::create($data);

            return redirect()->route('admin.module.index')->with('success', 'Modules cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Modules', $th);
        }
    }

    /**
    * Display the specified Modules.
    *
    * Retrieves a specific Modules by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Modules
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = Module::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Modules não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['module_detail'] = $items->first();
            $resource['groups'] = Group::all();
            
            $resource['modules'] = $items;
            // Para a entidade RolePermissions (hasMany)
            $resource['roles'] = Role::all();
            return view('admin.module.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Modules não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Modules.
     *
     * Fetches the specified Modules and related entities for editing.
     *
     * @param string $id The ID of the Modules
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = Module::findOrFail($id);
            return response()->json([
                'item' => $item,
                'groups' => Group::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Modules', $th, true);
        }
    }

    /**
     * Update the specified Modules in the database.
     *
     * Validates the request data and updates the specified Modules record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Modules
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'vc_nome' => 'required|string',
            'vc_prefix' => 'required|string',
            'vc_route_subgroup' => 'required|string',
            'vc_url' => 'required|string',
            'vc_sub_group' => 'sometimes|string',
            'vc_icon' => 'sometimes|string',
            //'it_id_group' => 'required|exists:groups,id',
        ], [
            'vc_nome.required' => 'O nome é obrigatório',
            'vc_prefix.required' => 'O prefixo é obrigatório',
            'vc_route_subgroup.required' => 'O subgrupo de rota é obrigatório',
            'vc_url.required' => 'A URL é obrigatória',
            'vc_sub_group.required' => 'O subgrupo é opcional',
            'vc_icon.required' => 'O ícone é opcional',
            //'it_id_group.required' => 'O group é um campo obrigatório',
           // 'it_id_group.exists' => 'O group selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'vc_nome' => $request['vc_nome'],
                'vc_prefix' => $request['vc_prefix'],
                'vc_url' => $request['vc_url'],
                'vc_icon' => $request['vc_icon'],
              //  'it_id_group' => $request['it_id_group'],
            ];


            Module::findOrFail($id)->update($data);

            return redirect()->route('admin.module.index')->with('success', 'Modules atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Modules', $th);
        }
    }

    /**
     * Soft delete the specified Modules.
     *
     * Marks the specified Modules as deleted without removing it from the database.
     *
     * @param string $id The ID of the Modules
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            Module::findOrFail($id)->delete();
            return redirect()->route('admin.module.index')->with('success', 'Modules eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Modules de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Modules.
     *
     * Removes the specified Modules from the database permanently.
     *
     * @param string $id The ID of the Modules
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            Module::findOrFail($id)->forceDelete();
            return redirect()->route('admin.module.index')->with('success', 'Modules eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Modules de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Modules.
     *
     * Restores a previously soft-deleted Modules by ID.
     *
     * @param string $id The ID of the Modules
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = Module::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.module.index')->with('success', 'Modules restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Modules', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Modules resources.
     *
     * Retrieves all soft-deleted Modules records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = Module::onlyTrashed()->get();
            
            return view('admin.module.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Modules eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Modules resources.
     *
     * Restores all soft-deleted Modules records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Module::onlyTrashed()->restore();
            return redirect()->route('admin.module.index')->with('success', 'Todos os Modules eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Modules eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Modules resources.
     *
     * Permanently removes all soft-deleted Modules records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Module::onlyTrashed()->forceDelete();
            return redirect()->route('admin.module.index')->with('success', 'Todos os Modules eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Modules', $th);
        }
    }
    /**
    * Display the RolePermissions by Modules ID.
    *
    *
    * @param string $id The ID of the Modules
    * @return \Illuminate\View\View
    */
    public function role_permissionss(string $id)
    {
        try {
            $items = RolePermissions::where('it_id_module', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('RolePermissionss não encontrado(a)');
            }

            $resource['modules'] = Module::where('id', $id)->get();
            
            
            $resource['role_permissionss'] = $items;
            $resource['roles'] = Role::all();
            return view('admin.RolePermissions.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('RolePermissions não encontrado(a)', $th);
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