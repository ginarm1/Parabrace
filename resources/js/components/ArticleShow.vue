<template>
    <div class="container-fluid">
        <div class="row jumbotron">

            <div class="card-show" >
                <h1>{{article.name}}</h1>

<!--                <img v-if="article.image !== ''" :src="article.image" alt="art-img">-->


<!--                <h4 class="mt-4 mb-4">{{intro}}</h4>-->
<!--                <p>{{text}}</p>-->

<!--                <a href="./" class="more-articles-show"><button class="btn btn-dark">More articles...</button></a>-->
<!--                @if(Gate::allows('admins-only'))-->
<!--&lt;!&ndash;                <a href="./{{$article -> id}}/edit" class="edit-article"><button class="btn btn-light">Edit</button></a>&ndash;&gt;-->
<!--                Fake delete, after confirmation, real delet btn appears-->
<!--                <button class="btn btn-danger mt-3" id="btn_delete" style="height: 5vh">Delete</button>-->
<!--                Real delete-->
<!--&lt;!&ndash;                {{Form::open(['action'=>['ArticlesController@destroy',$article-> id],'method'=>'POST', 'class'=>'mt-3'])}}&ndash;&gt;-->
<!--&lt;!&ndash;                {{Form::hidden('_method','DELETE')}}&ndash;&gt;-->
<!--&lt;!&ndash;                {{Form::submit('DELETE',['class'=>'btn btn-danger','id'=>'btn_delete_real'])}}&ndash;&gt;-->
<!--                @endif-->
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            article: [],
            id: Number,
            intro: String,
            name: String,
            // image: String,
            text: Text,
            url: './articles/',

        }
    },
    mounted() {
        this.getArticle()
    },
    methods:{
        getArticle () {
            axios.get('/api/article/{id}')
                .then( (response) => {
                    this.article = response.data.data
                })
                .catch( (error) => {
                    console.log("Error from axios: " + error)
                })
        },
    },
    components: {
        urlEdit: {
        }
    }
}
</script>

<style scoped>

</style>
