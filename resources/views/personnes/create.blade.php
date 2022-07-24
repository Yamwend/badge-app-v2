@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter une personne</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('personnes.index') }}"> Retour</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'personnes.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Nom :</strong>
            {!! Form::text('nom', null, array('placeholder' => 'Nom','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Prénom(s) :</strong>
            {!! Form::text('prenom', null, array('placeholder' => 'Prénom(s)','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Matricule :</strong>
            {!! Form::text('matricule', null, array('placeholder' => 'Numéro Matricule','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Catégorie :</strong>
            <select name='categorie' class="form-select" aria-label="Default select example">
            <option value="CELLULE">CELLULE</option>
            <option value="PRESSE">PRESSE</option>
            <option value="PARTICIPANT">PARTICIPANT</option>
            <option value="SANTE">SANTE</option>
            <option value="SECURITE">SECURITE</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 d-none">
		<div class="form-group">
		    <strong>Photo:</strong>
		    <input type="text" value="img.png" name="photo" class="form-control" placeholder="Photo">
		</div>
	</div>
    <div class="col-xs-12 col-sm-12 col-md-6 d-none">
		<div class="form-group">
		    <strong>QrCode :</strong>
		    <input type="text" value="qrcode.svg" name="qrcode" class="form-control" placeholder="QrCode">
		</div>
	</div>
    <div class="my-1"><hr></div>
    <div class="row">
        <div class="col-md-6">
            <div id="my_camera"></div>
            <br/>
            <input class="btn btn-primary" type="button" value="Prendre une photo" onClick="take_snapshot()">
            <input type="hidden" name="image" class="image-tag">
        </div>
        <div class="col-md-6">
            <div id="results">Votre Photo apparaitra ici...</div>
        </div>
            
    </div><br>
    <div class="my-1"><hr></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-success">Valider</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small>Copyright @ 2022</small></p>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    
<script language="JavaScript">
    Webcam.set({
        width: 250,
        height: 250,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }

</script>
@endsection
