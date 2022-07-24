@extends('layouts.app')


@section('content')
<div class="pull-right">
            <a class="btn btn-primary" href="{{ route('personnes.index') }}"> Retour</a> 
            <a class="btn btn-success" href="" id="dl"> Télécharger</a>
        </div>
<div class="my-5"></div>
<div class="row">
    <div class="col-md-6 margin-tb">
        <div class="pull-left">
            <h2> <strong>{{ $personne->nom }}</strong> {{ $personne->prenom }}</h2>
        </div>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-2 g-4">

    <div class="col">
        <div class="card text-center" id="test" style=" height: 720px; width: 576px;" >
            
            <div class="card-body">
                <h2 class="text-center my-2 text-primary" style="font-weight:bolder" >DIALOGUE NATIONAL INCLUSIF</h2>
                <h2 class="text-center my-2 text-primary" style="font-weight:bolder" >ecriture arabe</h2>
                <div class="row py-4">
                    <div class="col">
                        <img class="img-thumbnail" src="{{ url('storage/'.$personne->photo) }}" style=""  />
                    </div>
                    <div class="col">
                        <img class="img-thumbnail" src="{{ url($personne->qrcode) }}"  style=""/>
                    </div>
                </div><hr>
                <div class="row">
                    <h1 class="card-title">{{ $personne->nom }} {{ $personne->prenom }}</h1>
                    <h1 class="text-primary"> Matricule : {{$personne->matricule}} </h1>
                </div>
            
            </div>
                @if($personne->categorie == 'PRESSE')
                <div class="card-footer bg-warning border-warning py-3">
                        <h1 style="color:white"> {{$personne->categorie}} </h1>
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @elseif(($personne->categorie == 'SECURITE'))
                <div class="card-footer bg-danger border-danger py-3">
                        <h1 style="color:white"> {{$personne->categorie}} </h1>
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @elseif(($personne->categorie == 'CELLULE'))
                <div class="card-footer bg-primary border-primary py-3">
                        <h1 style="color:white"> {{$personne->categorie}} </h1>
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @elseif(($personne->categorie == 'SANTE'))
                <div class="card-footer bg-success border-success py-3">
                        <h1 style="color:white"> {{$personne->categorie}} </h1>
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @endif
        </div>
    </div>

    <div class="col">
        <div class="card text-center" style=" height: 720px; width: 576px;" >
            
            <div class="card-body">
                <h2 class="text-center my-2 text-primary" style="font-weight:bolder" >DIALOGUE NATIONAL INCLUSIF</h2>
                <h2 class="text-center my-2 text-primary" style="font-weight:bolder" >ecriture arabe</h2>
                <div class="py-4"></div>
                <img class="img-fluid" src="{{ url('codni.png') }}"  style="width: 70%;"/>
            
            </div>
            @if($personne->categorie == 'PRESSE')
                <div class="card-footer bg-warning border-warning py-5">
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @elseif(($personne->categorie == 'SECURITE'))
                <div class="card-footer bg-danger border-danger py-5">
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @elseif(($personne->categorie == 'CELLULE'))
                <div class="card-footer bg-primary border-primary py-5">
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @elseif(($personne->categorie == 'SANTE'))
                <div class="card-footer bg-success border-success py-5">
                        <h1 style="color:white"> Ecriture arabe </h1>
                </div>
                @endif
        </div>
    </div>
</div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script language="JavaScript">
  const btn = document.getElementById('dl');
console.log(btn);
    document.getElementById("dl").onclick = function() {
        const screenshotTarget = document.getElementById('test');

        html2canvas(screenshotTarget).then((canvas) => {
            const base64image = canvas.toDataURL("image/png");
            var anchor = document.createElement('a');
            anchor.setAttribute("href", base64image);
            anchor.setAttribute("download", "my-image.png");
            anchor.click();
            anchor.remove();
        });
    };

</script>