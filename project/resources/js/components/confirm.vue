<template>

    <v-dialog v-model="confirm" :max-width="width ? width : '390' ">
        <v-card>
            <!-- <v-card-title class="headline">{{ title  }}</v-card-title> -->
            <v-card-text>  {{ text }} </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat="flat" @click="$emit('close')">
                        Close
                    </v-btn>
                    <v-btn color="green darken-1" flat="flat" @click='$emit("okay")'> 
                        Okay
                    </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>

<script>
export default{
    props:['confirm','text','width']
}
</script>