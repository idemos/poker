@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{route('admin_store')}}" name="form_hand" id="form_hand" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="hand" id="hand">
                        <input type="submit" value="upload">
                    </form>
                    
                    You are logged as admin!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
