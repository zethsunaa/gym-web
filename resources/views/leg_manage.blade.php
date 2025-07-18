<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <title>Admin - Gym Len</title>
</head>
<body>
    @extends('layout.navbar_admin_dashboard')
    <div class="container">
        <div class="content-dashboard-container justify-content-center align-items-center mx-auto">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Leg Exercise
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form action="{{ url('/leg_insert') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Leg Exercise</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                    <label for="name_exercise" class="form-label">Exercise Name</label>
                    <input type="text" class="form-control" id="name_exercise" name="name_exercise" required>
                    </div>

                    <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                    <label for="created_by" class="form-label">Created By</label>
                    <input type="text" class="form-control" id="created_by" name="created_by" value="{{ session('user_name') }}" readonly>
                    </div>

                    <div class="mb-3">
                    <label for="updated_by" class="form-label">Updated By</label>
                    <input type="text" class="form-control" id="updated_by" name="updated_by" value="{{ session('user_name') }}" readonly>
                    </div>

                    <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <input type="text" class="form-control" id="categories" name="categories" value="leg" readonly>
                    </div>

                    <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Exercise</button>
                </div>
                </form>
            </div>
            </div>

            <h5>Leg CRUD</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exercise</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created Time</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated Time</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exercises as $index => $exercise)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $exercise->name_exercise }}</td>
                        <td>{{ $exercise->description }}</td>
                        <td>{{ $exercise->created_date }}</td>
                        <td>{{ $exercise->created_by }}</td>
                        <td>{{ $exercise->updated_date }}</td>
                        <td>{{ $exercise->updated_by }}</td>
                        <td>
                            @if($exercise->img)
                                <img src="{{ asset($exercise->img) }}" alt="Image" width="200">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            {{-- Add Update and Delete buttons for Leg exercises --}}
                            {{-- Example: Update Button --}}
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{$exercise->id}}">
                                Edit
                            </button>

                            {{-- Update Modal (Basic Example, you'll need to populate it with existing data) --}}
                            <div class="modal fade" id="editModal{{$exercise->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$exercise->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('/leg_update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT') {{-- Use PUT method for update --}}
                                        <input type="hidden" name="id" value="{{ $exercise->id }}">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModalLabel{{$exercise->id}}">Edit Leg Exercise</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="edit_name_exercise" class="form-label">Exercise Name</label>
                                                <input type="text" class="form-control" id="edit_name_exercise" name="name_exercise" value="{{ $exercise->name_exercise }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_description" class="form-label">Description</label>
                                                <textarea class="form-control" id="edit_description" name="description" rows="3" required>{{ $exercise->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_updated_by" class="form-label">Updated By</label>
                                                <input type="text" class="form-control" id="edit_updated_by" name="updated_by" value="{{ session('user_name') }}" readonly> {{-- Or actual logged in user --}}
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_img" class="form-label">Image (Leave blank to keep current)</label>
                                                <input type="file" class="form-control" id="edit_img" name="img" accept="image/*">
                                                @if($exercise->img)
                                                    <img src="{{ asset($exercise->img) }}" alt="Current Image" width="50" class="mt-2">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Exercise</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Delete Button --}}
                            <form action="{{ url('/leg_delete') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $exercise->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this exercise?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('edit_description');
    </script>
    <script src="{{ url('js/main.js') }}"></script>
</body>
</html>