<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

// Permissões
use Spatie\Permission\Models\Role;

class SelfController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function index()
    {
        $usuario = User::find(Auth::user()->id);
        $perfis = Role::all();
        $permissoes = array();
        return view('admin.self', compact(['usuario', 'perfis', 'permissoes']));
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

        // dd($request->all());
        if(isset($request["alterarSenha"])) {
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required',
            ]);

            $request['password'] = Hash::make($request['password']);
        } else {
            $this->validate($request, [
                'name' => 'required',
            ]);
        }

        $input = $request->all();

        $usuario = User::find($id);
        $usuario->update($input);

        return redirect()->route('home')->with([
            'message' => 'Dados do usuário alterados com sucesso!', 
            'style' => 'primary',
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
        //
    }
}
