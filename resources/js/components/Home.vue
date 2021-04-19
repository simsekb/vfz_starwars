<template>
    <div id="home">
        <div class="info-container">
            <span>Info goes here</span>
            <span>Info goes here</span>
            <span>Info goes here</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "home"
    }
</script>

<style scoped>
    #home {
        background-color: brown;
        width: 100vw;
        height: 100vh;
    }
    .info-container {
        display:flex;
        flex-direction: column;
        padding: 20px;
    }
</style>