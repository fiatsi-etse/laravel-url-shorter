@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Liste des urls') }}
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#urlCreationModal">
                            Créer un lien court
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

                    @if(sizeof($urls)==0)
                    <p>Pas de lien créé</p>
                    @else
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Nom</th>
                                <th>Url d'origine</th>
                                <th>Url court</th>
                                <th>Nombre de clicks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($urls as $url)
                            <tr>
                                <td>1</td>
                                <td>{{$url->name}}</td>
                                <td>{{strlen($url->originalUrl) > 30 ? substr($url->originalUrl, 0, 30) . '...' :
                                    $url->originalUrl}}</td>
                                <td><a href="{{$url->generatedUrl}}" target="_blank">{{strlen($url->generatedUrl) > 30 ?
                                        substr($url->originalUrl, 0, 30) . '...' : config('app.url') . '/' .
                                        $url->generatedUrl}}</a></td>
                                <td>{{$url->click}}</td>
                                <td>
                                    @if($url->active)
                                    <span class="badge bg-success">Actif</span>
                                    @else
                                    <span class="badge bg-danger">Désactivé</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#urlEditionModal" data-url="{{$url}}" data-name="{{$url->name}}"
                                        data-click="{{$url->click}}" data-originalUrl="{{$url->originalUrl}}"
                                        data-generatedUrl="{{$url->generatedUrl}}" data-active="{{$url->active}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z">
                                            </path>
                                            <path
                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$urls->links()}}
                    @endif

                </div>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="urlCreationModal" tabindex="-1" role="dialog" aria-labelledby="urlCreationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="urlCreationModalLabel">Ajouter un nouveau lien</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route("url.store")}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom du lien court</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                aria-describedby="nameHelp" placeholder="Nom du lien">
                            <small id="nameHelp" class="form-text text-muted">Un nom vous permettant de vous
                                retrouver.</small>
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="originalUrl">Url original</label>
                            <input required type="text" class="form-control" id="originalUrl" name="originalUrl"
                                placeholder="Url Original">
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

    <div class="modal fade" id="urlEditionModal" tabindex="-1" role="dialog" aria-labelledby="urlEditionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="urlEditionModalLabel">Editer un lien</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="updateForm" action="#">
                        {{method_field('patch')}}
                        @csrf
                        <input type="hidden" name="url_id" id="url_id">
                        <div class="form-group">
                            <label for="name">Nom du lien court</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                aria-describedby="nameHelp" placeholder="Nom du lien">
                            <small id="nameHelp" class="form-text text-muted">Un nom vous permettant de vous
                                retrouver.</small>
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="originalUrl">Url original</label>
                            <input required type="text" class="form-control" id="originalUrl" name="originalUrl"
                                placeholder="Url Original">
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label for="generatedUrl">Url généré</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ config('app.url') }}</span>
                                </div>
                                <input required type="text" class="form-control" id="generatedUrl" name="generatedUrl"
                                    placeholder="Url généré">
                            </div>
                        </div>
                        <p></p>
                        <div class="form-check form-switch">
                            <input type="hidden" id="active" name="active" value="0">
                            <input class="form-check-input" type="checkbox" role="switch" id="activeDisplay" name="activeDisplay"
                                value="1">
                            <label class="form-check-label" for="active">Active</label>
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
    
    $("#urlCreationModal").modal();
    });

    $('#urlEditionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var url = button.data('url') // Extract info from data-* attributes
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body #url_id').val(url.id)
        modal.find('.modal-body #name').val(url.name)
        modal.find('.modal-body #originalUrl').val(url.originalUrl)
        modal.find('.modal-body #generatedUrl').val(url.generatedUrl)
        modal.find('.modal-body #activeDisplay').val(url.active)

        const checkbox = document.getElementById("activeDisplay");

        // Activez ou désactivez la checkbox en fonction de la valeur
        if (url.active) {
            checkbox.checked = true;
        } else {
            checkbox.checked = false;
        }

        const form = document.getElementById("updateForm");
        const newActionUrl = "/url/"+url.id; // Remplacez par la nouvelle URL que vous voulez définir

        form.action = newActionUrl;
    })

    const activeCheckbox = document.getElementById('activeDisplay');
    const active = document.getElementById('active');

    activeCheckbox.addEventListener('change', function () {
        if (activeCheckbox.checked) {
            active.value = "1"; // Met la valeur à 1 si cochée
        } else {
            active.value = "0"; // Met la valeur à 0 si décochée
        }
    });
</script>
@endsection