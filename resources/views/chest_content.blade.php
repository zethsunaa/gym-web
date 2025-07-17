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

    {{-- Hero section (pastikan CSS untuk .home-hero-container sudah benar di app.css) --}}
    <div class="home-hero-container">
        {{-- Konten hero section bisa ditambahkan di sini, misalnya judul atau teks --}}
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 400px;">
            <h1 class="text-center">Our Chest Exercises</h1>
        </div>
    </div>

  <div class="container mt-5"> {{-- Tambahkan margin-top untuk jarak dari hero --}}
    <div class="home-content-container">
        {{-- Pastikan row-cols-2 atau responsive columns lainnya --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4"> {{-- Menggunakan g-4 untuk gap antar kolom --}}
            @forelse($exercises as $exercise)
            <div class="col">
                <div class="card mx-auto h-100" style="max-width: 30rem;"> {{-- mx-auto untuk center, h-100 agar tinggi card sama --}}
                    @if($exercise->img)
                        <img src="{{ asset($exercise->img) }}" class="card-img-top" alt="{{ $exercise->name_exercise }}">
                    @else
                        {{-- Placeholder jika tidak ada gambar --}}
                        <img src="https://placehold.co/400x250/cccccc/333333?text=No+Image" class="card-img-top" alt="No Image Available">
                    @endif
                    <div class="card-body d-flex flex-column"> {{-- flex-column untuk tata letak konten card --}}
                        <h5 class="card-title">{{ $exercise->name_exercise }}</h5>
                        <p class="card-text flex-grow-1">{!! Str::limit($exercise->description, 100) !!}</p> {{-- Batasi deskripsi --}}
                        <a href="{{ route('exercise.show', ['categories' => $exercise->categories, 'id' => $exercise->id]) }}" class="btn btn-primary mt-auto">View Details</a>                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    No chest exercises found.
                </div>
            </div>
            @endforelse
        </div>
    </div>
  </div>
</body>
</html>