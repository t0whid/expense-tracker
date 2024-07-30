@extends('backend.layouts.app')
@section('title', 'Edit Category')

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
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter Category Name" required>
                                        <!-- Value set to old input or existing category name -->
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Description <small class="text-muted">(optional)</small></label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $category->description) }}" placeholder="Enter Category Description">
                                        <!-- Value set to old input or existing category description -->
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
