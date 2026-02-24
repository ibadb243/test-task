<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Container</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Edit Container</h2>
    
    <form action="{{ route('containers.update', $container->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 border rounded shadow-sm">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $container->name }}" required>
        </div>
        <div class="mb-3">
            <label>Country</label>
            <select name="country_id" class="form-select" required>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ $container->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="active" {{ $container->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $container->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($container->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $container->image) }}" width="100" alt="Current Image">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('containers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>