<template>
    <div>
        <div class="section">
            <div class="patient-form">
                <div class="form-header">
                    <div class="line-flex">
                        <div>
                            Surname: {{ patient.patient.lname }}
                        </div>
                        <div>
                            Age: {{ patient.patient.age }}
                        </div>
                        <div>
                            Admission Ref: {{ patient.patient_admission_id }}
                        </div>
                    </div>
                    <div class="line-flex">
                        <div>
                            Given Name: {{ patient.patient.fname }}
                        </div>
                        <div>
                            Sex: {{ patient.patient.sex }}
                        </div>
                        <div>
                            Ward/Room: {{ patient.ward_room }}
                        </div>
                    </div>
                </div><!--form hedaer-->

                <div class="discharge-summary">
                    <div class="discharge-summary-text">
                        DISCHARGE SUMMARY
                    </div>

                    <div>
                        <div>
                            Date Admitted: {{ patient.admission_date }}
                        </div>
                        <div>
                            Date Discharge: {{ patient.discharge_date }}
                        </div>
                        <div>
                            Attending Physician: {{ patient.attending_physician }}
                        </div>
                        <div>
                            Admitting Diagnosis: {{ patient.doctor_diagnose.admission_diagnosis }}
                        </div>
                        <div>
                            Final Diagnosis: {{ patient.doctor_diagnose.principal_diagnosis }}
                        </div>
                        <div>
                            Chief Complaints: {{ patient.history.present_complain }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div> <!--root div -->
</template>

<script>

export default{

    props: ['propPatientAdmissionId', 'propPatientId'],

    data(){
        return{
            patient: {},
        }
    },

    methods: {
        loadPatientData(){
            axios.get('/get-patient-all-data/' + this.propPatientAdmissionId + '/' + this.propPatientId).then(res=>{
                this.patient = res.data
            })
        }
    },

    mounted() {
        this.loadPatientData()
    }


}
</script>

<style scoped>

    .patient-form{
        width: 860px;
        margin: auto;
    }

    .line-flex{
        display: flex;
        justify-content: space-between;
    }

    .discharge-summary-text{
        font-weight: bold;
        font-size: 1.2em;
        text-align: center;
        margin: 15px 0;
    }
</style>