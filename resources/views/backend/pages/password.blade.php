@extends('backend.layouts.app')
@section('title', 'Change Password')

@section('styles')

@endsection

@section('content')
    <div class="content-wrapper mt-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <!-- General Form Elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- Form Start -->
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <div class="card-body">
                                    <!-- Display Success Message -->
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <!-- Display Errors -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group mb-3">
                                        <label for="current_password">Current Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password" required>
                                        <!-- Marked as required with an asterisk -->
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="new_password">New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" required>
                                        <!-- Marked as required with an asterisk -->
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="new_password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password" required>
                                        <!-- Marked as required with an asterisk -->
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                        <!-- Centered button -->
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
