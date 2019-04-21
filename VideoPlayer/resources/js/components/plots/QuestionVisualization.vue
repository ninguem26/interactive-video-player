<template>
    <div>
        <div v-for="problem in problems" class="card">
            <div class="card-body">
                <h5 class="card-title">{{ problem.problem.question }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li v-for="alternative in JSON.parse(problem.problem.alternatives)" class="list-group-item">
                    {{ alternative.id }}. {{ alternative.text }}
                    <span v-if="alternative.id == JSON.parse(problem.problem.answers)" class="badge badge-success">
                        Correta
                    </span>
                </li>
            </ul>
            <div class="card-body">
                <div v-if="JSON.parse(problem.problem.alternatives).length >= JSON.parse(problem.problem.answers)" class="row">
                    <div class="col-md-6">
                        <correctly-done :data="problem"></correctly-done>
                    </div>
                    <div class="col-md-6">
                        <alternatives-selected :data="problem"></alternatives-selected>
                    </div>
                </div>
                <div v-else>
                    <div>
                        <alternatives-selected :data="problem"></alternatives-selected>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "QuestionVisualization",
        props: ['problems'],
        mounted() {
            console.log(JSON.parse(this.problems[0].problem.answers) - 1);
        }
    }
</script>

<style scoped>

</style>