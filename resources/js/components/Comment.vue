<template>
    <div>
    <div v-for="comment in comments" :key="comment.id">
        {{comment.second_comment}}<br>
       By: {{comment.name}}<br>
        Created at: {{comment.created_at}}

<br><br>
    </div>

    </div>
</template>

<script>

    export default {
        props:['postId'],

       data(){
           return {
               comments: [],
           }
       },
        created(){

            axios.get('/second/comment/vue/get/' + this.postId).then(response => {
                this.comments = response.data;
            });

            Echo.channel(`comments.${this.postId}`)
                .listen('NewComment', (e) => {
                 axios.get('/second/comment/vue/get/' + this.postId).then(response => {
                 this.comments = response.data; });

            Event.$on('commentCreated',(second_comment) =>{

                //this.comments.unshift(second_comment);
                //axios.get('/second/comment/vue/get/' + this.postId).then(response => {
                //this.comments = response.data; });

                    });
            });


        },
    }
</script>

