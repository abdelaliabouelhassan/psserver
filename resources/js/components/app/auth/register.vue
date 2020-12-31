<template>
    <div class="text-center py-2">
        <h2 class="font-weight-bold">Create Account</h2>
        <p>Already have an account?<a href="/app_login" class="ml-2 text-danger text-decoration-none" data-lity>Sign In</a></p>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">

                  <div  class="mt-4">
                    <input type="text" class="form-control my-3 rounded" placeholder="Username">
                    <input type="email" class="form-control my-3 rounded" placeholder="E-mail Address">
                    <input type="password" class="form-control my-3 rounded" placeholder="Password">
                    <input type="password" class="form-control my-3 rounded" placeholder="Confirm Password">
                    <div class="text-left">
                        <input type="checkbox"><label for="check" class="ml-2"><span>I have read and agree to the</span> <a href="javascript:void(0)" class="text-success font-16">Terms of Use</a></label>
                    </div>
                    <input type="submit" @click="register" class="btn btn-dark btn-block rounded" value="Sign In">
                    </div>

            </div>
            <div class="col-2"></div>
        </div>
    </div>
</template>

<script>
    export default {
        methods:{
            register(){
                alert('hello world');
            }
        }
    }
</script>

<style scoped>

</style>
