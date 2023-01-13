<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8-desktop">

                    <div class="box">
                        <div class="box-header">
                            <div class="box-header-text">
                                PATIENT DEMOGRAPHIC DATA
                            </div>
                            <div class="divider"></div>
                        </div>
                        <div class="box-body">
                            
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Last Name">
                                        <b-input type="text" 
                                            v-model="fields.lname" placeholder="Last Name"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="First Name">
                                        <b-input type="text" 
                                            v-model="fields.fname" placeholder="First Name"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Middle Name">
                                        <b-input type="text" 
                                            v-model="fields.mname" placeholder="Middle Name"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Suffix">
                                        <b-input type="text" 
                                            v-model="fields.suffix" placeholder="Suffix"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Ward/Room/Bed/Service">
                                        <b-input type="text" 
                                            v-model="fields.ward_room" placeholder="Ward/Room/Bed/Service"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Permanent Address">
                                        <b-input type="text" 
                                            v-model="fields.per_address" placeholder="Permanent Address"></b-input>
                                    </b-field>
                                </div>
                            </div>
                            
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Contact No.">
                                        <b-input type="text" 
                                            v-model="fields.contact_no" placeholder="Contact No."></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Sex" expanded>
                                        <b-select expanded
                                            v-model="fields.sex" placeholder="Sex">
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Civil Status" expanded>
                                        <b-select expanded
                                            v-model="fields.civl_status" placeholder="Civil Status">
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="DIVORCE">DIVORCE</option>
                                            <option value="SEPARATED">SEPARATED</option>
                                            <option value="COHABITATION">COHABITATION</option>
                                            <option value="WIDOWED">WIDOWED</option>
                                            <option value="MARRIED">MARRIED</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Birthdate">
                                        <b-datepicker v-model="fields.bdate" placeholder="Birthdate"></b-datepicker>
                                    </b-field>
                                </div>
                                <div class="column is-2">
                                    <b-field label="Age">
                                        <b-input v-model="fields.age" placeholder="Age"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Birthplace">
                                        <b-input v-model="fields.birthplace" placeholder="Birthplace"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Nationality" expanded>
                                        <b-select v-model="fields.nationality" expanded
                                        placeholder="Nationality">
                                            <option v-for="(item, index) in nationalities" :key="index"
                                                :value="item.nationality">{{ item.nationality }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Religion" expanded>
                                        <b-select expanded
                                            v-model="fields.religion" placeholder="Religion">
                                            <option v-for="(item, index) in religions" :key="index"
                                                :value="item.religion">{{ item.religion }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Birthplace">
                                        <b-input v-model="fields.occupation" placeholder="Occupation"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Employer" expanded>
                                        <b-input type="text" v-model="fields.employer"
                                            placeholder="Employer">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Address" expanded>
                                        <b-input type="text" v-model="fields.address"
                                            placeholder="Address">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Contact No.">
                                        <b-input v-model="fields.employer_contact_no" 
                                            placeholder="Contact No."></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <!-- FATHER -->
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Father's Name" expanded>
                                        <b-input type="text" v-model="fields.father_name"
                                            placeholder="Father's Name">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Address" expanded>
                                        <b-input type="text" v-model="fields.father_address"
                                            placeholder="Address">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Contact No.">
                                        <b-input v-model="fields.father_contact_no" 
                                            placeholder="Contact No."></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <!-- MOTHER -->
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Mother's (Maiden) Name" expanded>
                                        <b-input type="text" v-model="fields.mother_maiden_name"
                                            placeholder="Mother's (Maiden) Name">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Address" expanded>
                                        <b-input type="text" v-model="fields.mother_address"
                                            placeholder="Address">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Contact No.">
                                        <b-input v-model="fields.mother_contact_no" 
                                            placeholder="Contact No."></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <!-- SPOUSE -->
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Spouse Name" expanded>
                                        <b-input type="text" v-model="fields.spouse_name"
                                            placeholder="Spouse Name">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Address" expanded>
                                        <b-input type="text" v-model="fields.spouse_address"
                                            placeholder="Address">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Contact No.">
                                        <b-input v-model="fields.spouse_contact_no" 
                                            placeholder="Contact No."></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="divider"></div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Admission(Date and Time)">
                                        <b-datetimepicker
                                            v-model="fields.admission"
                                            placeholder="Admission"></b-datetimepicker>
                                    </b-field>
                                    
                                </div>
                                <div class="column">
                                    <b-field label="Discharge(Date and Time)">
                                        <b-datetimepicker
                                            v-model="fields.discharge"
                                            placeholder="Discharge"></b-datetimepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Total No. of Days">
                                        <b-numberinput
                                            v-model="fields.total_day"
                                            placeholder="Total No. of Days"
                                            :controls="false"></b-numberinput>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Admitting Physician">
                                        <b-input type="text"
                                            v-model="fields.admitting_physician"
                                            placeholder="Admitting Physician"></b-input>
                                    </b-field>
                                    
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Admitting Clerk">
                                        <b-input type="text"
                                            v-model="fields.admitting_clerk"
                                            placeholder="Admitting Clerk"></b-input>
                                    </b-field>
                                    
                                </div>
                                <div class="column">
                                    <b-field label="Attending Physician">
                                        <b-input type="text"
                                            v-model="fields.attending_physician"
                                            placeholder="Attending Physician"></b-input>
                                    </b-field>
                                    
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Type of admission" expanded>
                                        <b-select v-model="fields.type_admission" expanded>
                                            <option value="NEW">NEW</option>
                                            <option value="OLD">OLD</option>
                                            <option value="FORMER OPD">FORMER OPD</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Referred By(Physician/Agency)">
                                        <b-input v-model="fields.referred_by"
                                            placeholder="Referred By">
                                        </b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Social Service Classification" expanded>
                                        <b-select v-model="fields.social_service_classification" expanded>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C1</option>
                                            <option value="C2">C2</option>
                                            <option value="C3">C3</option>
                                            <option value="D">D</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            

                        </div>
                    </div><!--box-->
                </div>
            </div>
        </div>
    </div> <!--root div-->

</template>

<script>
import { assertExpressionStatement } from '@babel/types';


export default {
    data(){
        return{
            fields: {},
            errors: {},

            nationalities: [],
            religions: [],

        }
    },

    methods: {

        loadNationalities(){
            axios.get('/load-open-nationalities').then(res=>{
                this.nationalities = res.data
            }).catch(err=>{
            
            })
        },

        loadReligions(){
            axios.get('/load-open-religions').then(res=>{
                this.religions = res.data
            }).catch(err=>{
            
            })
        }


    },

    mounted(){
        this.loadNationalities()
        this.loadReligions()
    }
}


</script>

<style scoped>
    .box-header-text{
        font-weight: bolder;
        font-size: 1.2em;
    }

    .divider{
        border: 2px solid rgb(159, 241, 255);
        margin: 5px 0;
    }



</style>