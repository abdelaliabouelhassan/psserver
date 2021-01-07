@extends ('admin.dashboard')
@section('section')
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Update User</h4></div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">                
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="btn btn-secondary">Go Back</a></li>
              
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">

                @if(session()->has('good'))
                  <div class="alert alert-success" role="alert">
                        {{ session('good') }}
                    </div>
                @endif

        @if($errors->any())
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    @endif
                <div class="card-header  justify-content-between align-items-center">                               
                    <h4 class="card-title">Update the user info below</h4> 
                </div>
                <div class="card-body">
    <form method="post" action="{{ route('users.update',$user->id) }}">
        @csrf
        @method('PUT')
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User Name" name="username" value="{{ $user->username }}">

  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ $user->email }}">

  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Password (can be null)</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="password" value="">
  </div>
  @if(auth('sanctum')->id() != $user->id)
   <div class="form-check">
    <input type="checkbox" class="form-check-input"   name="is_admin" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Is Admin</label>
  </div>
  @endif
  <br>
  
  <button type="submit" class="btn btn-primary">Update User</button>
</form>
         </div>
            </div> 

        </div>                  
    </div>
    <!-- END: Card DATA-->
</div>
@stop
@section('styles')
<link rel="stylesheet" href="{{ asset("dist/vendors/datatable/css/dataTables.bootstrap4.min.css") }}">
<link rel="stylesheet" href="{{ asset("dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css") }}"> 
@stop
@section('script')
<script src="{{ asset("dist/vendors/datatable/js/jquery.dataTables.min.js") }}"></script> 
<script src="{{ asset("dist/vendors/datatable/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/jszip/jszip.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/pdfmake/pdfmake.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/pdfmake/vfs_fonts.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/buttons/js/buttons.flash.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("dist/vendors/datatable/buttons/js/buttons.print.min.js") }}"></script>              
<script src="{{ asset("dist/js/datatable.script.js") }}"></script>
@stop