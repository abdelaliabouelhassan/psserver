<template>
        <div>
              <div class="card serverCard p-4 mb-3 mt-5">
                <img src="/img/flags.png" class="img-fluid flag-img" alt="international server"  v-if="Server.is_international">
              <div class="row">
                <div class="col-sm-5">
                  <div class="row">
                    <div class="col-2">
                      <a href="">
                        <img src="/img/avatar.png" alt="">
                      </a>
                    </div>
                    <div class="col-10 m-auto">
                      <div class="row">
                        <div class="col-3">
                          <h5 class="d-inline-block px-3 py-2 rounded text-white">1</h5>
                        </div>
                        <div class="col-9">
                            <p class="hard text-danger bg-pink rounded" v-if="Server.difficulty == 'Hard'" style="cursor:pointer"  @click="goDetails(Server.slug)">Hard</p>
                                           <p class="hard text-success bg-green rounded"  v-if="Server.difficulty == 'Easy'"  >
                                                Easy
                                            </p>
                                             <p class="hard text-orange bg-orange rounded"  v-if="Server.difficulty == 'Medium'" >
                                                Medium
                                            </p>
                          <h5 class="font-weight-bold">{{ url }}</h5>
                        </div>
                      </div>
                      <div class="row"></div>
                      <p class="zuko-text">{{ Server.title }}</p>
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
                  <img :src="'/'+ Server.banner"  onerror="this.src='/img/550120.jpg'" class="img-fluid rounded" alt="">
                </div>
              </div>
            </div>


<!--  -->

     <div class="card my-3 p-3">
                <button class="btn btn-dark bg-dark btn-block rounded font-weight-normal">Zuko2 - Server details</button>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Server Type:</p>
                            </div>
                            <div class="col-7">
                                          <p class="hard text-danger bg-pink rounded" v-if="Server.difficulty == 'Hard'" style="cursor:pointer"  @click="goDetails(Server.slug)">Hard</p>
                                           <p class="hard text-success bg-green rounded"  v-if="Server.difficulty == 'Easy'"  >
                                                Easy
                                            </p>
                                             <p class="hard text-orange bg-orange rounded"  v-if="Server.difficulty == 'Medium'" >
                                                Medium
                                            </p>
                                   <p class="d-inline text-muted ml-2">{{Server.category}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Max LvL:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-muted ml-2">{{Server.maxlevel}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Rates:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-muted ml-2">{{Server.rates}}%</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Votes:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-success ml-2">22 545</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Website:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-muted ml-2"><a :href="Server.url" target="_blank" class="text-muted">{{url}}</a> <i class="fa fa-external-link-alt"></i></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Comments:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-muted ml-2">54</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Clicks:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-muted ml-2">988</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 m-auto">
                                <p>Server start:</p>
                            </div>
                            <div class="col-7">
                                   <p class="d-inline text-muted ml-2">{{Server.created_at}}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="" class="text-dark text-decoration-none font-weight-bold">Rate Server</a>
                </div>
            </div>



            <!--  -->


                <h3 class="my-5 font-weight-bold">Feedback & Comments: <span>67</span></h3>

            <div class="card my-3">
                <div class="row p-3">
                    <div class="col-1 p-0 m-auto">
                        <img src="/img/avatar.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-11 p-0 pl-2">
                        <div class="row">
                            <div class="col-3">
                                <h6 class="font-14 m-0">StrongWarrior69</h6>
                            </div>
                            <div class="col-3">
                                <p>January 25, 18:33 pm</p>
                            </div>
                            <div class="col-2">
                                <i class="fa fa-heart text-danger font-14"></i><span class="font-14 ml-1">34 likes</span>
                            </div>
                            <div class="col-4 text-right pr-3">
                                <button class="btn btn-success p-0 px-2 mr-2 rounded" style="font-size: 10px;">REPLY</button>
                            </div>
                        </div>
                        <p class="font-14">
                            Grursus mal suada faci lisis Lorem ipsum dolarorit more a ametion consectetur is elit. Vesti at bulum nec odio aea the dumm ipsumm. Dolocons rsus mal suada and fad olorit to the consectetur elit.
                        </p>
                    </div>
                </div>
            </div>


            <!--  -->


            
            <div class="card my-3">
                <div class="row p-3">
                    <div class="col-1 p-0 m-auto">
                        <img src="/img/avatar.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-11 p-0 pl-2">
                        <div class="row">
                            <div class="col-3">
                                <h6 class="font-14 m-0">StrongWarrior69</h6>
                            </div>
                            <div class="col-3">
                                <p>January 25, 18:33 pm</p>
                            </div>
                            <div class="col-2">
                                <i class="fa fa-heart text-muted font-14"></i><span class="font-14 ml-1">0 likes</span>
                            </div>
                            <div class="col-4 text-right pr-3">
                                <button class="btn btn-dark bg-dark p-0 px-2 mr-2 rounded" style="font-size: 10px;">REPLY</button>
                            </div>
                        </div>
                        <p class="font-14">
                            Grursus mal suada faci lisis Lorem ipsum dolarorit more a ametion consectetur is elit. Vesti at bulum nec odio aea the dumm ipsumm. Dolocons rsus mal suada and fad olorit to the consectetur elit.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card my-3 px-4 py-5 bg-white">
                <h6 class="font-weight-bold">Add Comment</h6>
                <form action="" class="mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control rounded my-2" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control rounded my-2" placeholder="E-mail address">
                        </div>
                    </div>
                    <textarea name="" id="" cols="30" rows="5" class="form-control mt-2 rounded" placeholder="I think"></textarea>
                    <input type="checkbox"><label for="check" class="ml-2 my-2 terms"><span class="">I have read and agree to the</span> <a href="" class="text-success font-16">Terms of Use</a></label>
                    <input type="submit" class="btn btn-dark d-block bg-dark mt-3" value="ADD A COMMENT">
                </form>
            </div>


        </div>
</template>

<script>
export default {
        data(){
            return{
                Server:[],
                url:''
            }
        },
        methods:{
            getServer(){
          this.axios
        .get("/api/GetServer/" + this.$route.params.slug)
        .then((response) => { 
                this.Server = response.data.data[0]
                this.url = this.Server.url.replace(/[http:// https://]/g, "")
               console.log(response)
         
        })
        .catch((errors) => { 

        });
            }
        },
        created(){
           this.getServer();
            
        }
};
</script>

<style scoped>
</style>
