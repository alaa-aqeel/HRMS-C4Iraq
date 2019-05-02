<template>
    <v-tabs-items v-model="currentItem" >

        <v-tab-item value="tab-home">
            <home-comp img='/images/4f.png'></home-comp>
        </v-tab-item> 
         
        <v-tab-item  value="tab-about">
            <about-comp></about-comp>
        </v-tab-item> 

        <v-tab-item  value="tab-profile">
            <profile-pro></profile-pro>
        </v-tab-item> 

        <v-tab-item value="tab-project" >
            <project-page :user='user'></project-page>
        </v-tab-item> 

        <v-tab-item value="tab-setting" >
            <setting-comp :user='user'></setting-comp>
        </v-tab-item> 
        
    </v-tabs-items>
</template>


<script>
    export default{
        props:['currentItem','user']
    }
</script>


