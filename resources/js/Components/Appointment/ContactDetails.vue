<template>
    <div>
        <h5 class="mb-3">Please Enter Your Details </h5>
        <form action>
          <div class="row g-4">
            <div class="col-md-6">
            <label class="form-label required">First Name</label>
              <input
                type="text"
                class="form-control"
                required
              />
            </div>
            <div class="col-md-6">
                <label class="form-label required">Last Name</label>
              <input
                type="text"
                required
                class="form-control"
              />
            </div>

            <div class="col-md-6">
                <label class="form-label required">Email</label>
              <input
                type="email"
                required
                class="form-control"
              />
            </div>


            <div class="col-md-6">
                <label class="form-label required">Phone</label>
              <input
                type="text"
                required
                class="form-control"
              />
            </div>

            <div class="col-md-6">
                <label class="form-label required">State</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
            </div>


            <div class="col-md-6">
                <label class="form-label required">City</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
            </div>

            <div class="col-12">
                <div class="d-flex">
                    <label class="form-label required">Do you have documents with you?</label>
                    <div class="form-check ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                         Yes
                        </label>
                      </div>
                      <div class="form-check ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                         No
                        </label>
                      </div>
                </div>

            </div>



          </div>

        </form>
      </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
