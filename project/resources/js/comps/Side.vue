<template>

    <v-navigation-drawer
        v-model="drawer" stateless app>
      <v-list class="pa-1">
        <v-list-tile avatar>

          <v-list-tile-avatar>
            <img src="/images/c4i.png">
          </v-list-tile-avatar>

          <v-list-tile-content>
            <v-list-tile-title> Code For Iraq </v-list-tile-title>
          </v-list-tile-content>

        </v-list-tile>
      </v-list>

      <!-- <v-list class="pt-0" dense>
        <v-divider></v-divider> 
        <v-list-tile v-if='user.active'>
          <v-list-tile-action>
            <v-icon>account_circle</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ `${user.first_name} ${user.last_name}`.toUpperCase() }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-divider></v-divider>  -->

        <v-list-tile  v-for="item in items" :key="item.title" :to='item.href'>
          <!-- @click="$emit('select',`${item.href}`)" -->
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title> {{ item.title }} </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <!-- <v-list-tile v-if='user.active'
          v-for="item in user_items"
          :key="item.title"
          @click="$emit('select',`${item.href}`)">
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>         -->

      </v-list>
    </v-navigation-drawer>
</template>


<script>
export default{
    props:['drawer'], // ,'user'
    data(){
        return{
            items:[
                {title:"Home",icon:"home",href:"/"},
                {title:"About",icon:"question_answer",href:"/about"}
            ],
            user_items:[
                {title:"ProFile",icon:"assignment_ind",href:"tab-profile"},
                {title:"Project",icon:"archive",href:"tab-project"},
                {title:"Setting",icon:"settings_applications",href:"tab-setting"}, 

            ]
        }
    }
}
</script>