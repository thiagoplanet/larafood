<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }
//recebendo todas permissões disponiveis para vincular ao perfil

    public function permissionsAvailable(Request $request, $idProfile)
    {

        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        //filtrando
        $filters = $request->except('_token');

        //pegando somente as permissões que ainda não estão vinculadas
        $permissions = $profile->permissionsAvailable($request->filter);

        //dd($permissions);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {

        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        //trago atraves da request os dados do formulario de vinculo
        //dd($request->all());
        if (!$request->permissions || count($request->permissions) === 0) {
            return redirect()
                ->back()
                ->with('message', 'Favor escolher 1 permissão');

        }
        //enviar somente o array, não pode ser all()

        //vinculando permissões no Perfil - de muitos para muitos
        //como recebo um array enviarmos para as permissões
        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);

    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()
                ->back()
                ->with('message', 'Não foram encontrados perfil e permissão');

        }
        //desvincullando
        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);

    }

    //atraves das permissions pego todas profiles
    public function profiles($idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $profiles = $permission->profile()->paginate();


        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));

    }
}
