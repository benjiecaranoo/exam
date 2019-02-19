<template>
    <div class="container">
        <form v-show="isShowing" @submit.prevent="addNewPasser" class="mb-3">

            <div class="form-group">
                <label for="NAME OF EXAMINEE">NAME OF EXAMINEE</label>
                <input type="text" class="form-control" placeholder="" v-model="list.name_of_examinee" required>
            </div>
            <div class="form-group">
                <label for="CAMPUS ELIGIBILITY">CAMPUS ELIGIBILITY</label>
                <input type="text" class="form-control" placeholder="" v-model="list.campus_eligibility" required>
            </div>
            <div class="form-group">
                <label for="SCHOOL">SCHOOL</label>
                <input type="text" class="form-control" placeholder="" v-model="list.school" required>
            </div>

            <div class="form-group">
                <label for="DIVISION">DIVISION</label>
                <input type="text" class="form-control" placeholder="" v-model="list.division" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>

        <div class="container-fluid">
             <section class="row">
                <div class="col-md-8">
                    <div class="btn-group float-left mt-2 mb-2" role="group">
                        <input placeholder="Search"  v-model="term"  type="search">
                        <a class="btn btn-md btn-secondary" href=""  @click.prevent="search">Search</a>
                        <span class="p-2" v-if="noResults"><i>Sorry, but no results were found.</i></span>

                        <span v-if="searching">
                            <i>Searching...</i>
                        </span>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn-group float-right mt-2 mb-2" role="group">
                        <a class="btn btn-md btn-secondary" href=""  @click.prevent="isShowing ^= true">
                        {{message}}</a>
                    </div>
                </div>
            </section>

            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                    <th>#</th>
                    <th>NAME OF EXAMINEE</th>
                    <th>CAMPUS ELIGIBILITY</th>
                    <th>SCHOOL</th>
                    <th>DIVISION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="list in passersList" v-bind:key="list.id">
                    <th>{{ list.id }}</th>
                    <th>{{ list.name_of_examinee }}</th>
                    <td>{{ list.campus_eligibility }}</td>
                    <td>{{ list.school }}</td>
                    <td>{{ list.division }}</td>
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
            passersList: [],
            list: {
                id : '',
                name_of_examinee    : '',
                campus_eligibility  : '',
                school      : '',
                division    :''
            },
            pagination: {},

            isShowing: false,
            message : 'Add New Examinee',
            term:'',
            results:[],
            noResults:false,
            searching:false
        };
    },

    created() {
        this.fetchList();
    },
    methods: {
        fetchList(url) {
        let vm = this;
        url = url || '/api/passers';
        fetch(url)
            .then(res => res.json())
            .then(res => {
            this.passersList = res.data;
                vm.makePagination(res);
            })
            .catch(err => console.log(err));
        },
        makePagination(page) {
            // console.log(page)
            let pagination = {
                current_page    : page.current_page,
                last_page       : page.last_page,
                next_page_url   : page.next_page_url,
                prev_page_url   : page.prev_page_url
            };
            this.pagination = pagination;
        },
        addNewPasser() {
            fetch('api/passers', {
            method: 'post',
            body: JSON.stringify(this.list),
            headers: {
                'content-type': 'application/json'
            }
            })
            .then(res => res.json())
            .then(data => {
                this.clearForm();
                alert('New Passer is Added');
                this.fetchList();
                this.isShowing = false;
            })
            .catch(err => console.log(err));
        },
        clearForm() {
            this.list.id = null;
            this.list.name_of_examinee = '';
            this.list.campus_eligibility = '';
            this.list.school = '';
            this.list.school = '';
        },
        search:function() {
            this.noResults = false;
            this.searching = true;
            let vm = this;
            fetch('/api/passers/'+this.term)
            .then(res => res.json())
            .then(res => {
            this.passersList = res.data;
                this.searching = false;
                this.noResults = res.data.length === 0;
                vm.makePagination(res);
            })
            .catch(err => console.log(err));
		}
    }
};
</script>
