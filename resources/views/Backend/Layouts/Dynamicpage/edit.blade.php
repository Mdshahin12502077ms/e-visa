@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Card Start -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white">Update Dynamic Page</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('dynamic_page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Page Title</label>
                                    <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control" required>
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="form-control" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="form-control" rows="6">{{ old('description', $page->description) }}</textarea>
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ ($page->status =='active')?'selected':''}}>Active</option>
                                        <option value="inactive" {{ ($page->status =='inactive')?'selected':'' }} >Inactive</option>
                                    </select>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('dynamic_page.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Update Page
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Card End -->

                </div>
            </div>

        </div>
    </div>
</div>

<!-- CKEditor Script -->
 <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
 <script>
    CKEDITOR.replace('editor');
</script>
@endsection
