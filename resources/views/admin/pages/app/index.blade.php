@extends ('admin.dashboard')
@section('section')
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">App Settings</h4></div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <div class="row">
                 @if(session()->has('good'))
                  <div class="alert alert-success" role="alert">
                        {{ session('good') }}
                    </div>
                @endif
     
     
      <div class="col-12 mt-3">
         <div class="card">

                @if($errors->any())
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
     @endif
    
        <div class="card-header  justify-content-between align-items-center">                               
           <h4 class="card-title">Add Youtube Url</h4> 
        </div>
                <div class="card-body">
  <form method="post" action="{{ route('add_banner') }}" enctype="multipart/form-data">
        @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">banner 1  </label>
    <input type="file" class="form-control" id="exampleInputEmail1"  name="banner1">
    <label for="exampleInputEmail2">banner 2  </label>
    <input type="file" class="form-control" id="exampleInputEmail2"   name="banner2">
    <br>
  <button type="submit" class="btn btn-primary">ADD BANNERS</button>
</form>
     </div>
   </div> 

   <hr>
    
    <div class="col-12 mt-3">
        <div class="card-header  justify-content-between align-items-center">                               
           <h1 class="card-title">Add Youtube Url</h1> 
        </div>
                <div class="card-body">
    <form method="post" action="{{ route('add_youtube_url') }}">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Url  </label>
    <input type="url" class="form-control" id="exampleInputEmail1"  placeholder="Youtube Url" name="url" value="{{ old('url') }}">
    <br>
  <button type="submit" class="btn btn-primary">ADD Url</button>
</form>
     </div>


     <hr>

<h1>     Select Feathred Server
</h1>
     <div class="table-responsive">
                        <table id="example" class="display table dataTable table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Banner</th>
                                    <th>Category</th>
                                    <th>max level</th>
                                    <th>Owner name</th>
                                    <th>Votes</th>
                                    <th>Comments</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($servers as $server)
                                <tr>
                                    <td>{{ $server->title }}</td>
                                    <td> <img src="{{ asset($server->banner) }}" style="width: 100px" alt="$server->title"></td>
                                    <td>{{ $server->category }}</td>
                                    <td>{{ $server->maxlevel  }}</td>
                                    <td>{{ $server->user->username  }}</td>
                                    <td>{{ $server->vote_amount  }}</td>
                                    <td>{{ count($server->comment)  }}</td>
                                    <td>{{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $server->created_at)->diffForHumans()  }}</td>
                    
                                    <td>
                                <a href="{{ route('set_feathred_server',$server->id) }}" class="btn btn-success">Set as Feathred Server</a>
                                    
                                    
                                      </td>
                                </tr>
                          @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                     <th>Title</th>
                                    <th>Banner</th>
                                    <th>Category</th>
                                    <th>max level</th>
                                    <th>Owner name</th>
                                    <th>Votes</th>
                                    <th>Comments</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


   

        </div>     
    </div>

<hr>
  <div class="col-12 mt-3">
       <form method="post" action="{{ route('change_title') }}" enctype="multipart/form-data">
        @csrf
      
     <div class="form-group">
    <label for="exampleInputEmail1">Change Title  </label>
    <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="App Title" name="title" value="{{ old('title') }}">
    <br>
  <button type="submit" class="btn btn-primary">Change Title</button>
</form>


<hr>
<h1>   Manage Meta </h1>     
  <form method="post" action="{{ route('add_meta') }}">
        @csrf 
     <div class="form-group">
    <label>Meta code </label>
    <textarea id="" cols="30" rows="10" class="form-control" name="meta" >{{ old('meta') }}</textarea>
    <br>
  <button type="submit" class="btn btn-primary">Add Meta</button>
</form>

   <hr>
     <div class="table-responsive">
                        <table id="example" class="display table dataTable table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>Meta</th>
                                    <th>action</th>
                         
                             
                            </thead>
                            <tbody>
                                @foreach($meta as $met)
                                <tr>
                                      <form method="post" action="{{ route('update_meta',$met->id) }}">
                                            @csrf
                                    <td><textarea id="" cols="30" rows="2" class="form-control" name="meta" >{{ $met->meta }}</textarea></td>
                                
                                    <td>
                                <button type="submit" class="btn btn-success">Update</button>    
                                </form>  
                                <input type="hidden" value="{{ $met->id }}">                    
                                <a href="{{ route('delete_meta',$met->id) }}" class="btn btn-danger">Delete</a>     </td>
                                </tr>
                          @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                     <th>Meta</th>
                                    <th>action</th>
                         
                                </tr>
                            </tfoot>
                        </table>
                    </div>


   

        </div>     
    </div>

     </div>
        </div>

  
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