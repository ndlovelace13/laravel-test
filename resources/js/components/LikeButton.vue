<template>
    <div>
        <button class="btn btn-danger" @click="likePost" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'likes'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.likes,
            };
        },

        methods: {
            likePost() {
                axios.post('/like/' + this.postId)
                    .then(response => {
                        this.status = ! this.status;
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        if (error.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unlike' : 'Like';
            }
        }
    }
</script>
