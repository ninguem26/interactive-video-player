<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><a :href="'/videos/' + id">{{ title }}</a></h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ durationString }}</h6>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['id', 'title', 'durationString'],
    }
</script>
