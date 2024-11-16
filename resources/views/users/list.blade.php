@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">{{ __('Liste des utilisateurs') }}
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#userCreationModal">
                            Ajouter un utilisateur
                        </button>
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(sizeof($users)==0)
                    <p>Pas d'utilisateur</p>
                    @else
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Nom</th>
                                <th>adresse mail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#userEditionModal" data-user="{{$user}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                    @endif

                </div>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="userCreationModal" tabindex="-1" role="dialog" aria-labelledby="userCreationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userCreationModalLabel">Ajouter un nouvel utilisateur</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route("users.store")}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                aria-describedby="nameHelp" placeholder="Nom de l'utilisateur">
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="email">Adresse mail</label>
                            <input required type="email" class="form-control" id="email" name="email"
                                placeholder="mail@mail.com">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input required type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmez le mot de passe</label>
                            <input required type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userEditionModal" tabindex="-1" role="dialog" aria-labelledby="userEditionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userEditionModalLabel">Editer un lien</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="updateForm" action="#">
                        {{method_field('patch')}}
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                aria-describedby="nameHelp" placeholder="Nom du lien">
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required type="email" class="form-control" id="email" name="email"
                                placeholder="email@email.com">
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input required type="password" class="form-control" id="password" name="password">
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmez le mot de passe</label>
                            <input required type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #example_info {
        display: none;
    }

    .input-group-prepend {
        background-color: rgb(210, 210, 210) !important;
    }

    .input-group-text {
        background-color: unset !important;
    }
</style>

<script>
    $(document).ready(function() {
        new DataTable('#example', {
        layout: {
            bottomEnd: {
                paging: {
                    firstLast: false,
                    numbers: false,
                    previousNext: false
                }
            }
        }
    });
    
    $("#userCreationModal").modal();
    });

    $('#userEditionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var user = button.data('user') // Extract info from data-* attributes
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body #user_id').val(user.id)
        modal.find('.modal-body #name').val(user.name)
        modal.find('.modal-body #email').val(user.email)


        const form = document.getElementById("updateForm");
        const newActionuser = "/admin/users/"+user.id; // Remplacez par la nouvelle user que vous voulez définir

        form.action = newActionuser;
    })
</script>
@endsection