@extends('layouts.app')

@section('content')


<div class="container mt-5">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

    </div>
    <div class="row dash">
        <div class="col-md-4">
            <div class="card btn bg-warning ">

                
                    <div class="pt-4 pb-4">
                        Nombre d'utilisateurs()
                    </div>
                
            </div>



        </div>
        <div class="col-md-4">
            <div class="card btn bg-warning">
                <div class="pt-4 pb-4">Nombre de d'enregistrement(1)</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card btn bg-warning">
                <div class="pt-4 pb-4">Nombre de d'enregistrement(1)</div>
            </div>
        </div>
    </div>
</div>
@endsection