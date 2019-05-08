<template>
    <div>

        <div class="composer">
            <textarea v-model="post" placeholder="Say Something..."></textarea>
        </div>
        <button class="btn btn-primary" type="submit" @click="send">Post</button>

       <div v-for="comment in comments" :key="comment.id">

           <a :href="'/showing/comment/post/' + comment.id">

           {{comment.comment}}<br>

           <div v-for="secondComment in comment.second_comment.slice(0,2)">
               {{secondComment.second_comment}}<br>
           </div>


               <button type="button" class="btn btn-primary btn-sm">
               Comments
                   <span class="badge badge-danger">{{comment.second_comment.length}}</span>
               </button>


                <br>

           <strong v-if="comment.second_comment.length >2">There are more Comments</strong>


           <br><br><br>

           </a>
       </div>



    </div>
</template>

<script>

    export default {


        props:['groupId'],

        data(){
            return {
               comments:[],
                post:[],
            }
        },
        created(){

            axios.get('/discussion/posts/vue/get/' + this.groupId).then(response => {
                this.comments = response.data;
            });

            Echo.channel(`post.${this.groupId}`)
            .listen('NewPost', (e) => {
            axios.get('/discussion/posts/vue/get/' + this.groupId).then(response => {
            this.comments = response.data;
            });
                });

            Echo.channel(`comments.${this.groupId}`)
            .listen('NewComment', (e) => {
            axios.get('/discussion/posts/vue/get/' + this.groupId).then(response => {
            this.comments = response.data;
                    });
                });

        },

        methods:{
            send(e){
                e.preventDefault();
                if (this.post == '') {
                    return;
                }
                axios.post('/add/comment/vue/' + this.groupId,{comment:this.post});
                this.post = '';
                },
            },


    }
</script>

<style lang="scss" scoped>
    .composer textarea {
        width: 96%;
        margin: 10px;
        resize: none;
        border-radius: 3px;
        border: 1px solid lightgray;
        padding: 6px;
    }
</style>