<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limkokwing Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #007bff;
            color: white;
        }
        .navbar-custom .navbar-brand {
            color: white;
            font-weight: bold;
            letter-spacing: 0.05rem;
        }
        .btn-dark, .btn-danger {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 0.9rem;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table td {
            vertical-align: middle;
            padding: 15px;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            border-radius: 5px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }
        .card {
            border-radius: 10px;
        }
        .image-thumbnail {
            border-radius: 50%;
            border: 2px solid #007bff;
        }
        .btn {
            border-radius: 30px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto; /* Ensures footer stays at the bottom */
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
        }
        .sidebar h5 {
            color: #ffffff;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #ffffff;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .navbar-dark .navbar-brand {
            color: #ffffff;
        }
        .card-header {
            background-color: #007bff;
        }
        .card-body {
            background-color: #ffffff;
        }
        /* Hover effect for buttons */
        .btn-dark:hover, .btn-danger:hover {
            background-color: #0056b3;
            color: white;
        }
        .btn-danger:hover {
            background-color: #dc3545;
        }
        .btn-actions {
            display: flex;
            justify-content: center;
            gap: 10px; /* Adds spacing between buttons */
        }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Limkokwing Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/404') }}">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
      <div class="row">
        
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
        <div class="position-relative d-inline-block">
          <!-- Profile Picture -->
          @if ($institution->image != "")
          <img class="border rounded-circle p-1 mb-3" width="150" height="150" src="{{ asset('uploads/institutions/'.$institution->image) }}" alt="Profile Picture">
          @else
          <img class="border rounded-circle p-1 mb-3" width="150" height="150" src="path_to_default_image.jpg" alt="Default Profile Picture">
          @endif

          <!-- Camera Icon (Positioned on the edge of the profile picture) -->
          <label for="profileImageInput" 
           class="position-absolute" 
           style="
               bottom: 12px; /* Adjust for intersection */
               right: 15px; /* Adjust for intersection */
               background-color: #007bff; 
               color: #fff; 
               border-radius: 50%; 
               width: 40px; 
               height: 40px; 
               display: flex; 
               align-items: center; 
               justify-content: center; 
               cursor: pointer; 
               box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
       <a href="{{ route('institutions.edit', $institution->id) }}"> <i class="fas fa-camera"></i></a>
    </label>
    
        </div>

        <h3>{{ $institution->name }}</h3>
        <a href="#"><i class="bi bi-person"></i> Profile</a>
        <a class="active" href="#"><i class="bi bi-journal-text"></i> Faculties</a>
        <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </div>
        
        <!-- Main Content -->
        <div class="col-md-10">
          <div class="container mt-5">
            <div class="row justify-content-center">
              <div class="col-md-10 d-flex justify-content-end">
              <a href="{{ route('faculties.log', ['institution_id' => $institution->id]) }}" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>
              </div>
            </div>

            <!-- Success Alert -->
            <div class="row justify-content-center">
              @if (Session::has('success'))
              <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                  {{ Session::get('success') }}
                </div>
              </div>
              @endif
            </div>

            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                  <div class="card-header bg-dark">
                    <h3 class="text-white">Edit Institution</h3>
                  </div>
                  <form enctype="multipart/form-data" action="{{ route('institutions.update',$institution->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card-body">
                      <!-- Name field -->
                      <div class="mb-3">
                        <label class="form-label h5">Name</label>
                        <input value="{{ old('name', $institution->name) }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <!-- Password field -->
                    <div class="mb-3">
                      <label for="password" class="form-label h5">Password</label>
                      <input value="{{ old('password', $institution->password) }}" type="password" class="@error('password') is-invalid @enderror form-control-lg form-control" placeholder="Password" name="password" id="password" required>
                      @error('password')
                      <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
                      <!-- Email field -->
                      <div class="mb-3">
                        <label class="form-label h5">Email</label>
                        <input value="{{ old('email', $institution->email) }}" type="text" class="@error('email') is-invalid @enderror form-control-lg form-control" placeholder="limko@gmail.com" name="email">
                        @error('email')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <!-- Description field -->
                      <div class="mb-3">
                        <label class="form-label h5">Description</label>
                        <textarea placeholder="Description" class="form-control" name="description" cols="30" rows="5">{{ old('description', $institution->description) }}</textarea>
                      </div>
                      <!-- Image field -->
                      <div class="mb-3">
                        <label class="form-label h5">Image</label>
                        <input type="file" class="form-control form-control-lg" name="image">
                      </div>
                      <!-- Update button -->
                      <div class="d-grid">
                        <button class="btn btn-lg btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer">
      <p>&copy; 2024 Limkokwing Applications. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe">
    </script>
  </body>
</html>
