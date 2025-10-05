<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rule;
/**
 * Controller for managing Users resources in the admin panel.
 */
class UserController extends Controller
{
    /**
     * Display a listing of Users resources.
     *
     * Retrieves all Users records and related entities for display in the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $resources['items'] = User::all();
        
        $resources['roles'] = Role::all();
        return view('admin.user.index', $resources);
    }

    /**
     * Return JSON with related entities for creating a new Users.
     *
     * Fetches related entities required to populate form fields for creating a new Users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        try {
            return response()->json([
                'roles' => Role::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para criação de Users', $th, true);
        }
    }

    /**
     * Store a newly created Users in the database.
     *
     * Validates the request data and creates a new Users record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'profile_photo_path' => 'sometimes|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'it_id_role' => 'required|exists:roles,id',
        ], [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A senha é obrigatória',
            'profile_photo_path.required' => '',
            'profile_photo_path.file' => 'O campo profile_photo_path deve ser um arquivo válido',
            'profile_photo_path.mimes' => 'O arquivo profile_photo_path deve ser do tipo: jpeg, png, jpg, pdf, doc, docx',
            'profile_photo_path.max' => 'O arquivo profile_photo_path não pode ser maior que 10MB',
            'it_id_role.required' => 'O role é um campo obrigatório',
            'it_id_role.exists' => 'O role selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
                'profile_photo_path' => $request->hasFile('profile_photo_path') ? upload($request->file('profile_photo_path')) : null,
                'it_id_role' => $request['it_id_role'],
            ];

            User::create($data);

            return redirect()->route('admin.user.index')->with('success', 'Users cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar cadastrar Users', $th);
        }
    }

    /**
    * Display the specified Users.
    *
    * Retrieves a specific Users by ID and related entities for dependent resources.
    *
    * @param string $id The ID of the Users
    * @return \Illuminate\View\View
    */
    public function show(string $id)
    {
        try {
            $items = User::where('id', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Users não encontrado(a)');
            }

            $resource['item'] = $items->first();
            $resource['user_detail'] = $items->first();
            $resource['roles'] = Role::all();
            
            $resource['users'] = $items;
            // Para a entidade Log (hasMany)
            return view('admin.user.detalhes', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Users não encontrado(a)', $th);
        }
    }



    /**
     * Return JSON with entities for editing a Users.
     *
     * Fetches the specified Users and related entities for editing.
     *
     * @param string $id The ID of the Users
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $item = User::findOrFail($id);
            return response()->json([
                'item' => $item,
                'roles' => Role::all(),
            ], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar obter os dados para edição de Users', $th, true);
        }
    }

    /**
     * Update the specified Users in the database.
     *
     * Validates the request data and updates the specified Users record.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id The ID of the Users
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'profile_photo_path' => 'sometimes|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'it_id_role' => 'required|exists:roles,id',
        ], [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A senha é obrigatória',
            'profile_photo_path.required' => '',
            'profile_photo_path.file' => 'O campo profile_photo_path deve ser um arquivo válido',
            'profile_photo_path.mimes' => 'O arquivo profile_photo_path deve ser do tipo: jpeg, png, jpg, pdf, doc, docx',
            'profile_photo_path.max' => 'O arquivo profile_photo_path não pode ser maior que 10MB',
            'it_id_role.required' => 'O role é um campo obrigatório',
            'it_id_role.exists' => 'O role selecionado não é válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
                'profile_photo_path' => $request->hasFile('profile_photo_path') ? upload($request->file('profile_photo_path')) : $request['profile_photo_path'],
                'it_id_role' => $request['it_id_role'],
            ];


            User::findOrFail($id)->update($data);

            return redirect()->route('admin.user.index')->with('success', 'Users atualizado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar atualizar Users', $th);
        }
    }

    /**
     * Soft delete the specified Users.
     *
     * Marks the specified Users as deleted without removing it from the database.
     *
     * @param string $id The ID of the Users
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect()->route('admin.user.index')->with('success', 'Users eliminado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar o(a) Users de id $id", $th);
        }
    }

    /**
     * Permanently delete the specified Users.
     *
     * Removes the specified Users from the database permanently.
     *
     * @param string $id The ID of the Users
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge(string $id)
    {
        try {
            User::findOrFail($id)->forceDelete();
            return redirect()->route('admin.user.index')->with('success', 'Users eliminado permanentemente!');
        } catch (\Throwable $th) {
            return $this->errorResponse("Ocorreu um erro ao tentar eliminar permanentemente o(a) Users de id $id", $th);
        }
    }

    /**
     * Restore a soft-deleted Users.
     *
     * Restores a previously soft-deleted Users by ID.
     *
     * @param string $id The ID of the Users
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        try {
            $item = User::withTrashed()->findOrFail($id);
            $item->restore();
            return redirect()->route('admin.user.index')->with('success', 'Users restaurado com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar o(a) Users', $th);
        }
    }

    /**
     * Display a listing of soft-deleted Users resources.
     *
     * Retrieves all soft-deleted Users records for display in the trashed view.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        try {
            $resources['items'] = User::onlyTrashed()->get();
            
            return view('admin.user.trashed', $resources);
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar recuperar os Users eliminados', $th);
        }
    }

    /**
     * Restore all soft-deleted Users resources.
     *
     * Restores all soft-deleted Users records in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            User::onlyTrashed()->restore();
            return redirect()->route('admin.user.index')->with('success', 'Todos os Users eliminados foram restaurados com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar restaurar todos os Users eliminados', $th);
        }
    }

    /**
     * Permanently delete all soft-deleted Users resources.
     *
     * Permanently removes all soft-deleted Users records from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            User::onlyTrashed()->forceDelete();
            return redirect()->route('admin.user.index')->with('success', 'Todos os Users eliminados permanentemente com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse('Ocorreu um erro ao tentar eliminar permanentemente todos os Users', $th);
        }
    }
    /**
    * Display the Log by Users ID.
    *
    *
    * @param string $id The ID of the Users
    * @return \Illuminate\View\View
    */
    public function logs(string $id)
    {
        try {
            $items = Log::where('it_id_user', $id)->get();
            if ($items->isEmpty()) {
                throw new \Exception('Logs não encontrado(a)');
            }

            $resource['users'] = User::where('id', $id)->get();
            
            
            $resource['logs'] = $items;
            return view('admin.Log.index', $resource);
        } catch (\Throwable $th) {
            return $this->errorResponse('Log não encontrado(a)', $th);
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