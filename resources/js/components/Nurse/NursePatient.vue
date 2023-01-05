<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-10-desktop">
                    <div class="box">

                        <div class="table-text">PATIENTS LIST</div>

                        <b-field label="Search" label-position="on-border">
                            <b-input type="text"
                                        v-model="search.lname" placeholder="Last Name"
                                        @keyup.native.enter="loadAsyncData"/>
                            <b-input type="text"
                                    v-model="search.fname" placeholder="First Name"
                                    @keyup.native.enter="loadAsyncData"/>
                            <p class="control">
                                    <b-tooltip label="Search" type="is-success">
                                <b-button type="is-primary" icon-right="magnify" @click="loadAsyncData"/>
                                    </b-tooltip>
                            </p>
                        </b-field>

                        <div class="buttons is-right mt-3">
                            <b-button tag="a" icon-left="account" 
                                :href="`/nurse-patient/create?lname=${search.lname}&fname=${search.fname}`"
                                class="is-primary is-small">New Patient</b-button>
                        </div>

                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            backend-pagination
                            :total="total"
                            :pagination-rounded="true"
                            :per-page="perPage"
                            @page-change="onPageChange"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirection"
                            @sort="onSort">

                            <b-table-column field="patient_id" label="ID" sortable v-slot="props">
                                {{ props.row.patient_id }}
                            </b-table-column>

                            <b-table-column field="name" label="Name" sortable v-slot="props">
                                {{ props.row.fname }} {{ props.row.mname }} {{ props.row.lname }} {{ props.row.suffix }} 
                            </b-table-column>

                            <b-table-column field="sex" label="Sex" sortable v-slot="props">
                                {{ props.row.sex }}
                            </b-table-column>

                            <b-table-column field="civil_status" label="Civil Status" sortable v-slot="props">
                                {{ props.row.civil_status }}
                            </b-table-column>

                            <b-table-column field="contact_no" label="Contact" v-slot="props">
                                {{ props.row.contact_no }}
                            </b-table-column>

                            <b-table-column field="bdate" label="Birthdate" v-slot="props">
                                {{ props.row.bdate }}
                            </b-table-column>

                            <b-table-column field="mother_maiden_name" label="Mother" v-slot="props">
                                {{ props.row.mother_maiden_name }}
                            </b-table-column>

                            <b-table-column field="father_name" label="Father" v-slot="props">
                                {{ props.row.father_name }}
                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">

                                    <b-dropdown aria-role="list">
                                        <template #trigger="{ active }">
                                            <b-button
                                                label="Option"
                                                type="is-primary"
                                                class="is-small"
                                                :icon-right="active ? 'menu-up' : 'menu-down'" />
                                        </template>


                                        <b-dropdown-item aria-role="listitem"
                                            icon-right="pencil"
                                            :href="`/nurse-patient/${props.row.patient_id}/edit`">Update</b-dropdown-item>

                                        <b-dropdown-item aria-role="listitem" @click="openModalDiagnose(props.row)">
                                            Diagnose
                                        </b-dropdown-item>

                                        <b-dropdown-item aria-role="listitem" :href="`/nurse-patient-diagnoses/${props.row.patient_id}`">
                                            Show diagnoses
                                        </b-dropdown-item>

                                        <hr>

                                        <b-dropdown-item aria-role="listitem" 
                                            icon-right="delete"
                                            @click="confirmDelete(props.row.patient_id)"
                                        >
                                            Delete
                                        </b-dropdown-item>
                                        
                                    </b-dropdown>
                                    
                                    
                                  
                                </div>
                            </b-table-column>
                        </b-table>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Page" label-position="on-border">
                                    <b-select v-model="perPage" @input="setPerPage" class="is-small">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->



        <!--modal reset password-->
        <b-modal v-model="modalDiagnose" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submitDiagnose">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Diagnose Information</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalDiagnose = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">

                                    <b-field label="Present Complain" label-position="on-border"
                                             :type="this.errors.present_complain ? 'is-danger':''"
                                             :message="this.errors.present_complain ? this.errors.present_complain[0] : ''">
                                        <b-input type="textarea" v-model="fields.present_complain"
                                                 placeholder="Present Complain">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Admission Diagnose" label-position="on-border"
                                             :type="this.errors.admission_diagnose ? 'is-danger':''"
                                             :message="this.errors.admission_diagnose ? this.errors.admission_diagnose[0] : ''">
                                        <b-input type="textarea" v-model="fields.admission_diagnose"
                                                 placeholder="Admission Diagnose">
                                        </b-input>
                                    </b-field>

                                    <!-- <b-field label="Principal Diagnose" label-position="on-border"
                                        :type="this.errors.principal_diagnose ? 'is-danger':''"
                                        :message="this.errors.principal_diagnose ? this.errors.principal_diagnose[0] : ''">
                                        <b-input type="textarea" v-model="fields.principal_diagnose"
                                            placeholder="Principal Diagnose">
                                        </b-input>
                                    </b-field> -->

                                    <b-field label="Doctor" label-position="on-border"
                                        :type="this.errors.doctor ? 'is-danger':''"
                                        :message="this.errors.doctor ? this.errors.doctor[0] : ''">
                                        <b-select v-model="fields.doctor"
                                            placeholder="Doctor">
                                            <option v-for="(item, index) in doctors" :key="index" 
                                                :value="item.user_id">{{ item.lname }}, {{ item.fname }} {{item.mname  }}</option>
                                        </b-select>
                                    </b-field>

                                    <b-field label="Skin" label-position="on-border"
                                        :type="this.errors.skin ? 'is-danger':''"
                                        :message="this.errors.skin ? this.errors.skin[0] : ''">
                                        <b-input type="text" v-model="fields.skin"
                                            placeholder="Skin">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Head EENT" label-position="on-border"
                                        :type="this.errors.head_eent ? 'is-danger':''"
                                        :message="this.errors.head_eent ? this.errors.head_eent[0] : ''">
                                        <b-input type="text" v-model="fields.head_eent"
                                            placeholder="Head EENT">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Lymp Notes" label-position="on-border"
                                        :type="this.errors.lymp_notes ? 'is-danger':''"
                                        :message="this.errors.lymp_notes ? this.errors.lymp_notes[0] : ''">
                                        <b-input type="text" v-model="fields.lymp_notes"
                                            placeholder="Lymp Notes">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Chest" label-position="on-border"
                                        :type="this.errors.chest ? 'is-danger':''"
                                        :message="this.errors.chest ? this.errors.chest[0] : ''">
                                        <b-input type="text" v-model="fields.chest"
                                            placeholder="Chest">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Lungs" label-position="on-border"
                                        :type="this.errors.lungs ? 'is-danger':''"
                                        :message="this.errors.lungs ? this.errors.lungs[0] : ''">
                                        <b-input type="text" v-model="fields.lungs"
                                            placeholder="Lungs">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Cadiovascular" label-position="on-border"
                                        :type="this.errors.cardiovascular ? 'is-danger':''"
                                        :message="this.errors.cardiovascular ? this.errors.cardiovascular[0] : ''">
                                        <b-input type="text" v-model="fields.cardiovascular"
                                            placeholder="Cadiovascular">
                                        </b-input>
                                    </b-field>
                                    
                                    <b-field label="Breast" label-position="on-border"
                                        :type="this.errors.breast ? 'is-danger':''"
                                        :message="this.errors.breast ? this.errors.breast[0] : ''">
                                        <b-input type="text" v-model="fields.breast"
                                            placeholder="Breast">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Abdomen" label-position="on-border"
                                        :type="this.errors.abdomen ? 'is-danger':''"
                                        :message="this.errors.abdomen ? this.errors.abdomen[0] : ''">
                                        <b-input type="text" v-model="fields.abdomen"
                                            placeholder="Abdomen">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Rectum" label-position="on-border"
                                        :type="this.errors.rectum ? 'is-danger':''"
                                        :message="this.errors.rectum ? this.errors.rectum[0] : ''">
                                        <b-input type="text" v-model="fields.rectum"
                                            placeholder="Rectum">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Genetalia" label-position="on-border"
                                        :type="this.errors.genetalia ? 'is-danger':''"
                                        :message="this.errors.genetalia ? this.errors.genetalia[0] : ''">
                                        <b-input type="text" v-model="fields.genetalia"
                                            placeholder="Genetalia">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Musculoskeletal" label-position="on-border"
                                        :type="this.errors.musculoskeletal ? 'is-danger':''"
                                        :message="this.errors.musculoskeletal ? this.errors.musculoskeletal[0] : ''">
                                        <b-input type="text" v-model="fields.musculoskeletal"
                                            placeholder="Musculoskeletal">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Extremities" label-position="on-border"
                                        :type="this.errors.extremities ? 'is-danger':''"
                                        :message="this.errors.extremities ? this.errors.extremities[0] : ''">
                                        <b-input type="text" v-model="fields.extremities"
                                            placeholder="Extremities">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Neurological" label-position="on-border"
                                        :type="this.errors.neurological ? 'is-danger':''"
                                        :message="this.errors.neurological ? this.errors.neurological[0] : ''">
                                        <b-input type="text" v-model="fields.neurological"
                                            placeholder="Neurological">
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="modalDiagnose=false"/>
                        <button
                            class="button is-primary">SAVE</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->

    </div>
