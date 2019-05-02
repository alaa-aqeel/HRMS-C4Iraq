<template>
    <v-form ref="profilefrom" v-model="valid" >
        <br>
        <br>
        <h1> 
            <v-btn v-if='data.info' flat @click='$emit("back")'><v-icon> arrow_back </v-icon></v-btn> 
            {{ title }} 
        </h1>

        <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
            <!-- <img :src="image_url" height="150" /> -->
            <v-avatar :size='150' v-if="image_url">
                <v-img :src="image_url" > </v-img>
            </v-avatar>
            <v-text-field readonly  v-model='image_name'
                label="Select Image" required :rules="validRules" 
                prepend-inner-icon='fas fa-image' 
                @click='$refs.image.click()'
            ></v-text-field>
            <input type="file"
                style="display: none"
                ref="image"
                accept="image/*"
                @change="upload"
            >
        </v-flex>
        <v-text-field 
            v-model="education" 
            label="Education Attainment" 
            required  :counter="100"
            :rules="validRules" 
        ></v-text-field>
        <v-menu 
            v-model="menu"
            full-width 
            offset-y 
            min-width="290px" 
            :close-on-content-click="false"
        >
            <v-text-field readonly v-model="birthday" :rules='validRules'
                prepend-inner-icon="event" 
                slot="activator" 
                label="Birthday" required 
            ></v-text-field>
            <v-date-picker v-model="birthday" no-title scrollable @input="menu = false"></v-date-picker>
        </v-menu>

        <v-combobox persistent-hint
                v-model="skills"
                chips clearable multiple 
                label="Skills"   
            >
            <template slot="selection" slot-scope="data">
                <v-chip :selected="data.selected" class="chip--select-multi" close @input="remove(data.item)"  >
                    <strong>{{ data.item }}</strong>&nbsp;
                </v-chip>
            </template>

        </v-combobox>

        <v-select v-model="gender"
          :items="['Male','Female']"
          label="Gender" 
          :rules="validRules" required
        ></v-select>

        <v-textarea v-model="about"
          label="About"
          :rules="validRules" required
          hint="Talk about yourself "
        ></v-textarea>

        <v-text-field v-model='id_fb' :rules="validRules" required
          label="Facebook Id" 
          prefix="facebook.com/" prepend-inner-icon="fab fa-facebook-f"
        ></v-text-field>
        <!--  -->
        <v-text-field v-model='id_t' :rules="validRules" required
          label="telegrame Id" 
          prefix="t.me/" prepend-inner-icon="fab fa-telegram"
        ></v-text-field>

        <v-text-field v-model='id_git'
          label="Github Id" 
          prefix="github.com/" prepend-inner-icon="fab fa-github"
        ></v-text-field>

        <v-text-field v-model='phone'
          label="Phone Number" 
          prefix="+964" prepend-inner-icon="fas fa-phone"
        ></v-text-field>

        <v-text-field v-model='email'
          label="Email " 
          prepend-inner-icon="fas fa-envelope"
        ></v-text-field>
    
        <v-btn @click="submit"> {{ title.split(" ")[0] }}</v-btn>
    </v-form>
</template>

<script>
export default{
    props:['title','token','data','url'],
    data(){
        return {
            valid: true,
            menu: false,
            education:'' ,
            
            phone:'',
            email:'',

            about:'',
            birthday:'',
            skills:[],
            gender:'',
            id_fb:'',
            id_t:'',
            id_git:'',

            image_name: '',
            image_file: '',
            image_url:'',
            validRules:[
                v => !!v || 'field is required',
            ]
        }
    },
    created(){
        if( this.data.info && this.data.content ){
            // console.log(this.data);
            this.education = this.data.info.educational_attainment
            this.phone = this.data.content.telephone != 'null' ? this.data.content.telephone : '' 
            this.email =  this.data.content.other_email != 'null' ? this.data.content.other_email : '' 
            this.about = this.data.info.about
            this.birthday = this.data.info.bron
            this.skills = this.data.info.skills != 'null' ? this.data.info.skills.split(',') : []
            this.gender = this.data.info.gender
            this.id_fb = this.data.content.id_facebook
            this.id_t = this.data.content.id_telegram
            this.id_git = this.data.content.id_github != 'null' ? this.data.content.id_github : ''
            this.image_name =  this.data.info.image_profile
            this.image_url = '/images/profile/'+this.data.info.image_profile
        }
    },
    methods:{
        remove (item) {
            this.skills.splice(this.skills.indexOf(item), 1)
            this.skills = [...this.skills]
        },

        submit(){
            if (this.$refs.profilefrom.validate()) {

                var formData = new FormData();

                formData.append('image_profile', this.image_file);
                
                var item = {
                    educational_attainment:this.education,
                    about:this.about,
                    bron:this.birthday,
                    skills:this.skills.join(','),
                    gender:this.gender,
                    id_facebook:this.id_fb,
                    id_telegram:this.id_t,
                    id_github:this.id_git,
                    telephone:this.phone,
                    other_email:this.email,
                };for ( var key in item){ 
                    if(item[key]){
                         formData.append(key, item[key]);
                    }  else{  formData.append(key, null); } 
                }

                axios.post(this.url,formData,{
                    headers:{ Authorization:`Bearer ${this.token}` }
                }).then(resp=>{
                    this.$emit("submit");
                   
                }).catch(resp=>{
                    // console.log(resp.response) 
                })
            }
        },
        upload(e){
            const files = e.target.files
			if(files[0] !== undefined) {
				this.image_name = files[0].name
				if(this.image_name.lastIndexOf('.') <= 0) {
					return
				}
				const fr = new FileReader ()
				fr.readAsDataURL(files[0])
				fr.addEventListener('load', () => {
					this.image_url = fr.result
					this.image_file = files[0] 
				})
			} else {
				this.image_name = ''
				this.image_file = ''
				this.image_url = ''
			}
        }
    }
}

</script>


<style>
    .v-text-field.v-text-field--solo:not(.v-text-field--solo-flat) 
        > 
    .v-input__control > .v-input__slot{
        box-shadow: 0 1px 5px 0 rgba(0,0,0,.12);
    }

</style>