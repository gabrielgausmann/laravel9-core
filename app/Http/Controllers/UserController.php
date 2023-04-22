<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Permissões
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfis = Role::all();
        return view('admin.usuarios.create', compact('perfis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'perfis' => 'required'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $usuario = User::create($input);
        $usuario->assignRole($request->input('perfis'));
        return redirect()->route('admin.usuarios.index')->with([
            'message' => 'Usuário criado com sucesso!', 
            'style' => 'primary',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Resgata o ID do usuário
        $usuario = User::find($id);

        $perfis = Role::all();
        $perms = Permission::all();
 
         return view('admin.usuarios.show', compact('usuario', 'perfis', 'perms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $perfis = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'perfis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        
        $input = $request->all();
        unset($input['_token'], $input['_method']);

        if($id == 1) {
            // Previne o administrador bocaberta de se autodeletar
            (isset($input['perfis']) ? array_push($input['perfis'], "1") : $input['perfis'][0] = "1");
        }

        $usuario = User::find($id);
        $usuario->update($input);

        if($usuario->update($input) && $usuario->syncRoles($request->input('perfis'))) {
            return redirect()->route('admin.usuarios.index')->with([
                'message' => 'Dados do usuário alterados com sucesso!', 
                'style' => 'primary',
            ]);

        } else {

            return redirect()->route('admin.usuarios.index')->with([
                'message' => 'Dados não foram alterados!', 
                'style' => 'danger',
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.usuarios.index')->with([
            'message' => 'Usuário excluído com sucesso!', 
            'style' => 'danger',
        ]);
    }
}
