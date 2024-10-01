@extends('admin.admin_master')

@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Footer Page</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('update.footer') }}" method="POST">
                    @csrf

                        <input type="hidden" name="id" value="{{ $allFooter->id }}">

                        <div class="row mb-3">
                            <label for="number" class="col-sm-2 col-form-label">Number</label>
                            <div class="col-sm-10">
                                <input value="{{ $allFooter->number }}" type="number" class="form-control" id="number" name="number">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                            <div class="col-sm-10">
                                <textarea name="short_description" id="short_description" cols="30" rows="10" class="form-control">
                                    {{ $allFooter->short_description }}
                                </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input value="{{ $allFooter->address }}" type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input value="{{ $allFooter->email }}" type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input value="{{ $allFooter->facebook }}" type="text" class="form-control" id="facebook" name="facebook">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input value="{{ $allFooter->twitter }}" type="text" class="form-control" id="twitter" name="twitter">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="copyright" class="col-sm-2 col-form-label">Copyright</label>
                            <div class="col-sm-10">
                                <input value="{{ $allFooter->copyright }}" type="text" class="form-control" id="copyright" name="copyright">
                            </div>
                        </div>

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Footer Page">

                    </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
