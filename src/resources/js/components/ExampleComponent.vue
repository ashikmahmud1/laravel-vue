<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts">
                <td>{{post.title}}</td>
                <td>{{post.post_text}}</td>
                <td>{{post.created_at}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style lang="scss">
</style>

<script>
export default {
    data() {
        return {
            posts: []
        }
    },
    mounted() {
        console.log('Component mounted.')
        // call the api here
        axios.get('/api/posts').then(response => {
            this.posts = response.data;
            console.log(this.posts);
        })
        axios.get('/api/user').then(response => {
            console.log(response.data)
        })
    },methods: {

    }
}
</script>
