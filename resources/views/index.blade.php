<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
  <title>Home - Gym Len</title>

</head>
<body>
  @extends('layout.navbar')

    <div class="home-hero-container">
      d
    </div>

  <div class="container">
    <div class="home-content-container">
    <div class="row row-cols-2">
      <div class="col mb-5">
        <div class="card mx-auto" style="width: 30rem;">  {{-- Tambahkan mx-auto di sini --}}
          <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Chest</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              <a href="/exercises/chest" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
      </div>
      <div class="col mb-5">
        <div class="card mx-auto" style="width: 30rem;">  {{-- Tambahkan mx-auto di sini --}}
          <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Shoulder</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
      </div>
      <div class="col mb-5">
        <div class="card mx-auto" style="width: 30rem;">  {{-- Tambahkan mx-auto di sini --}}
          <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Back</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
      </div>
       <div class="col mb-5">
        <div class="card mx-auto" style="width: 30rem;">  {{-- Tambahkan mx-auto di sini --}}
          <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Leg</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
      </div>
    </div>
      

    </div>
  </div>
</body>
</html>