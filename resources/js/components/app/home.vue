<template>
            <div>
                 
                <div class="card serverCard p-4 mb-3 mt-5" v-for="(Server,index) in Servers"  >
                    <img src="/img/flags.png" class="img-fluid flag-img" alt="">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-2">
                                    <a href="">
                                        <img src="/img/down.png" alt="">
                                    </a>
                                </div>
                                <div class="col-10 m-auto">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5 class="d-inline-block px-3 py-2 rounded text-white">{{index + 1}}</h5>
                                        </div>
                                        <div class="col-9">
                                            <p class="hard text-danger bg-pink rounded">
                                                Hard
                                            </p>
                                            <h5 class="font-weight-bold">{{Server.url}}</h5>
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <p class="zuko-text">{{Server.title}}</p>
                                    <p class="mt-4">
                        <span>
                          <img src="/img/like.png" class="img-fluid" alt="">
                        </span>
                                        <span class="text-success">22545</span>
                                        <span class="mx-3 text-secondary">|</span>
                                        <span>
                          <i class="fa fa-external-link-alt text-secondary font-13"></i>
                        </span>
                                        <span class="text-secondary font-13">988</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 m-auto">
                            <img :src="Server.banner" onerror="this.src='/img/550120.jpg'" class="img-fluid rounded" :alt="Server.title">
                        </div>
                    </div>
                </div>


                <div class="card serverCard p-4 my-3">
                    <img src="/img/flags.png" class="img-fluid flag-img" alt="">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-2">
                                    <a href="">
                                        <img src="/img/up.png" alt="">
                                    </a>
                                </div>
                                <div class="col-10 m-auto">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5 class="d-inline-block px-3 py-2 rounded text-white">2</h5>
                                        </div>
                                        <div class="col-9">
                                            <p class="hard text-success bg-green rounded">
                                                Easy
                                            </p>
                                            <h5 class="font-weight-bold">Aeldra2.to</h5>
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <p class="zuko-text">Zuko2.com - Comeback - 14.08.2020 Big International Server</p>
                                    <p class="mt-4">
                        <span>
                          <img src="/img/like.png" class="img-fluid" alt="">
                        </span>
                                        <span class="text-success">22545</span>
                                        <span class="mx-3 text-secondary">|</span>
                                        <span>
                          <i class="fa fa-external-link-alt text-secondary font-13"></i>
                        </span>
                                        <span class="text-secondary font-13">988</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 m-auto">
                            <img src="/img/550120.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>


                <div class="card serverCard p-4 my-3">
                    <img src="/img/flags.png" class="img-fluid flag-img" alt="">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-2">
                                    <a href="">
                                        <img src="/img/up.png" alt="">
                                    </a>
                                </div>
                                <div class="col-10 m-auto">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5 class="d-inline-block px-3 py-2 rounded text-white">5</h5>
                                        </div>
                                        <div class="col-9">
                                            <p class="hard text-orange bg-orange rounded">
                                                Medium
                                            </p>
                                            <h5 class="font-weight-bold">Zuko2.com</h5>
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <p class="zuko-text">Zuko2.com - Comeback - 14.08.2020 Big International Server</p>
                                    <p class="mt-4">
                        <span>
                          <img src="/img/like.png" class="img-fluid" alt="">
                        </span>
                                        <span class="text-success">22545</span>
                                        <span class="mx-3 text-secondary">|</span>
                                        <span>
                          <i class="fa fa-external-link-alt text-secondary font-13"></i>
                        </span>
                                        <span class="text-secondary font-13">988</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 m-auto">
                            <img src="/img/550120.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>




                <div class="text-center">
                    <a href="" class="text-decoration-none m-auto">
                        <img src="/img/2x.png" alt="">
                    </a>
                    <a href="" class="text-dark m-auto">
                        <i class="fa fa-angle-left mx-1"></i>
                    </a>
                    <a href="" class="btn btn-outline-dark mx-1">1</a>
                    <a href="" class="btn btn-outline-dark mx-1">2</a>
                    <a href="" class="btn btn-dark mx-1">3</a>
                    <a href="" class="btn btn-outline-dark mx-1">4</a>
                    <a href="" class="text-dark m-auto">
                        <i class="fa fa-angle-right mx-1"></i>
                    </a>
                    <a href="" class="text-decoration-none m-auto">
                        <img src="/img/2x-r.png" alt="">
                    </a>
                </div>
            </div>
</template>

<script>
    export default {
        data(){
            return{
                Servers:[],
            }
        },
        methods:{
            GetServers(){
        this.axios
        .get("/api/GetServers", this.form)
        .then((response) => { 
            this.Servers = response.data.data
        })
        .catch((errors) => {
            
        });
       },
     },
     created(){
         this.GetServers();
     }
        
    }
</script>

<style scoped>

</style>
