<template>
    <div class="items-container container" v-if="items.length !== 0 && !isOrderFinished(items)">

        <h2 class="total_label my-4" v-if="count === 0">Total Cost: € {{total = totalCost(items,0).toFixed(2)}}</h2>
        <h2 class="total_label my-4" v-if="count !== 0">Total Cost: € {{total}}</h2>

<!--            <form @submit.prevent="updateOrder" class="mb-3">-->
<!--                <button class="btn btn-success" type="submit" >Save</button>-->
<!--            </form>-->
            <a href="/order"><button class="btn btn-primary">Go to order</button></a>

            <div v-for="item in items" class="bracelets " >
                <div v-if="item.sold === 0">

                    <img class="card-item-img" :src="item.image" width="400px"  alt="item-photo">
                    <p>ID: {{ item.id }}</p>
                    <h5 class="p-3" style="color: black">{{ item.name }}</h5>
<!--                    <h5 class="p-3" style="color: black">Sold: {{ item.sold }}</h5>-->
                    <div class="quantity-container">
                        <button class="btn btn-light" @click="minusOneItem(item);count++" v-if="item.quantity === 1" :disabled="minusOneItem(item)">-</button>
                        <button class="btn btn-light" @click="minusOneItem(item); total = totalCostMinus(item,total).toFixed(2);count++" v-else>-</button>
                        <p>Quantity: {{ item.quantity }}</p>
                        <button class="btn btn-light" @click="addOneItem(item);total = totalCostPlus(item,parseFloat(total));count++">+</button>
                    </div>
                    <p style="display: inline">€ {{ (item.cost * item.quantity).toFixed(2)}}</p>
                    <div>
                        <button @click="deleteArticle(item.id)" id="delete" class="btn btn-danger mb-3">Delete item</button>
                    </div>
                </div>
            </div>

            <nav aria-label="Cart pages navigation" v-if="items.length !== 0">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.prev_page_url)">Previous</a></li>

                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>


    </div>
    <h3 v-else class="text-center py-4">Cart is empty <p>NOTE: if you put item to the cart, but it doesn't show it here, then change $user_id in api/CartController func api(). </p></h3>


</template>

<script>
export default {
    data () {
        return {
            items: [],
            item: {
                id: Number,
                user_id: Number,
                image: String,
                name: String,
                quantity: Number,
                cost: Number,
                sold: Number,
                sum: Number,
            },
            total: 0.0,
            count:0,
            pagination: {},
        }
    },
    mounted() {
        this.fetchItems()

    },
    methods: {
        isOrderFinished: (items) => {
            let isFinished = true;
            items.forEach( item => {
                if(item.sold === 0){
                    isFinished = false;
                }
            })
            return isFinished;
        },
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
        updateOrder() {
            // Update
            fetch('api/cart', {
                method: 'put',
                body: JSON.stringify(this.item),
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    alert('Cart Updated');
                    this.fetchItems();
                })
                .catch(err => console.log(err));
        },
        totalCost: (items,total) => {
            items.forEach(item => {
                total += item.cost * item.quantity;
            });
            return total
        },
        totalCostMinus: (item,total) => {
            total -= item.cost;
            return  total
        },
        totalCostPlus: (item,total) => {
            total += item.cost;
            return  total
        },
        addOneItem (item) {
            // Update
            // axios.put('api/cart/${item.id}',{
            //     quantity:item.quantity + 1
            // })
            //     .then(res => res.json())
            //     .then(data => {
            //         // alert('Article Added');
            //         this.fetchItems();
            //     })
            //     .catch(err => console.log(err));
            if(item.quantity < 20){
                item.quantity ++;
                item.sum = item.cost * item.quantity;
            }

        },
        minusOneItem(item){
            if(item.quantity > 1){
                item.quantity --;
                item.sum = item.cost * item.quantity;
            }
            return item.sum;
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
.total_label{
    width: 80vh;
}
</style>
