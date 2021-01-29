<template>
    <div class="items-container container">
            <div v-for="item in items" class="bracelets py-4 h-25">
                <img class="card-item-img" :src="item.image" width="400px"  alt="item-photo">
                <h5 class="p-3" style="color: black">{{ item.name }}</h5>
                <div class="quantity-container">
                    <button class="btn btn-light">-</button>
                    <input class="h-25" type="number" min="0" max="20" :value="item.quantity">
                    <button class="btn btn-light" @click="addOneItem(item)">+</button>
                </div>

                <p style="display: inline">€ {{item.cost}}</p>
                <div>
                    <button @click="deleteArticle(item.id)" id="delete" class="btn btn-danger">Delete item</button>
                </div>
            </div>
            <nav aria-label="Cart pages navigation">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.prev_page_url)">Previous</a></li>

                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>
            <h3 v-if="items.length === 0">Cart is empty</h3>
    </div>
</template>

<script>
export default {
    data () {
        return {
            items: [],
            item: {
                id: Number,
                image: String,
                name: String,
                quantity: Number,
                cost: Number,
            },
            pagination: {}
        }
    },
    mounted() {
        this.fetchItems()
    },
    methods: {
        fetchItems (page_url) {
            page_url = page_url || '/api/cart';
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.items = res.data;
                    this.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
        },
        addOneItem (item) {
            // Update
            axios.put('api/cart/${item.id}',{
                quantity:item.quantity + 1
            })
                .then(res => res.json())
                .then(data => {
                    // alert('Article Added');
                    this.fetchItems();
                })
                .catch(err => console.log(err));
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };

            this.pagination = pagination;
        },

        deleteArticle(id) {
            if (confirm('Are You Sure?')) {
                fetch(`api/cart/${id}`, {
                    method: 'delete'
                })
                    .then(res => res.json())
                    .then(data => {

                        this.fetchItems();
                    })
                    .catch(err => console.log(err));
            }
        },
    },
}
</script>

<style scoped>
.items-container,.quantity-container{
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
}

</style>
