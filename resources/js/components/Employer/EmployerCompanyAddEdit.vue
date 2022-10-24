<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box top-border-green">
                        <div class="form-section-title">
                            Company Information
                        </div>

                        <div>
                            <form @submit.prevent="submit">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Company Name"
                                            :type="this.errors.company ? 'is-danger':''"
                                            :message="this.errors.company ? this.errors.company[0] : ''">
                                            <b-input type="text" placeholder="Company Name" v-model="fields.company"  required></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Owner"
                                            :type="this.errors.owner ? 'is-danger':''"
                                            :message="this.errors.owner ? this.errors.owner[0] : ''">
                                            <b-input type="text" placeholder="Owner" v-model="fields.owner" required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Company Overview"
                                            :type="this.errors.overview ? 'is-danger':''"
                                            :message="this.errors.overview ? this.errors.overview[0] : ''">
                                            <b-input type="textarea" placeholder="Company Overview" v-model="fields.overview" required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Company Size">
                                            <b-numberinput placeholder="Company Size" v-model="fields.company_size" controls-alignment="right" controls-position="compact"></b-numberinput>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Benefits/Others">
                                            <b-input type="text" placeholder="Benefits/Others" v-model="fields.benefits_others"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-section-title">
                                    Contact Information
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Contact No.">
                                            <b-input type="text" placeholder="Contact No." v-model="fields.phone_contact"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="FB">
                                            <b-input type="text" placeholder="FB" v-model="fields.fb_contact"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Twitter">
                                            <b-input type="text" placeholder="Twitter" v-model="fields.twitter_contact"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Instagram">
                                            <b-input type="text" placeholder="Instagram" v-model="fields.insta_contact"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Viber">
                                            <b-input type="text" placeholder="Viber" v-model="fields.viber_contact"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="WhatsApp">
                                            <b-input type="text" placeholder="WhatsApp" v-model="fields.whatsapp_contact"></b-input>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Email"
                                            :type="this.errors.email ? 'is-danger':''"
                                            :message="this.errors.email ? this.errors.email[0] : ''">
                                            <b-input type="email" placeholder="Email" v-model="fields.email" required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-section-title">
                                    Address Information
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Province" label-position="on-border" expanded
                                                :type="this.errors.province ? 'is-danger':''"
                                                :message="this.errors.province ? this.errors.province[0] : ''">
                                            <b-select v-model="fields.province" @input="loadCity" expanded>
                                                <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label="City" label-position="on-border" expanded
                                                :type="this.errors.city ? 'is-danger':''"
                                                :message="this.errors.city ? this.errors.city[0] : ''">
                                            <b-select v-model="fields.city" @input="loadBarangay" expanded>
                                                <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Barangay" label-position="on-border" expanded
                                                :type="this.errors.barangay ? 'is-danger':''"
                                                :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                            <b-select v-model="fields.barangay" expanded>
                                                <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Street" label-position="on-border">
                                            <b-input v-model="fields.street"
                                                    placeholder="Street">
                                            </b-input>
                                        </b-field>
                                    </div>
                                </div>


                                <div class="buttons">
                                    <button class="button is-primary">SAVE COMPANY</button>
                                </div>

                            </form>
                        </div><!--div form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['propId'],

    data() {
        return{
            fields: {
                company_size: 0
            },
            errors: {},

            //address variables
            provinces: [],
            cities: [],
            barangays: [],
            street: '',
        
            id: 0,

        }
    },

    methods: {
        
        //handle addressess
        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },

        loadCity: function(){
            axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },


        submit: function(){
            if(this.id > 0){
                axios.put('/employer/company-add-edit/'+ this.id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                            this.$buefy.dialog.alert({
                                title: 'UPDATED!',
                                message: 'Successfully updated.',
                                type: 'is-success',
                                onConfirm: () => {
                                window.location = '/employer/dashboard';
                                }
                            })
                        }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                axios.post('/employer/company-add-edit', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                            this.$buefy.dialog.alert({
                                title: 'SAVED!',
                                message: 'Successfully saved.',
                                type: 'is-success',
                                onConfirm: () => {
                                window.location = '/employer/dashboard';
                                }
                            })
                        }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }
            
        },

        initData(){
            this.id = parseInt(this.propId);
            
            if(this.id > 0){
                this.getData();
            }
        },
        clearFields(){
            this.fields = {
                company_size: 0
            };
        },
        
        getData(){
            this.clearFields();
          
            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/employer/company-show/'+ this.id).then(res=>{
                this.fields = res.data;
             
                let tempData = res.data;

                console.log(res.data)
                //load city first
                axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                        this.barangays = res.data;
                        this.fields = tempData;
                    });
                });
            });
        },

    },

    mounted(){
        this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been rendered
            this.initData();

            this.loadProvince();
        })
        
    }
}
</script>


<style scoped>
    .form-section-title{
        font-weight: bold;
        margin-bottom: 15px;
        font-style: italic;
    }

</style>