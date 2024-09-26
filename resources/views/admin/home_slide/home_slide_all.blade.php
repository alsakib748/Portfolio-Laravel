@extends('admin.admin_master')

@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Home Slide Page</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('update.slider') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <input type="hidden" name="id" value="{{ $homeslide->id }}">

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input value="{{ $homeslide->title }}" type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Short Title</label>
                            <div class="col-sm-10">
                                <input value="{{ $homeslide->short_title }}" type="text" class="form-control" id="short_title" name="short_title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Video URL</label>
                            <div class="col-sm-10">
                                <input value="{{ $homeslide->video_url }}" type="text" class="form-control" id="video_url" name="video_url">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Slider Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="home_slide" name="home_slide">
                            </div>
                        </div>

                    <center>

                        <div class="row mb-3">
                            <label for="profile_image" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showImage" src="{{ (!empty($homeslide->home_slide)) ? url($homeslide->home_slide) : url('upload/no_image.jpg') }}"  class="rounded avatar-lg" alt="Card image cap">
                            </div>
                        </div>

                    </center>

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">

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

