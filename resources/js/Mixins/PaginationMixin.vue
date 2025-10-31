<script>
export default {
    created(){
    },
    data() {
        return {
            loading_more:false,
            fetching:true,
            searching:false,
            filter:{
                page:1,
                column:'',
                search:'',
                perPage:6,
                sort:{
                    type: '',
                    field: ''
                }

            },
        }
    },
    methods: {
    async loadMore(){
      this.loading_more = true
      this.filter.page += 1
      await this.getPaginatedData(this.loading_more);
      this.loading_more = false
    },
    async refreshData(){
      this.searching = true
      await this.getPaginatedData();
      this.searching = false
    },
    async onPageChange(params){
      this.searching = true
      this.filter.page = params.page
      await this.getPaginatedData();
      this.searching = false
    },
    async onSearch(params){
      this.searching =true
      this.filter.page = 1
      this.filter = {...this.filter,...params}
      await this.getPaginatedData();
      this.searching = false
    },
    async onSortChange(params) {
             this.searching =true
            if (!params.type){
                this.filter.sort.type = ""
            }else{
                this.filter.sort.type = params.type
            }
            this.filter.sort.field = params.field
            await this.getPaginatedData();
         this.searching = false
    },
    async onOrderChange(){
      this.searching = true
      this.filter.page = 1
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
