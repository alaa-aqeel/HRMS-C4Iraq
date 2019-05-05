<template>
    <v-dialog v-model="dialog" persistent max-width="600px" hide-overlay>
        <template slot="activator">Log In</template>
        <v-card>

            <!-- Title -->
            <v-card-title style="text-align: center">
                <span class="headline">Log In</span>

                <v-alert dismissible v-model="alert" :type="alert_type" outline transition="scale-transition" width='100%'>
                    {{ alert_text }}
                </v-alert> 

            </v-card-title>

            <!-- Inputs field -->
            <v-card-text>
                <v-container grid-list-md>
                    <v-form ref="form" v-model="valid" lazy-validation  >
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field v-model='email' label="E-mail *" type="email" required :rules='emailRules'></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model='password' label="Password *" type="password" required :rules='passRules'></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-container>
            </v-card-text>

            <!-- Buttons -->
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="dialog = !dialog;$refs.form.reset();alert=false">Close</v-btn>
                <v-btn color="blue darken-1" flat @click="login">Log In</v-btn>
            </v-card-actions>

        </v-card>
    </v-dialog>
</template>


<script>
        export default {
            data: () => ({
                valid: true,
                dialog: false,
                alert:false, 
                alert_type : 'success',
                alert_text : '',
                email: "",
                password: "",
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                passRules:[
                    v => !!v || 'Password is required',
                    v => ( v && v.length >= 8 ) || 'Password must be less than 8 characters',
                    v => /^[A-Za-z\!\@\#\$\%\^\&\*\(\)]+$/.test(v)  || 'Password must be a-z A-Z ! @ # $ %. . .'
                ]
            }),
    
            methods:{
                login(){
                    if (this.$refs.form.validate()) {
                        axios.post('api/login',{ 
                            email: this.email,
                            password: this.password
                        }).then((resp)=>{ 
                            if (resp.data.token){
                                this.alert = false ;
                                this.dialog = false;
                                this.$emit("login",{email:this.email,token:resp.data.token});
                            }

                        }).catch((resp)=>{
                            this.alert = true ;
                            this.alert_type = 'error' ;
                            this.alert_text = 'Error Login E-mail/Password not courrect';
                        })
                    }
                }
            }
        }
    </script>