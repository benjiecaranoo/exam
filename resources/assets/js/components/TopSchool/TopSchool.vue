<template>
    <div class="container">
        <div class="row">
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                    <th># of Passers</th>
                    <th>SCHOOL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="list in topSchoolist" v-bind:key="list.id">
                    <th>{{ list.total }}</th>
                    <td>{{ list.school }}</td>
                    </tr>
                </tbody>
            </table>
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchList(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
                </li>
                <li  v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchList(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
   export default {
    data() {
        return {
            topSchoolist: [],
            list: {
                total   : '',
                school  : '',
            },
            pagination: {},
        };
    },
    created() {
        this.fetchList();
    },
    methods: {
        fetchList(url) {
        let vm = this;
        url = url || '/api/passers/list/school';
        fetch(url)
            .then(res => res.json())
            .then(res => {
            this.topSchoolist = res.data;
                vm.makePagination(res);
            })
            .catch(err => console.log(err));
        },
        makePagination(res) {
            let pagination = {
                current_page    : res.current_page,
                last_page       : res.last_page,
                next_page_url   : res.next_page_url,
                prev_page_url   : res.prev_page_url
            };
            this.pagination = pagination;
        },  
    }
};
</script>
