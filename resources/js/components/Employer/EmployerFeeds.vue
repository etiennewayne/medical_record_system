<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box">
                        POST
                    </div>
                </div>
            </div>

            <div class="buttons">
                <a class="button is-primary is-small is-outlined" tag="a" href="/employer/company-add-edit">
                    <b-icon
                        class="mr-2"
                        icon="plus-thick"
                        type="is-info">
                    </b-icon>
                    ADD COMPANY</a>
            </div>


        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            companies: []
        }
    },

    methods: {
        loadCompanies(){
            axios.get('/employer/get-my-companies').then(res=>{
                this.companies = res.data;
            })
        },

        editCompany(id){
            window.location = '/employer/company-add-edit/' +id;
        },


        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this company? This action cannot be undone.',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/employer/company-delete/' + delete_id).then(res => {
                this.loadCompanies();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

    },

    mounted(){
        this.loadCompanies();
    }
}
</script>
<style scoped>

</style>
