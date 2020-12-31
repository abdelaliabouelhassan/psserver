<template>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 my-1">
                    <div class="row">
                        <div class="col-sm-8">
                            <h6 class="font-weight-bold">Welcome at Metin2-Toplist.com!</h6>
                            <p>Largest private server list!</p>
                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="input-group">
                                <select name="" id="" class="form-control d-inline mx-2">
                                    <option value="1">All Servers</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-dark">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <router-view></router-view>

                </div>
                <right></right>
            </div>
        </div>
    </section>
</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>
