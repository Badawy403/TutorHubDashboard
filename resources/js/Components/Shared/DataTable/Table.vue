<template>
        <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body flex-column flex-md-row mx-0 mx-md-2 border-bottom d-flex justify-content-between align-items-start align-items-md-center">
                            <h3 class="card-title mb-0 text-primary fs-2 fw-bold">
                                <slot name="TableHeaderTitle">
                                </slot>
                            </h3>
                            <div >
                                <slot name="TableHeaderButtons">
                                </slot>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table  table-striped  table-borderless admin-table" >
                                <thead class="bg-primary text-white text-center">
                                    <slot name="TableTheadRow">
                                    </slot>
                                </thead>
                                <tbody class="text-center">
                                    <slot name="TableBody">
                                    </slot>
                                </tbody>

                            </table>
                            <slot name="Pagination">
                            </slot>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
</template>



<style scoped>

</style>
