@extends ('admin.dashboard')
@section('section')
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Server</h4></div>


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
                

        @if($errors->any())
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    @endif
                <div class="card-header  justify-content-between align-items-center">                               
                    <h4 class="card-title">Server Details</h4> 
                </div>
                <div class="card-body">
                    <div class="card" style="width: 100rem;">
                    <img class="card-img-top" src="{{ asset($server->banner) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"> <span style="color: gray">Title :</span>{{ $server->title }}</h5>
                        <p class="card-text"> <span style="color: gray">description :</span> {!!  $server->description !!}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span style="color: gray">category : {{ $server->category }}</span></li>
                        <li class="list-group-item"><span style="color: gray">language : {{ $server->language }}</span></li>
                        <li class="list-group-item"><span style="color: gray">max level : {{ $server->maxlevel }}</span></li>
                        <li class="list-group-item"><span style="color: gray">youtube url : <a href="{{ $server->youtube_id }}" >{{ $server->youtube_id }}</a> </span></li>
                        <li class="list-group-item"><span style="color: gray">rates : {{ $server->rates }} %</span></li>
                        <li class="list-group-item"><span style="color: gray">website screen (screenshot) :  @if($server->screen) <img src="{{ $server->screen }}" style="width: 100px" alt="{{ $server->screen }}"> @else <b>no screen shot</b>   @endif</span></li>
                        <li class="list-group-item"><span style="color: gray">Owner name : {{ $server->user->username }}</span></li>
                        <li class="list-group-item"><span style="color: gray">difficulty : {{ $server->difficulty }}</span></li>
                        <li class="list-group-item"><span style="color: gray">Votes : {{ $server->vote_amount }}</span></li>
                        <li class="list-group-item"><span style="color: gray">has votes in the last 12 hours ?: {{ $server->has_votes_in_the_last_12 ? 'Yes' : 'No' }}</span></li>
                        <li class="list-group-item"><span style="color: gray">admin active ?: {{ $server->admin_active ? 'Yes' : 'No' }} </span></li>
                        <li class="list-group-item"><span style="color: gray">server owner active ?: {{ $server->server_owner_active ? 'Yes' : 'No' }}</span></li>
                        <li class="list-group-item"><span style="color: gray">has Back link ?: {{ $server->hasBacklink ? 'Yes' : 'No' }}</span></li>
                        <li class="list-group-item"><span style="color: gray">views : {{ $server->viewd }}</span></li>
                        <li class="list-group-item"><span style="color: gray">Is Approved ? : {{ $server->status ? 'Yes' : 'No' }}</span></li>
                           <li class="list-group-item"><span style="color: gray">Is Comment Active  ? : {{ $server->comment_active ? 'Yes' : 'No' }}</span></li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ $server->url }}" class="card-link">Go To WebSite link : ({{ $server->url  }})</a>
                       
                    </div>
                    </div>
                    <br>
                    <div class="card-body">
                            <h4>{{ $server->admin_active ? 'deactivate' : 'Active' }} The Server</h4>
                        <form action="{{ route('active_server_deactivate') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $server->id }}" name="id">
                            @if($server->admin_active)
                           <textarea name="description" id="" class="form-control" cols="30" rows="10" placeholder="Tell the server owner why..."></textarea>
                           @endif
                        <br>
                        <button type="submit"  class="btn btn-{{ $server->admin_active ? 'danger' : 'success' }}">{{ $server->admin_active ? 'deactivate' : 'Active' }}</button>
                        </form>
                     

                    </div>
                    <br>

                      <div class="card-body">
                            <h4>{{ $server->comment_active ? 'deactivate' : 'Active' }} The Server Comment</h4>
                        <form action="{{ route('active_comment_deactivate') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $server->id }}" name="id">
                        <br>
                        <button type="submit"  class="btn btn-{{ $server->comment_active ? 'danger' : 'success' }}">{{ $server->comment_active ? 'deactivate' : 'Active' }}</button>
                        </form>
                     

                    </div>

                       
                  
                </div>
            </div> 

        </div>                  
    </div>
                  
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header  justify-content-between align-items-center">                               
                    <h4 class="card-title">Servers Comments</h4> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table dataTable table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>User name</th>
                                    <th>Comment</th>  
                                     <th>Created at</th>  
                                     <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($server->comment as $comment)
                                <tr>
                                    <td>{{ $comment->user->username }}</td>
                                    <td>{!! $comment->comment !!}</td>
                                    <td>{{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans()  }}</td>
                 
                                    <td>                              
                                       <form action="{{ route('delete_Comment') }}" method="POST" style="display: inline-block">
                                           @csrf
                                           <input type="hidden" name="id" value="{{ $comment->id }}">
                                           <button class="btn btn-danger" type="submit"  onclick="return confirm('Ae you sure  you want delete this Comment ?')">Delete</button>       
                                      </form>                         
                                </tr>
                             @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th>User name</th>
                                    <th>Comment</th>  
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