<?php

namespace App\Http\Controllers;

use App\User;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;
use Sentinel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = EloquentUser::with('roles')->get();
        //dd($users);
//        foreach ($users as $user)
//        {
//            echo $user->getRoles()->first();
//        }
//       echo " nothing to says";
        return view('users.lister')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.ajouter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = [
            'email'=>$request['email'],
            'password'=>$request['password'],
            'civilite'=>$request['civilite'],
            'prenom'=>$request['prenom'],
            'nom'=>$request['nom'],
            'adresse'=>$request['adresse'],
            'telephone'=>$request['telephone']
        ];
        $user = Sentinel::registerAndActivate($request->all());
        $role = Sentinel::findRoleBySlug($request['role']);
        $role->users()->attach($user);
        return redirect('users')->with('message','Utilisateur enregistrer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = EloquentUser::with('roles')->find($id);
        $roles = EloquentRole::all();
        return view('users.modifier')->with(['user'=>$user,'roles'=>$roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = EloquentUser::find($id);
        if ($user->inRole('vendeur'))
        {
            echo "haha";
        }
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
        //
    }

    public function modifier(Request $request, $id)
    {
        $user = Sentinel::findById($id);
        $roles = Sentinel::getRoleRepository()->get();

        foreach ($request['roles'] as $roleslug){
            if (!$user->inRole($roleslug))
            {
                $role = Sentinel::findRoleBySlug($roleslug);
                $role->users()->attach($user);
            }
        }
        foreach ($roles as $role)
        {
            if (!in_array($role->slug, $request['roles']))
            {
                $role->users()->detach($user);
            }
        }
        return redirect('/users')->with('message','Utilisateur modifier avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($user = Sentinel::findById($id))
        {
            $user->delete();
            return redirect('/users')->with('message','Utilisateur supprimé avec succes');
        }
        return redirect('/users')->with('message','Utilisateur Inconnu');



    }
}
