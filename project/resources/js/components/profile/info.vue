<template>
    <v-layout row wrap>
        <v-flex xs12>
            
            <v-card style="padding: 19px;" v-if='data.info'>
                <v-layout row wrap>
                    <v-flex lg2 md2 sm3 xs12>
                        <v-avatar :size='150' @click='dialog = true'>
                            <v-img :src='"/images/profile/"+data.info.image_profile' > </v-img>
                        </v-avatar>
                        <v-dialog v-model="dialog" width="600px" style="height: 100%;">
                            <v-card :style="`height: 100%;background-color: #8d8d8d1a;
                                    background-size: contain;
                                    background-position: center;
                                    background-image:url(/images/profile/${data.info.image_profile})`"
                                >

                            </v-card>
                            <!-- <v-img :src='"/images/profile/"+data.info.image_profile' > </v-img> -->
                        </v-dialog>
                    </v-flex>

                    <v-flex lg2 md3 sm3 xs12 >
                        <v-card-title>
                            <h1 > {{ `${data.user[0].first_name} ${data.user[0].last_name}` }} </h1>
                            <small> Code For Iraq </small>
                        </v-card-title>
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex sm5 xs12 align-center>
                        <v-layout tag="v-card-text" row wrap>
                            <v-flex xs12> <strong md2>Email:    </strong> {{data.user[0].email}} {{ data.content.other_email != "null" ? ','+data.content.other_email : ''  }} </v-flex>                                                        
                            <v-flex xs12> <strong md2>Birthday: </strong> {{data.info.bron}} </v-flex>
                            <v-flex xs12> <strong md2>Gender:   </strong> {{ data.info.gender }} </v-flex>
                            <v-flex xs12> <strong md2>Governorate:     </strong> {{data.user[0].governorate}} </v-flex>
                            <v-flex xs12 v-if='data.content.telephone != "null"'> <strong md2>Phone: </strong> {{ data.content.telephone }} </v-flex>
                        </v-layout>
                    </v-flex>
                    
                    <v-speed-dial v-model="fab" bottom right fixed>
                        <v-btn dark fab
                            slot="activator"
                            color="blue darken-2"
                            @click='$emit("update")'
                        > <v-icon>edit</v-icon> <v-icon>close</v-icon> </v-btn>
                    </v-speed-dial>
                </v-layout>
            </v-card>
        </v-flex>

        <v-flex md3 xs12 style="padding: 10px 10px 0 0 " >
            <v-card style="padding: 19px;" v-if='data.info.skills != "null" '>
                <v-card-text>
                    <v-subheader> Skills </v-subheader>
                    <v-list two-line>
                        <v-list-tile-content class="text-xs-center" style="padding: 5px" v-for='skill in data.info.skills.split(",")' :key='skill'>
                            <strong>{{ skill }}</strong>
                        </v-list-tile-content>
                    </v-list>
                </v-card-text>
            </v-card>
            <br>
            <v-card style="padding: 19px;">
                <v-card-text class="text-xs-center">
                    <v-subheader style="display: block;" > Education Attainment </v-subheader>
                    <!-- <v-timeline dense > -->
                        <!-- <v-timeline-item small color="pink" v-for='ei,i in education_informations' :key='i'> -->
                        <h3> {{ data.info.educational_attainment }} </h3>
                            <!-- <h4><small> {{ data.education.text }} </small> </h4> 
                            <h4><small> {{ data.education.year }} </small> </h4>                                 -->
                        <!-- </v-timeline-item> -->
                    <!-- </v-timeline> -->
                </v-card-text>
            </v-card>
                
        </v-flex>

        <v-flex md9 style="padding: 10px 0">
            <v-card style="padding: 19px;">
                <v-card-text class="text-xs-center">
                    <v-subheader style="display: block;"> About </v-subheader>
                    <blockquote class="blockquote">
                        {{ data.info.about }}
                    </blockquote>
                </v-card-text>
            </v-card>
            <br>
            
            <v-card style="padding: 10px;" align-center justify-center class="text-xs-center">
                <v-card-text>
                    <v-subheader style="display: block;"> Contcat </v-subheader>
                    <v-btn fab dark large color="blue" flat  target="_blank"  :href='"https://fb.com/"+data.content.id_facebook'>
                        <v-icon dark>fab fa-facebook-f</v-icon>
                    </v-btn>
                    <v-btn fab dark large color="blue" flat  target="_blank"  :href='"https://t.me/"+data.content.id_telegram'>
                        <v-icon dark>fab fa-telegram  </v-icon>
                    </v-btn>
                    <v-btn v-if='data.content.id_github != "null"' fab dark large color="black" flat  target="_blank"  :href='"https://github.com/"+data.content.id_github'>
                        <v-icon dark>fab fa-github  </v-icon>
                    </v-btn>
                </v-card-text>
            </v-card>
            <br>
            <v-card v-if='data.path' style="padding: 10px;" class="text-xs-center">
                <v-card-text>
                    <v-subheader style="display: block;"> path learn </v-subheader>
                    <v-layout align-center justify-center >
                        <v-breadcrumbs :items='data.path[0].path.split("->")' divider="->">
                            <template v-slot:item="props">
                                <a>{{ `${props.item.trim()} ` }} </a>
                            </template>
                        </v-breadcrumbs>
                    </v-layout>
                    <!-- <v-chip style='font-size: 1rem;' color='blue' v-for='it,i in ' :key='i' text-color="white">
                        {{ it }} -> 
                    </v-chip> -->
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
export default{
    props:['data'],
    data(){
        return {
            dialog: false,
            fab:false
        }
    }
}
</script>
