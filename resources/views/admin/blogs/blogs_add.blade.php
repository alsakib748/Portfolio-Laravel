@extends('admin.admin_master')

@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Blog Page</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store.blog') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="row mb-3">
                            <label for="portfolio_name" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <select name="blog_category_id" id="blog_category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Open this select menu</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->blog_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="blog_title" name="blog_title">
                                @error('blog_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="blog_tags" class="col-sm-2 col-form-label">Blog Tags</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"  value="home,tech"  name="blog_tags" data-role="tagsinput">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="blog_description" class="col-sm-2 col-form-label">Blog Description</label>
                            <div class="col-sm-10">
                                <textarea name="blog_description" id="elm1">
                                </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="blog_image" class="col-sm-2 col-form-label">Blog Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="blog_image" name="blog_image">
                                @error('blog_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                    <center>

                        <div class="row mb-3">
                            <label for="blog_image" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}"  class="rounded avatar-lg" alt="Card image cap">
                            </div>
                        </div>

                    </center>

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Blog">

                    </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>

    $(document).ready(function(){

        $("#blog_image").change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $("#showImage").attr("src",e.target.result);
            }

            reader.readAsDataURL(e.target.files[0]);
        });

    });

</script>

@endsection


