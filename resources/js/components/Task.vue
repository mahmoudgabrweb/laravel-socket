<template>
    <div class="container" v-show="isVisible">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ title }}
                        <a class="badge badge-danger" href="javascript:;" @click="removeCard">x</a>
                    </div>

                    <div class="card-body">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["title", "body"],
        data() {
            return {
                "isVisible": true
            }
        },
        methods: {
            removeCard() {
                this.isVisible = false;
            }
        },
    }
</script>
