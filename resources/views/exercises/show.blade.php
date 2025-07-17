<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
  <title>Chest - Gym Len</title>
</head>
<body>
    @extends('layout.navbar')
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
                <img class="mx-auto detail-exercise-img" src="{{ asset($exercise->img) }}" alt="{{ $exercise->name_exercise }}">
        </div>
    </div>
    <div class="container">
        <div class="detail-exercise-container">
            <h1 class="detail-exercise-title">{{ $exercise->name_exercise }}</h1>
            <p>{!! $exercise->description !!}</p>
            <p><strong>Category:</strong> {{ $exercise->categories }}</p>
        </div>
       
    </div>
    
</body>
</html>

