@extends('admin-panal.layouts.app')
@section('content')

{{--    this code will show error and success messages and validation message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert auto-dismiss" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show custom-alert auto-dismiss" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show custom-alert auto-dismiss" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="content-title">Dog Details</h2>
                <div class="d-flex justify-content-end">
{{--                 this button for    modal open for create dog .--}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Dog Details</button>
                </div>
            </div>
            <div class="col-md-12 mt-5 table-responsive">
{{--                 here is table show dog details loged in user dogs only--}}
                <table class="table table-striped border border-dark-subtle rounded ">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Breed</th>
                        <th scope="col">Birth Year</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($dogs as $dog)
                        <tr>
                            <td>{{$dog->name}}</td>
                            <td >{{$dog->breed}}</td>
                            <td>{{$dog->birth_year}}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $dog->id }}">
                                    Edit
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('dog.destroy', $dog->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this dog?')">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>


                        {{--update modal . in foreach  modal every row will open its own modal --}}



                        <div class="modal fade" id="editModal{{ $dog->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $dog->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $dog->id }}">Edit Dog</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('dog.update', $dog->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $dog->name) }}" required>
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="breed" class="form-label">Breed</label>
                                                <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed', $dog->breed) }}" required>
                                                @error('breed')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="birth_year" class="form-label">Birth Year</label>
                                                <input type="number" class="form-control @error('birth_year') is-invalid @enderror" id="birth_year" name="birth_year" value="{{ old('birth_year', $dog->birth_year) }}" min="1900" max="2099" step="1" required>
                                                @error('birth_year')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>
    </section>


    {{--  create dog modal--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="dogForm" action="{{ route('dog.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="dogName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="dogName" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dogBreed" class="form-label">Breed</label>
                            <input type="text" class="form-control" id="dogBreed" name="breed" value="{{ old('breed') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dogBirthYear" class="form-label">Birth Year</label>
                            <input type="number" class="form-control" id="dogBirthYear" name="birth_year" min="2000" max="2030" step="1" value="{{ old('birth_year') }}" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                    </form>

                </div>


            </div>
        </div>
    </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all elements with the 'auto-dismiss' class
            var autoDismissAlerts = document.querySelectorAll('.auto-dismiss');

            autoDismissAlerts.forEach(function (alert) {
                // Set a timeout to automatically dismiss the alert after 2 seconds
                setTimeout(function () {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close(); // Close the alert programmatically
                }, 2000); // 2000 milliseconds = 2 seconds
            });
        });
    </script>
@endpush

