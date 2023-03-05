<template>
    <div class="row justify-content-center">
        <div class="col-8 d-none d-lg-block d-xl-block weather-div">
            <table class="table table-striped border mt-4">
                <thead>
                    <tr>
                        <th>Date (mm/dd/yyyy)</th>
                        <th>Temp(°F)</th>
                        <th>Description</th>
                        <th>Main</th>
                        <th>Pressure</th>
                        <th>Humidity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in weatherData">
                        <td>{{ data.date }}</td>
                        <td>{{ data.temperature }}</td>
                        <td>{{ data.description }}</td>
                        <td>{{ data.main }}</td>
                        <td>{{ data.pressure }}</td>
                        <td>{{ data.humidity }}</td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-primary" id="back-btn" @click.prevent="back">Back</button>
        </div>

        <div class="col-12 d-block d-sm-none weather-div">
            <table class="table table-striped border mt-4">
                <thead>
                    <tr>
                        <th>Date (mm/dd/yyyy)</th>
                        <th>Temp(°F)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in weatherData">
                        <td>{{ data.date }}</td>
                        <td>{{ data.temperature }}</td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-primary" id="back-btn" @click.prevent="back">Back</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            city: {
                type: String,
                required: true
            }
        },

        mounted() {
            window.axios.get(`https://openweathermap.org/data/2.5/find?q=${this.city}&appid=439d4b804bc8187953eb36d2a8c26a02&units=imperial`, {
                headers: {}
            })
            .then((response) => {
                const locationData = response.data

                for (const location of locationData.list) {
                    window.axios.get(`https://openweathermap.org/data/2.5/onecall?lat=${location.coord.lat}&lon=${location.coord.lon}&units=imperial&appid=439d4b804bc8187953eb36d2a8c26a02`)
                    .then((response) => {
                        console.log(response.data);
                        const weather = response.data.current;
                        this.weatherData.push({
                            date: this.getDate(),
                            temperature: `${weather.temp}°F`,
                            description: weather.weather[0].description,
                            main: weather.weather[0].main,
                            pressure: weather.pressure,
                            humidity: weather.humidity,
                        });
                    });
                }
            })
            .catch((error) => {
                console.log(error.response)
            })
        },

        data() {
            return {
                weatherData: []
            }
        },

        methods: {
            back() {
                window.location = '/home';
            },

            getDate() {
                const datetime = new Date();
                const months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                return months[datetime.getMonth()] + '/' + (datetime.getDate() < 10 ? `0${datetime.getDate()}` : datetime.getDate()) + '/' + datetime.getFullYear();
            },
        }
    }
</script>

<style scoped>
    #weather-div {
        text-align: center;
    }
    #back-btn {
        float: right;
    }
</style>