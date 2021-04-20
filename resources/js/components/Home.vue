<template>
    <div id="home">
        <div class="logo-container">

        </div>
        <div class="info-holder">
            <div class="info-container" v-on:click="LoadPeople">
                <h1>People</h1>
                <h2>Just press me!</h2>
                <textarea v-model="people"></textarea>
            </div>
            <div class="info-container" v-on:click="LoadPlanets">
                <h1>Planets</h1>
                <h2>Just press me!</h2>
                <textarea v-model="planets"></textarea>
            </div>
            <div class="info-container" v-on:click="LoadSpecies">
                <h1>Species</h1>
                <h2>Just press me!</h2>
                <textarea v-model="species"></textarea>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data: function() {
            return {
                people: null,
                planets: null,
                species: null,
            };
        },
        methods: {
            LoadPeople: function (event) {
                axios.get('api/people').then(response => {
                    this.people = JSON.stringify(response.data, undefined, 4);
                });
            },
            LoadPlanets: function (event) {
                axios.get('api/planets').then(response => {
                    this.planets = JSON.stringify(response.data, undefined, 4);
                });
            },
            LoadSpecies: function (event) {
                axios.get('api/species').then(response => {
                    this.species = JSON.stringify(response.data, undefined, 4);
                });
            }
        }
    }
</script>

<style scoped>
    #home {
    }
    .info-holder {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
    .info-container {
        display:flex;
        flex-direction: column;
        padding: 20px;
        background-color: burlywood;
        border-radius: 10px;
        width: 400px;
        height: auto;
        text-align: center;
        margin: 20px;
    }
    .logo-container {
        width: 100vw;
        height: 200px;
        background-image: url('https://amsterdamdatascience.nl/wp-content/uploads/2020/01/Logo-VodafoneZiggo@2x.png?x22826');
        background-repeat: no-repeat;
        background-size: 600px;
        background-position: center top 50px;
    }
    textarea {
        border-radius: 10px;
        height: 100%;
        width: 100%;
        background-color: burlywood;
        resize: none;
    }
</style>