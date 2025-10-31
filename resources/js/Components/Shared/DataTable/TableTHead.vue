<template>
    <th>
        <span> <slot></slot></span>
        <template v-if="sortable">
            <span @click="onSort" class="ms-2">
                <span v-if="sort.field == name && sort.type == 'asc'" class="bi bi-arrow-up" > </span>
                <span v-else-if="sort.field == name && sort.type == 'desc'" class="bi bi-arrow-down"></span>
                <span v-else class="bi bi-arrow-down-up"> </span>
            </span>
        </template>
    </th>
</template>
<script>
export default {
    props:{
        sortable:{
            type:Boolean,
            default:true
        },
        name:{
            type:String
        },
        sort:{}
    },
    methods:{
        onSort(){
            var type = null
            if(!this.sort.type || this.sort.type=="" || this.sort.field != this.name){
                type = 'asc'
            }
            else if(this.sort.type =='asc'){
                type = 'desc'
            }else{
                type = null
            }
             this.$emit('onSortChange',{ type: type, field:this.name})
        }
    }
}
</script>
