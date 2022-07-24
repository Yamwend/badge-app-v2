@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestion des Personnes</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('personnes.create') }}"> Ajouter</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>ID</th>
   <th>Nom & Prénom(s)</th>
   <th>Matricule</th>
   <th>Catégorie</th>
   <th>Photo</th>
   <th>QrCode</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($personnes as $personne)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $personne->nom }} {{ $personne->prenom }}</td>
    <td>{{ $personne->matricule }}</td>
    <td>{{ $personne->categorie }}
        @if($personne->categorie = 'SANTE')
            <label class="badge badge-success">{{ $personne->categorie }}</label>
        @elseif($personne->categorie = 'SECURITE')
            <label class="badge badge-danger">{{ $personne->categorie }}</label>
        @elseif($personne->categorie == "PRESSE")
            <label class="badge badge-warning">{{ $personne->categorie }}</label>
        @elseif($personne->categorie = 'SECURITE')
            <label class="badge badge-danger">{{ $personne->categorie }}</label>
        @elseif($personne->categorie = 'CELLULES')
            <label class="badge badge-primary">{{ $personne->categorie }}</label>
        @elseif($personne->categorie = 'PARTICIPANT')
            <label class="badge badge-secondary">{{ $personne->categorie }}</label>
        @endif
    </td>
    <td>
        <img class="img-thumbnail" src="{{ url('storage/'.$personne->photo) }}" style="width:70px; hight:70px"  />
    </td>
    <td>
        <img class="img-thumbnail" src="{{ url($personne->qrcode) }}"  style="width:70px; hight:70px"/>
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('personnes.show',$personne->id) }}">Show</a>
       <a class="btn btn-primary" href="#">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['personnes.destroy', $personne->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $personnes->render() !!}



<p class="text-center text-primary"><small>Copyright @ 2022</small></p>
@endsection