</template>

<script>

export default{
    props: ['propDesignations', 'propDoctors'],
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'patient_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',


          

            search: {
                lname: '',
                fname: '',
            },



            modalDiagnose: false,
            

            fields: {
                patient_id: 0, 
                date_admission: null,
                admission_diagnose: '',
                principal_diagnose: '',
                doctor_id: 0,
            },

            errors: {},
            doctors: [],



        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `lname=${this.search.lname}`,
                `fname=${this.search.fname}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-nurse-patients?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },

        openModal(){
            this.isModalCreate=true;
            this.fields = {};
            this.errors = {};
        },

        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/nurse-patient/' + delete_id).then(res => {
                this.loadAsyncData();
                this.clearFields()
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        clearFields(){
  
            this.fields = {
                patient_id: 0, 
                date_admission: null,
                admission_diagnose: '',
                principal_diagnose: '',
                doctor_id: 0,
            };
        },


        //update code here
        getData: function(data_id){
            this.clearFields();
            this.global_id = data_id;
            this.isModalCreate = true;

            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/designations/'+data_id).then(res=>{
                this.fields = res.data;
            });
        },

        initData(){
            this.doctors = JSON.parse(this.propDoctors)
        },

        openModalDiagnose(row){
            this.modalDiagnose = true
            this.fields = {
                patient_id: row.patient_id, 
            };
        },

        submitDiagnose(){
            axios.post('/nurse-patient-submit-diagnose', this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Saved!',
                        message: 'Successfully saved.',
                        type: 'is-success',
                        onConfirm: () => {
                            this.loadAsyncData();
                            this.clearFields();
                            this.modalDiagnose = false;
                        }
                    })
                }
            }).catch(err=>{
            
            })
        }


    },

    mounted() {
        this.loadAsyncData()
        this.initData()
    }

}


</script>


<style>

    .table > tbody > tr {
        /* background-color: blue; */
        transition: background-color 0.5s ease;
    }

    .table > tbody > tr:hover {
        background-color: rgb(233, 233, 233);
    }

</style>
