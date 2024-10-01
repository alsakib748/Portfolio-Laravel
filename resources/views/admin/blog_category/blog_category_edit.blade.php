@extends('admin.admin_master')

@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Blog Category Page</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('update.blog.category',$blogCategory->id) }}" method="post">
                    @csrf

                        <div class="row mb-3">
                            <label for="portfolio_name" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $blogCategory->blog_category }}" class="form-control" id="blog_category" name="blog_category">
                                @error('blog_category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Category">

                    </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection


