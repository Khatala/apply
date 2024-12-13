<!-- resources/views/products/index.blade.php -->
<h1>institutions List</h1>
@foreach($institutions as $institution)
    <p>{{ $institution->name }}</p>
@endforeach
