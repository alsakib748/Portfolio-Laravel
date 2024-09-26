@extends('admin.admin_master')

@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">About Page</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('update.about') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <input type="hidden" name="id" value="{{ $aboutPage->id }}">

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input value="{{ $aboutPage->title }}" type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Short Title</label>
                            <div class="col-sm-10">
                                <input value="{{ $aboutPage->short_title }}" type="text" class="form-control" id="short_title" name="short_title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                            <div class="col-sm-10">
                                <textarea name="short_description" id="short_description" cols="30" rows="10" class="form-control">
                                    {{ $aboutPage->short_description }}
                                </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="short_description" class="col-sm-2 col-form-label">Long Description</label>
                            <div class="col-sm-10">
                                <textarea name="long_description" id="elm1">
                                {{ $aboutPage->long_description }}
                                </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">About Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="about_image" name="about_image">
                            </div>
                        </div>

                    <center>

                        <div class="row mb-3">
                            <label for="profile_image" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showImage" src="{{ (!empty($aboutPage->about_image)) ? url($aboutPage->about_image) : url('upload/no_image.jpg') }}"  class="rounded avatar-lg" alt="Card image cap">
                            </div>
                        </div>

                    </center>

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About Page">

                    </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>

    $(document).ready(function(){

        $("#image").change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $("#showImage").attr("src",e.target.result);
            }

            reader.readAsDataURL(e.target.files[0]);
        });

    });

</script>

@endsection


