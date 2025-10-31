<script>
export default {
    created(){
    },
    data() {
        return {
            filter:{
                page:1,
                perPage:10,
            },
        }
    },
    methods: {
    async onPageChange(params){
      this.searching = true
      this.filter.page = params.page
      await this.getPaginatedData();
      this.searching = false
    },

    async onPerPageChange(){
      this.searching = true
      this.pagination.page = 1
      await this.getPaginatedData();
      this.searching = false
    }
    },
}
</script>
