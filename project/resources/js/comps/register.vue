<template>


    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template slot="activator">
                Register
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Register</span>

                    <v-alert :value="alert" :type="alert_type" outline transition="scale-transition" width='100%'>
                        {{ alert_text }}
                    </v-alert>

                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-form ref="form" v-model="valid" lazy-validation  >
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field v-model='firstName' label="First Name *" type="fname" required :rules='reqRules'></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field v-model='lastName' label="Last Name *" type="lname" required :rules='reqRules'></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field v-model='governorate' label="governorate *" type="gov" required :rules='reqRules'></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field v-model='email' label="Email *" type="email" required :rules='emailRules'></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field v-model='password' label="Password *" type="password" required :rules='passRules'></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-form>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="dialog = !dialog;$refs.form.reset()">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click="register">Register</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>

</template>



<script>
export default{
    data(){
        return{
            valid: true,
            dialog: false,
            alert:false, 
            alert_type : 'success',
            alert_text : '',
            firstName: "",
            lastName: "",
            governorate: "",
            email: "",
            password: "",
            reqRules: [
                v => !!v || 'this is required',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            passRules:[
                v => !!v || 'Password is required',
                v => ( v && v.length >= 8 ) || 'Password must be less than 8 characters',
                v => /^[A-Za-z\!\@\#\$\%\^\&\*\(\)]+$/.test(v)  || 'Password must be a-z A-Z ! @ # $ %. . .'
            ]
        }
    },
    methods:{
        validate () {
            if (this.$refs.form.validate()) {
                this.snackbar = true
            }
        },
        register(){
            if (this.$refs.form.validate()) {

                axios.post('/api/register',{ 
                    username:this.email.split("@")[0],
                    first_name:this.firstName,
                    last_name:this.lastName,
                    email:this.email,
                    governorate:this.governorate,
                    password:this.password
                }).then( (resp) => {
                    if (resp.data.Success){
                        this.alert = true ; 
                        this.alert_type = 'success'
                        this.alert_text = `Welcome ${resp.data.Success.user.first_name}`
                        this.$emit("login",{
                                    email:resp.data.Success.user.email,
                                    token:resp.data.Success.token
                                });
                    }
                }).catch((resp)=>{ 
                    this.alert = true ; 
                    this.alert_type = 'error' ;
                    this.alert_text = `Error Register this email alerdy exsits`
                 });

            }

        }
    }
}
</script>