@extends('layouts.adminTemplate')

@section('content')

    <div class="card card-default">
        <div class="card-header mb-0 pb-0">
            <h4  style="font-weight: 700; color:black"> <i class="fas fa-user"></i> {{isset($user) ? 'Modifier Les Informations Du l' : 'Ajouté Nouveau'}} utilisateur</h4>
        </div>
        <div class="card-body">
            <form action="{{isset($user) ? route('users.update',$user->id) : route('users.store')}}" method="POST">
                @csrf
                @if (isset($user))
                      @method('PATCH');
                  @endif
               <div class="row">
                    <div class="col">
                        <div class="form-group">
                                <label for="">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="" placeholder="Nom d'utilisateur" name="username" value="{{isset($user) ? $user->username : ''}}">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                                <label for="">mot de passe</label>
                                <input type="password" class="form-control" id="" placeholder="Mot de passe" name="password" >

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" id="" class="custom-select">
                                    <option value="employe" {{isset($user) && $user->role == 'employe' ? 'selected' : ''}} >Employée</option>
                                    <option value="admin" {{isset($user) && $user->role == 'admin' ? 'selected' : ''}} >Administrateur</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                                <input type="submit" value="{{isset($employe) ? 'Mettre à jours' : 'Ajouté'}} employee" class="btn btn-outline-success btn-block">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                                <input type="reste" value="Supprime" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </div>
            </form>
        </div>

            </div>
        </div>
    </div>

@endsection
