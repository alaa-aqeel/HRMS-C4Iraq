<template>
    <v-speed-dial  bottom right open-on-hover fixed
            v-model="fab" 
            direction='top' 
            transition='slide-x-reverse-transition'>
            
        <v-btn dark fab
            v-model="fab"
            slot="activator"
            color="blue darken-2">
            <v-icon>account_circle</v-icon>
            <v-icon>close</v-icon>
        </v-btn>

        <v-btn fab dark small color="green">
            <v-icon>edit</v-icon>
        </v-btn>
        <v-btn fab dark small color="indigo">
            <v-icon>add</v-icon>
        </v-btn>

        <v-btn fab dark small color="red">
            <v-icon>md-facebook</v-icon>
        </v-btn>
    </v-speed-dial>
</template>


<script>

    export default{
        data(){
            return{
                fab: false,
            }
        }
    }

</script>


