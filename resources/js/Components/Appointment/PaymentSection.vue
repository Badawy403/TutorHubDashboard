<template>
    <div class="mt-3">
        <h5 class="mb-4">Make Payment For Video Call </h5>
        <div  v-if="!paymentDone" class="tabs payment-tabs p-4 rounded-lg shadow ">
            <div class="p-3 mb-4 rounded-lg bg-primary-light">
               <div class="row align-items-center">
                <div class="col-md-6 ">
                    <div class="row ">
                        <div class="col-12">
                            <label class="fs-6">Initial Value</label>
                            <span class="small fw-normal ps-3">$600</span>
                        </div>
                        <div class="col-12">
                            <label class="fs-6">Initial Value</label>
                            <span class="small fw-normal ps-3">$600</span>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <label class="fs-6">Total Payment</label>
                    <span class="small fw-normal ps-3">$1200</span>
                   </div>
               </div>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item me-3" role="presentation">
                <button
                  class="nav-link active"
                  id="pills-home-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-home"
                  type="button"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                >
                  <img src="https://i.imgur.com/sB4jftM.png" width="80" />
                </button>
              </li>
              <li class="nav-item me-3" role="presentation">
                <button
                  class="nav-link"
                  id="pills-profile-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-profile"
                  type="button"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                >
                  <img src="https://i.imgur.com/yK7EDD1.png" width="80" />
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div
                class="tab-pane fade show active"
                id="pills-home"
                role="tabpanel"
                aria-labelledby="pills-home-tab"
              >
                <form action>
                  <div class="row g-4">
                    <div class="col-12">
                      <label>Credit Card</label>
                      <span class="small fw-normal ps-3">Enter the 16 digit card number</span>
                    </div>
                    <div class="col-12">
                      <div class="main-input mb-3">

                        <input type="text" class="form-control" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label>Expiration Date</label>
                      <p class="mb-0 small">Enter the expiration date of card</p>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" value="05" />
                    </div>

                    <div class="col-md-3">
                      <input type="text" class="form-control" value="22" />
                    </div>

                    <div class="col-md-6">
                      <label>Code CVV</label>
                      <p class="mb-0 small">Enter the cvv code of card</p>
                    </div>
                    <div class="col-md-6">
                      <input class="form-control" type="text" />
                    </div>

                    <div class="col-md-6">
                      <label>Password</label>
                      <p class="mb-0 small">Enter the dynamic password</p>
                    </div>

                    <div class="col-md-6">
                      <input type="password" class="form-control" value="123" />
                    </div>

                    <div class="col-12 mt-3">
                      <div class="btn btn-primary" @click="onPayment()">Pay Now</div>
                    </div>
                  </div>
                </form>
              </div>
              <div
                class="tab-pane fade"
                id="pills-profile"
                role="tabpanel"
                aria-labelledby="pills-profile-tab"
              >...</div>
            </div>
          </div>


          <div v-if="paymentDone" class="thank-you-section mt-5">
            <div class="p-3 mb-4 rounded-lg bg-primary-light">
                <div class="row align-items-center">
                <div class="col-12 p-4 text-center">
                    <i class="bi bi-envelope fs-1"></i>
                    <p class="fs-4 mb-0 fw-bold">Thank You</p>
                    <p class="fs-4 mb-0">For Your Payment</p>
                </div>

             </div>
          </div>

          <div class="mt-5 text-center">
            <p class="fs-4 mb-0 fw-bold">Video Call starts in</p>
            <p class="fs-2 text-primary">00:52</p>
            <button class="btn btn-primary">
                Connect Again
            </button>
          </div>
          </div>
    </div>

</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    data() {
        return {
            paymentDone: 0,
        };
    },
    methods: {
        onPayment() {
            this.paymentDone = 1;
        },
    },
});
</script>

<style>
</style>
