<template>
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6" id="home-div">
            <p>
                {{ name }}
            </p>
            
            <p>
                <a :href="url" target="_blank">{{ url }}</a>
            </p>

            <form>
                <input type="text" class="form-control" placeholder="Enter city name" v-model="city">
                <span class="text-danger" v-if="displayError && city == ''">Please enter a valid City name</span>

                <p></p>

                <button type="submit" class="btn btn-success" @click.prevent="displayWeather">
                    Display weather
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                type: String,
                required: true
            }
        },

        data() {
            const user = JSON.parse(this.user);

            return {
                name: user.name,
                email: user.email,
                url: user.github_url,
                city: '',
                displayError: false,
            }
        },

        methods: {
            displayWeather() {
                this.displayError = true;

                if (this.city !== '') {
                    window.location = `weather?city=${this.city}`;
                }
            }
        }
    }
</script>

<style scoped>
    #home-div {
        text-align: center;
    }
</style>