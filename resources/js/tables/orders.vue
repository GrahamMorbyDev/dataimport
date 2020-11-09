<template>
    <div class="container mt-5">
        <b-table
            striped
            hover
            bordered
            responsive
            :items="orders"
            :fields="headers"
        >
                <template v-slot:cell(sub_total)="row">
                    £{{row.item.sub_total}}
                </template>
                <template v-slot:cell(vat_percentage)="row">
                    {{row.item.vat_percentage}}%
                </template>
                <template v-slot:cell(vat_value)="row">
                    £{{row.item.vat_value}}
                </template>
                <template v-slot:cell(order_date)="row">
                    {{row.item.order_date | moment("DD/MM/YYYY")}}
                </template>
                <template v-slot:cell(total)="row">
                    £{{row.item.total}}
                </template>
        </b-table>
        <small>Vat percentage shown for records where provided</small>
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders: [],
            headers: [
                {
                    key: 'id',
                    sortable: false,
                },
                {
                    key: 'name',
                    sortable: true,
                },
                {
                    key: 'sub_total',
                    sortable: false,
                },
                {
                    key: 'vat_value',
                    sortable: false,
                },
                {
                    key: 'vat_percentage',
                    sortable: false,
                },
                {
                    key: 'total',
                    sortable: true,
                },
                {
                    key: 'order_date',
                    sortable: true,
                },
            ],
        };
    },
    methods: {
        getOrderData() {
            this.axios.get('/api/orders/get').then(response => {
                this.orders = response.data.data;
            });
        },
    },
    mounted() {
        this.getOrderData();
    },
};
</script>
