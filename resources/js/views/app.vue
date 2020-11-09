<template>
    <div>
        <nav-info></nav-info>
        <orders-tables></orders-tables>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="/api/orders/export" class="btn btn-success float-right">Download CSV</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import NavInfo from '../components/navbar.vue';
import OrdersTables from '../tables/orders.vue';
export default {
    computed: {},
    components: {
        NavInfo,
        OrdersTables
    },
    data() {
        return {
        };
    },
    methods: {
        downloadCsv() {
            this.axios.get('/api/orders/export').then(response => {
                console.log(response);
            })
        }
    }
};
</script>
