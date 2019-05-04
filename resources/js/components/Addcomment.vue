<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
    </div>
</template>


<script>
    export default {
        props:['postId'],

        data() {
            return {
                message: '',
                second_comment:'',
            };
        },

        methods: {
                send(e){
                    e.preventDefault();
                    if (this.message == '') {
                        return;
                    }
                    axios.post('/add/second/comment/vue/' + this.postId,{second_comment:this.message});
                    Event.$emit('commentCreated',{second_comment:this.message});

                    this.message = '';
                }
        }

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
