<template>
    <!--About paracord-->
    <div class="container-fluid">
        <div class="row jumbotron">
<!--            @if(Gate::allows('admins-only'))-->

            <div class="row">
                <a :href="url"><button class="btn btn-primary">Create article</button></a>
            </div>
<!--            @endif-->

<!--        <transtion-group name="list">-->
                <div class="card-article card"
                     @mouseenter="article.show = !article.show" @mouseleave="article.show = !article.show"
                     v-for=" article in articles">
                    <h2>{{article.name}}</h2>
                    <h1>{{color}}</h1>
<!--                    storage/img/articles/-->
                    <img class="card-article-img" :src="article.image"
                         v-if="!article.show && article.image !== 'storage/img/articles/'" width="400px">
                    <p v-if="article.show">{{article.intro}}</p>
                    <a v-if="article.show" :href="article.readMore"><button class="btn btn-light">Read More ></button></a>
                </div>
<!--        </transtion-group>-->


            <!--Blade format-->
<!--            @forelse($articles as $article)-->

<!--            <div class="card-article card">-->
<!--                <h2>{{$article -> name}}</h2>-->
<!--                @if($article -> image != null)-->
<!--                <img class="card-article-img" src="storage/img/articles/{{$article ->image}}" alt="article-img" width="400px">-->
<!--                @endif-->
<!--                <p>{{$article -> intro}}</p>-->

<!--                @foreach($article -> partners as $partner)-->
<!--                <p>Powered by: <a href="http://{{$partner->url}}" class="pl-2" style="color: #daffff;text-decoration: none">{{$partner->name}}</a></p>-->
<!--                @endforeach-->

<!--                <a href="./articles/{{$article -> id}}"><button class="btn btn-light">Read More ></button></a>-->
<!--                @if(Gate::allows('admins-only'))-->
<!--                <a href="./articles/{{$article -> id}}/edit"><button class="btn btn-secondary mt-3">Edit</button></a>-->
<!--                @endif-->
<!--            </div>-->
<!--            @empty-->
<!--            <p>No articles found</p>-->
<!--            @endforelse-->

        </div>
    </div>
</template>

<script>
export default  {
    data () {
        return {
            articles: [],
            id: Number,
            name: String,
            intro: String,
            text: Text,
            show: true,
            url: './articles/create',
            readMore: String,
            colors: ['red','green','blue'],
        //    Partners
            partners: [],
            partner: {
                id: '',
                name: '',
                url: '',
            }
        }
    },
    // Instantly called
    mounted () {
        this.getArticles()
    },
    methods: {
        getArticles () {
            axios.get('/api/articles')
            .then( (response) => {
                this.articles = response.data.data
            })
            .catch( (error) => {
                console.log("Error from axios: " + error)
            })
        },
        getPartners () {
            
        }
        // randomIndex () {
        //     return Math.floor(Math.random() * this.colors.length)
        // },
        // randomColor(){
        //     return this.colors[this.randomColor]
        // },
    },
    computed: {

    }


}
</script>

<style scoped>
.card-article {
    transition: opacity 0.7s ease;
    opacity: 0.8;
}
.card-article:hover{
    color: whitesmoke;
    background: #1b4b72;
    /*height: 70vh;*/
    opacity: 1;
}

.list-enter-active,
.list-leave-active {
    transition: opacity 0.5s ease;
}

.card-article-enter-from,
.card-article-leave-to {
    opacity: 0;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
}

</style>
