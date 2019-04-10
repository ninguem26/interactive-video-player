<template>
    <div class="card" style="margin-top: 20px">
        <div class="card-body">
            <video-player-component :id="id"></video-player-component>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VideoPage",
        props: ["id"]
    }
</script>

<style scoped>

</style>