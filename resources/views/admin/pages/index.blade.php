@extends ('admin.dashboard')
@section('section')
<div class="container-fluid site-width">
  

    <!-- START: Card Data-->
    <div class="row">
        
           <div class="col-12  col-md-6 col-lg-3 mt-3">
            <div class="card border-bottom-0">                            
                <div class="card-content border-bottom border-primary border-w-5">
                    <div class="card-body p-4">                                   
                        <div class="d-flex">                                        
                            <div class="circle-50 outline-badge-primary"> <span class="cf card-liner-icon cf-ltc mt-2"></span></div>
                            <div class="media-body align-self-center pl-3">
                                <span class="mb-0 h6 font-w-600">new users (today)</span><br>
                                <p class="mb-0 font-w-500 h6">{{ $user_count }}</p>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-12  col-md-6 col-lg-3 mt-3">
            <div class="card border-bottom-0">                            
                <div class="card-content border-bottom border-warning border-w-5">
                    <div class="card-body p-4">                                   
                        <div class="d-flex">                                        
                            <div class="circle-50 outline-badge-warning"> <span class="cf card-liner-icon cf-xlm mt-2"></span></div>
                            <div class="media-body align-self-center pl-3">
                                <span class="mb-0 h6 font-w-600">new servers (today)</span><br>
                                <p class="mb-0 font-w-500 h6">{{ $server_count }}</p>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-12  col-md-6 col-lg-3 mt-3">
            <div class="card border-bottom-0">                            
                <div class="card-content border-bottom border-success border-w-5">
                    <div class="card-body p-4">                                   
                        <div class="d-flex">                                        
                            <div class="circle-50 outline-badge-success"> <span class="cf card-liner-icon cf-link mt-2"></span></div>
                            <div class="media-body align-self-center pl-3">
                                <span class="mb-0 h6 font-w-600">new users (this month)</span><br>
                                <p class="mb-0 font-w-500 h6">{{ $user_count_last_30_days }}</p>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-12  col-md-6 col-lg-3 mt-3">
            <div class="card border-bottom-0">                            
                <div class="card-content border-bottom border-info border-w-5">
                    <div class="card-body p-4">                                   
                        <div class="d-flex">                                        
                            <div class="circle-50 outline-badge-info"> <span class="cf card-liner-icon cf-xmr mt-2"></span></div>
                            <div class="media-body align-self-center pl-3">
                                <span class="mb-0 h6 font-w-600">new servers (this month)</span><br>
                                <p class="mb-0 font-w-500 h6">{{ $server_countt_last_30_days }}</p>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>



    </div>
    <!-- END: Card DATA-->
</div>
@stop
