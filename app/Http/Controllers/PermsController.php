<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Permissões
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perms = Permission::all();
        return view('admin.perms.index', compact('perms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfis = Role::all();
        return view('admin.perms.create', compact('perfis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Apenas o nome da permissão é requerida. Perfis podem ser inclusas depois (através de Edit)
         $this->validate($request, [
            'name' => 'required',
        ]);

        // Cria a permissão
        Permission::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Verifica os perfis selecionados e vincula a permissão
        if(!is_null($request->input('perfis'))) {
            foreach($request->input('perfis') as $p) {
                $perfil = Role::find($p);

                $perfil->givePermissionTo([
                    $request->input('name'),
                ]);
            }
        }

        // Retorna para a tela inicial com mensagem de sucesso na criação do perfil
        return redirect()->route('permissoes.index')->with([
            'message' => 'Permissão criada com sucesso!',
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
        $permissao = Permission::find($id);
        $perfis = Role::all();

         return view('admin.perms.show', compact('permissao', 'perfis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissao = Permission::find($id);
        $perfis = Role::all();
        return view('admin.perms.edit', compact('permissao', 'perfis'));
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
        ]);

        $permissao = Permission::find($id);
        $permissao->update($request->all());


        // Verifica os perfis selecionados e vincula a permissão
        if(!is_null($request->input('perfis'))) {
            foreach($request->input('perfis') as $p) {
                $perfil = Role::find($p);

                $perfil->syncPermissions([
                    $request->input('name'),
                ]);
            }
        }

        return redirect()->route('permissoes.index')->with([
            'message' => 'Perfis e permissões alterados com sucesso!', 
            'style' => 'primary'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permissoes.index')->with([
            'message' => 'Permissão excluída com sucesso!',
            'style' => 'danger',
        ]);
    }
}
