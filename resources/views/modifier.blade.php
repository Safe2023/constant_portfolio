<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="row g-3" action="{{route('update', $portfolio->id)}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (session ()-> has ('success') )
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <h2 class="text-center mt-5 mb-5">Remplissez le formulaire ci-dessous</h2>

                    <div class="row g-3">
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Titre</label>

                            <input type="text" class="form-control" placeholder="Titre...." name="titre" value="{{($portfolio->titre)}}" aria-label="">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Description</label>

                            <input type="text" class="form-control" placeholder="Description" name="description" value="{{($portfolio->description)}}" aria-label="">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Image</label>

                            <input type="file" class="form-control" placeholder="Ajouter une image" name="image" value="{{($portfolio->image)}}" aria-label="">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Slug</label>

                            <input type="text" class="form-control" placeholder="https://via...." name="slug" value="{{($portfolio->slug)}}" aria-label="">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success " value="Enregistrer">
                </form>

                <div class="col-md-3"></div>
            </div>
        </div>
</body>

</html>