@extends('admin.admin_master')

@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Multi Image</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store.multi.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        {{-- <input type="hidden" name="id" value="{{ $aboutPage->id }}"> --}}

                        <div class="row mb-3">
                            <label for="multi_image" class="col-sm-2 col-form-label">About Multi Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="multi_image[]" name="multi_image[]" multiple="">
                            </div>
                        </div>

                    <center>

                        <div class="row mb-3">
                            <label for="profile_image" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}"  class="rounded avatar-lg" alt="Card image cap">
                            </div>
                        </div>

                    </center>

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Mutli Image">

                    </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>

    $(document).ready(function(){

        $("#multi_image").change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $("#showImage").attr("src",e.target.result);
            }

            reader.readAsDataURL(e.target.files[0]);
        });

    });

</script>

@endsection


