<template>

    <div v-if='upass'>
        <v-form ref="upassfrom" lazy-validation>
            <v-text-field v-model='currentpass' label="Current Password" type="text" :rules='passRules'>
            </v-text-field>
            <v-text-field v-model='newpass' label="New Password" type="text" :rules='passRules'>
            </v-text-field>
            <v-btn color="blue darken-1" flat @click="changepassword">
                update
            </v-btn> 
        </v-form>
    </div>

</template>

<script>
export default{
    props:['upass','token'],
    data(){
        return {
            currentpass: '',
            newpass : "", 
            passRules:[
                v => !!v || 'Password is required',
                v => ( v && v.length >= 8 ) || 'Password must be less than 8 characters',
                v => /^[A-Za-z\!\@\#\$\%\^\&\*\(\)]+$/.test(v)  || 'Password must be a-z A-Z ! @ # $ %. . .'
            ]
        }
    },
    methods:{
        changepassword(){
            if (this.$refs.upassfrom.validate()) {
                axios.post("api/member/mpass",{
                    cureent_password : this.currentpass,
                    new_password:this.newpass
                },{headers:{Authorization:`Bearer ${this.token}`}})
                .then((resp)=>{
                    if(resp.data.Errors){
                        this.$emit("alertsnack",{
                            mesg:'Current Password notcorrect' ,
                            type:'error'
                        })
                    }else if(resp.data.Success){ 
                        this.$emit("alertsnack",{
                            mesg:'Successfuly Change Password ',
                            type:'success'
                        });this.$refs.upassfrom.reset();
                    }
                }).catch((resp)=>{ console.log(resp); alert("Some Errors in Server site") })
            }

        }
    }
}
</script>