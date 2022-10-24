<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div>
                    <div class="box">
                        <div class="w-head-title">
                            WELCOME ADMINISTRATOR
                        </div>
                        <div class="w-content">
                            {{ info.user }}
                        </div>
                    </div>
                </div>


            </div><!--cols-->



        </div>

        <!-- <div class="section">
            <div class="buttons">
                <b-button type="is-info" @click="sendSMS" label="Send"></b-button>
            </div>
        </div> -->


    </div>
</template>

<script>
export default {
	data(){
		return{
            info: {},

		}
	},

	methods:{
        getDashboardInfo(){
            axios.get('/get-dashboard-info').then(res=>{
                this.info = res.data;
            })
        },

	},

    mounted() {
        this.getDashboardInfo();
    }
}
</script>

<style scoped>
    .w-head-title{
        font-weight: bold;
    }
    .w-content{
        text-align: center;
        font-weight: bold;
        font-size: 2em;
    }
</style>
