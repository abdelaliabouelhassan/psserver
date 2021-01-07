@extends ('admin.dashboard')
@section('section')
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">All Active Servers</h4></div>


            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

     @if(session()->has('good'))
                  <div class="alert alert-success" role="alert">
                        {{ session('good') }}
                    </div>
                @endif
                  
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header  justify-content-between align-items-center">                               
                    <h4 class="card-title">Servers Tabel</h4> 
                </div>
                <div class="card-body">
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
                                        
                                       <form action="{{ route('servers.destroy',$server->id) }}" method="POST" style="display: inline-block">
                                           @csrf
                                           @method('DELETE')
                                         <button class="btn btn-danger" onclick="return confirm('Ae you sure  you want delete this Server ?')">Delete</button>       
                                      </form>                         
                                       <a href="{{ route('servers.show',$server->id) }}" class="btn btn-primary" style="display: inline-block">Details</a>
                                        @if(!$server->admin_active)
                                         <form action="{{ route('active_server_deactivate') }}" method="post">
                                          @csrf
                                          <input type="hidden" value="{{ $server->id }}" name="id">
                                         <button class="btn btn-success" >Active</button>       
                                      </form> 
                                      @endif
                                       @if(!$server->status)
                                         <form action="{{ route('approve_server') }}" method="post">
                                          @csrf
                                          <input type="hidden" value="{{ $server->id }}" name="id">
                                         <button class="btn btn-success" >Approve</button>       
                                      </form> 
                                      @endif
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