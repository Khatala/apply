<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limkokwing Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Additional styling */
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

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
        }

        .sidebar a {
            color: #ffffff;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .btn {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Limkokwing Admin</a>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h5>Navigation</h5>
                <a href="#"><i class="bi bi-person"></i> Profile</a>
                <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="container mt-5">

                <div class="row justify-content-center">
                        <div class="col-md-10 d-flex justify-content-end">
                            <a href="#" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    <h1 class="mt-4">Add Course</h1>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Course Form -->
                    <form action="{{ route('faculties.courses.storeByInstitution', ['institution_id' => $institutionId, 'faculty_id' => $facultyId]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="course_name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="course_name" name="course_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <input type="text" class="form-control" id="level" name="level" required>
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>

                        <button type="submit" class="btn btn-dark">Save Course</button>
                        <a href="{{ route('faculties.courses.indexby', ['institutionId' => $institutionId, 'facultyId' => $facultyId]) }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Limkokwing Applications. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+cbjaQEvYgz3hYQ7PzcI0yZG0y7hD" crossorigin="anonymous"></script>
</body>

</html>
