<template>
  <app-layout title="Pricing Plan">
    <template #header>
      <!-- Page Heading -->
    </template>
    <template #default>
      <div class="container-fluid py-5 border-bottom border-dark">
        <div class="row">
          <div class="col-12">
            <h2 class="fs-2 text-center">


              <span class="fw-normal">{{ __("Pricing Plan") }} | </span>
              <span class="fw-bold" v-if="!subscribed">{{ 'you have selected' }}</span>
              <span class="fw-bold" v-else>{{ 'already subscribed' }}</span>
            </h2>
            <p class="text-center mb-0">{{ __("discover The Best Teachers Near You") }}</p>
          </div>
        </div>
      </div>
      <div class="section pricing-plan">
        <div class="container">
          <div class="row">

            <div class="col-12">
              <div class="row justify-content-center">
                <div class="col-md-4">

                  <div class="card bg-transparent border-0">
                    <div class="card-body rounded" style="background-color: #f4f4f4;">
                      <h5 class="text-center mb-0" style="color: #744fb9">
                        {{ __("subscription") }}
                      </h5>
                      <h4 class="card-title text-center">
                        <span class="fw-bold fs-1">{{ pricing_plan.name }}</span><span v-if="!pricing_plan.is_paid">({{
                          __("free") }})</span>
                      </h4>
                      <p class="card-text text-center">{{ pricing_plan.tagline }}</p>
                      <div class="tag text-center py-2 text-white fs-3 rounded-pill"
                        :style="{ backgroundColor: pricing_plan.color || '#6c757d' }">
                          {{ getDisplayAmount(pricing_plan.price) }}/{{ __("month") }}
                      </div>
                    </div>

                    <!-- <div class="card-footer p-3 border-0 bg-white"
                                            style="border-radius: 0 0 30px 30px; margin: 0 40px;">
                                            <button class="btn btn-primary rounded-pill text-white py-2 w-100">{{ __('get this plan') }}</button>
                                        </div> -->

                    <div class="alert alert-success mt-3" v-if="subscribed" role="alert">you are already subscribed to
                      this plan</div>
                  </div>



                </div>

                <div class="col-md-5" v-if="!subscribed">
                  <form @submit.prevent="submit" id="payment-form">
                    <input type="hidden" name="pricing_plan" id="pricing_plan" value="{{ $pricing_plan->id }}" />

                    <div class="px-lg-4" v-if="pricing_plan.is_paid">
                      <!-- <div class="px-lg-4"> -->
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group mb-4">
                            <label for="name">Name</label>
                            <input type="text" v-mode="form.name" class="form-control" placeholder="Name on the card" />
                          </div>

                          <div class="form-group mb-4">
                            <label for="card-element">Card details</label>
                            <div class="form-control" id="card-element"></div>
                          </div>

                          <button type="submit" :disabled="form.processing" class="btn btn-primary" id="card-button"
                            data-secret="{{ $intent->client_secret }}">
                            Purchase
                          </button>
                        </div>
                      </div>


                    </div>
                    <div class="px-lg-4" v-else>
                      <p>lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac scelerisque ante. Curabitur
                        vehicula sagittis sem, eget pellentesque augue congue eget. Nulla facilisi. In sapien lectus,
                        aliquam a risus vitae, faucibus maximus massa. Mauris tempus sed neque quis pulvinar. Pellentesque
                        sed lacus egestas, </p>
                      <button type="submit" class="btn btn-primary" id="card-button"
                        data-secret="{{ $intent->client_secret }}">
                        Purchase
                      </button>
                    </div>

                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { loadStripe } from "@stripe/stripe-js";
export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
  },
  props: ["pricing_plan", "modules", "intent"],
  async mounted() {
    if (this.$page.props.auth.user[this.pricing_plan.type].pricing_plan_id == this.pricing_plan.id) {
      this.subscribed = true
    }
    if (this.pricing_plan.is_paid) {
        if (this.$page.props.settings.stripe_key) {
            const stripe_key = this.$page.props.settings.stripe_key;
            this.stripe = await loadStripe(stripe_key);
            const elements = this.stripe.elements();
            this.cardElement = elements.create("card", {
                classes: {
                base: "",
                },
            });
            this.cardElement.mount("#card-element");
        }

    }
  },
  data() {
    return {
      stripe: {},
      subscribed: false,
      cardElement: {},
      form: this.$inertia.form({
        token: "",
      }),
    };
  },
  created() { },
  methods: {
    async submit() {
      if (this.pricing_plan.is_paid) {
        const { setupIntent, error } = await this.stripe.confirmCardSetup(
          this.intent.client_secret,
          {
            payment_method: {
              card: this.cardElement,
              billing_details: {
                name: this.form.name,
              },
            },
          }
        );

        if (error) {
          this.$toast.error(error.message);
        } else {
          this.form.token = setupIntent.payment_method;
          this.form.post(
            this.route("pricing.subscription", {
              type: this.pricing_plan.type,
              slug: this.pricing_plan.slug,
            }),
            {
              onSuccess: () => {
              },
            }
          );
        }
      } else {
        this.form.post(
          this.route("pricing.subscription", {
            type: this.pricing_plan.type,
            slug: this.pricing_plan.slug,
          }),
          {
            onSuccess: () => {
            },
          }
        );
      }
    },
  },
});
</script>
