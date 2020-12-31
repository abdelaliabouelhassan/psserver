<template>
    <div class="text-center py-2">
        <h2 class="font-weight-bold">Welcome back!</h2>
        <p>Don't have an account?<a href="/app_register" class="ml-2 text-success text-decoration-none" data-lity>Create Account</a></p>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
              <div  class="mt-4">
                    <input type="text" class="form-control my-3 rounded" placeholder="Username">
                    <input type="password" class="form-control my-3 rounded" placeholder="Password">
                    <div class="text-left">
                        <input type="checkbox"><label for="check" class="ml-2">Remember Me</label>
                    </div>
                    <input type="submit" @click="login" class="btn btn-dark btn-block rounded" value="Sign In">
             </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</template>

<script>
    export default {
        methods:{
            login(){
                alert('hello works')
            }
        }
    }
</script>

<style scoped>

</style>
