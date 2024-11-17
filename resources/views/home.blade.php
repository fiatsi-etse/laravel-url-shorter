@extends('layouts.app')

@section('content')
<div class="container">
  <h5 class="">Quelques chiffres</h5>
    <div class="row">
    <div class="col-md-4">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <p class="count-numbers">{{$totalUrls}}</p>
        <p class="count-name">Url créé</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-counter danger">
        <i class="fa fa-ticket"></i>
        <p class="count-numbers">{{$mostVisitedUrl->name}}</p>
        <p class="count-name">Url le plus visité</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-counter success">
        <i class="fa fa-database"></i>
        <p class="count-numbers">{{$userWithMostUrls->name}}</p>
        <p class="count-name">Utilisateur le plus actif</p>
      </div>
    </div>
</div>

    <!-- Button trigger modal -->
</div>

<style>
  .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .count-name {
    position: relative;
  }
  
  .count-numbers {
    position: relative;
  }
</style>

<script>

  $(document).ready(function() {
$("#exampleModal").modal();
});
</script>
@endsection
