<template>
    <div>
        <div v-for="(task, index) in tasks" :key="index">
            <task-component :title="task.title">{{ task.body }}</task-component>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: [
                {"title": "Example Component 1", "body": "I'm an example component 1"},
                {"title": "Example Component 2", "body": "I'm an example component 2"},
                {"title": "Example Component 3", "body": "I'm an example component 3"},
                {"title": "Example Component 4", "body": "I'm an example component 4"},
                {"title": "Example Component 5", "body": "I'm an example component 5"},
            ]
        }
    },
}
</script>
