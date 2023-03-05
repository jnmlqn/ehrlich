<template>
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6">
            Welcome to the weather forecast werb application. Please login with your Github user to use the application and view the weather in your city.
            <p></p>
            <p></p>

            <button class="btn btn-dark" @click.prevent="login">
                Login with your Github account
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            login() {
                window.location = '/auth/github';
            }
        }
    }
</script>
