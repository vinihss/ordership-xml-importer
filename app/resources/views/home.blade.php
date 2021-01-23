@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{url('api/upload-xml')}}" method="post" enctype="multipart/form-data">
                            <label for="fileType">File Type</label>
                            <select id="fileType" name="fileType">
                                <option value="people">People</option>
                                <option value="shipOrder">Ship Order</option>
                            </select>
                            <label>Upload Xml</label>
                            <input name="file" id="file" type="file">
                            <input type="submit" value="Enviar">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
