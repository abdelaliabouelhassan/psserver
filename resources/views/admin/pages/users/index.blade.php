@extends ('admin.dashboard')
@section('section')
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">All Users</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    
                    <li class="breadcrumb-item"><a href="{{ route('users.create') }}" class="btn btn-info">Create New User</a></li>
              
                </ol>
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
                    <h4 class="card-title">Data Tabel</h4> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table dataTable table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>ip</th>
                                    <th>is banned</th>
                                    <th>Start date</th>
                                    <th>Servers count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                  <td>{{ $user->ip }}</td>
                                    <td>{{ $user->is_banned ? 'Yes' : 'No' }}</td>
                                    <td>{{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->diffForHumans()  }}</td>
                                    <td>{{ count($user->server) }}</td>
                                    <td>
                                        
                                       <form action="{{ route('users.destroy',$user->id) }}" method="POST" style="display: inline-block">
                                           @csrf
                                           @method('DELETE')
                                         <button class="btn btn-danger" onclick="return confirm('Ae you sure  you want delete this user ?')">Delete</button>       
                                      </form>                         
                                       <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary" style="display: inline-block">Edit</a><a href="{{  route('ban',$user->id)  }}" onclick="return confirm('Ae you sure  you want {{ $user->is_banned ? 'UnBan' : 'Ban' }} this user ?')" style="display: inline-block" class="btn btn-{{ $user->is_banned ? 'success' : 'danger' }}">{{ $user->is_banned ? 'UnBan' : 'Ban' }}</a></td>
                                </tr>
                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>ip</th>
                                    <th>is banned</th>
                                    <th>Start date</th>
                                    <th>Servers count</th>
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