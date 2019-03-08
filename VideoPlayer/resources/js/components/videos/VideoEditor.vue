<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <content-card
                    v-for="content in contents"
                    v-bind="content"
                    :key="content.id"
                ></content-card>
                <div class="col-md-6">
                    <button @click="addContentCard" class="btn btn-outline-primary btn-block">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    function Content(id) {
        this.id = id;
    }

    export default {
        props: ['id', 'title', 'url', 'format', 'duration'],
        data() {
            return {
                contents: [],
                count: 1
            }
        },
        methods: {
            addContentCard() {
                this.contents.push(new Content(this.count++));
            }
        }
    }
</script>
