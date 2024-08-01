@extends('backend.layouts.app')
@section('title', 'Edit Profile')

@section('styles')

@endsection

@section('content')
<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile Image</h3>
                        </div>
                        <div class="card-body text-center">
                            @if ($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" class="img-fluid" alt="Profile Image">
                            @else
                                <img src="{{ asset('storage/profile_images/default.png') }}" class="img-fluid" alt="Default Image">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Profile Form -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')

@endsection
