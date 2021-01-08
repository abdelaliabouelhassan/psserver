<template>
  <section class="py-4" v-if="banners.banner1 || banners.banner2">
    <div class="container" style="max-width: 68% !important">
      <div class="row">
        <div class="col-md-6 m-auto px-1 py-1" v-if="banners.banner1">
          <div class="bg-light text-center py-4" style="height: 100px;background-size: cover;" :style="{ backgroundImage: 'url(' + banners.banner1  + ')' }">
          
           
          </div>
        </div>
        <div class="col-md-6 m-auto px-1 py-1" v-if="banners.banner2" >
          <div class="bg-light text-center py-4" style="height: 100px;background-size: cover;" :style="{ backgroundImage: 'url(' + banners.banner2  + ')' }">     
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {

data(){
  return{
    banners:[]
  }
},
created(){
   this.axios
        .get("/api/GetBanners")
        .then((response) => {
          this.banners = response.data;
          console.log(this.banners)
        })
        .catch((errors) => {});
}

};
</script>

<style scoped>
</style>
