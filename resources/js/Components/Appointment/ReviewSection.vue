<template>
  <div class="mt-3">
    <h5 class="mb-3">Write a Review</h5>
    <div class="p-4 rounded-lg shadow">
      <div class="px-3 py-2 mb-3 rounded-md bg-primary-light">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h6 class="mb-0">Communication</h6>
          </div>

          <div class="col-md-6 text-center">
            <div class="rating fs-3 text-warning">
              <star-rating
                :rating="4"
                :star-size="20"
                :read-only="true"
                :increment="0.01"
                :show-rating="false"
              ></star-rating>
            </div>
          </div>
        </div>
      </div>

      <div class="px-3 py-2 mb-4 rounded-md bg-primary-light">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h6 class="mb-0">Communication</h6>
          </div>

          <div class="col-md-6 text-center">
            <div class="rating fs-3 text-warning">
              <star-rating
                :rating="4"
                :star-size="20"
                :read-only="true"
                :increment="0.01"
                :show-rating="false"
              ></star-rating>
            </div>
          </div>
        </div>
      </div>

      <div>
        <form action>
          <div class="row g-4">
            <div class="col-md-6">
              <label class="mb-2">Name</label>
              <input type="text" class="form-control" />
            </div>

            <div class="col-md-6">
              <label class="mb-2">Email</label>
              <input type="email" class="form-control" />
            </div>

            <div class="col-12">
              <label class="mb-2">Message</label>
              <textarea class="form-control" cols="20" rows="5"></textarea>
            </div>

            <div class="col-12 mt-3">
              <div class="btn btn-primary">Pay Now</div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
