@extends('backend.layouts.app')
@section('title', 'Create Category')
@section('styles')

@endsection

@section('content')
    <div class="content-wrapper mt-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add New Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('categories.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" required>
                                        <!-- Marked as required with an asterisk -->
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Description <small class="text-muted">(optional)</small></label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Category Description">
                                        <!-- Marked as optional -->
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
