<template>
    <div class="card">
        <div class="card-body">
            <div v-if="show">
                <h3>Interações</h3>
                <interactions-by-type :data="interactionByType"></interactions-by-type>
                <interactions-by-time :data="interactionByTime"></interactions-by-time>
                <views-by-section :data="viewsBySection"></views-by-section>
                <h3>Questões</h3>
                <question-visualization :problems="problemData"></question-visualization>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        props: ['id'],
        data() {
            return {
                interactionByType: null,
                interactionByTime: null,
                problemData: null,
                show: false
            }
        },
        created() {
            this.$http.get('/api/videos/' + this.id + '/visualization').then(({ data }) => {
                this.interactionByType = data.interactionsByType;
                this.interactionByTime = data.interactionsByTime;
                this.viewsBySection = data.viewsBySection;
                this.problemData = data.problemsData;
                this.show = true;
            });
        }
    }
</script>

<style scoped>

</style>