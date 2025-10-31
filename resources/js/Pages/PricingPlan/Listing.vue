<template>
  <app-layout title="Pricing Plan">
    <template #header>
      <!-- Page Heading -->
    </template>
    <template #default>
      <div class="container-fluid bg-primary py-5">
        <div class="row">
          <div
            class="col-12 d-flex flex-column align-content-center justify-content-center"
          >
            <!-- <h2 class="fs-2 text-center">
              <span
                v-if="
                  $page.props &&
                  $page.props.auth &&
                  $page.props.auth.user &&
                  $page.props.auth.user.name
                "
                class="fw-normal"
                >{{ __("Hello") }} {{ $page.props.auth.user.name }} |
              </span> -->
            <h2 class="fw-bolder text-center text-white display-1" >
              {{ __("subscription plans") }}
            </h2>
                <p class="fs-4 text-center text-white">Our team of highly skilled attorneys comprises seasoned
                professionals
                with extensive experience in their respective fields. We pride ourselves<br> on recruiting top legal
                talent,
                ensuring that you receive the highest standard of representation. From complex litigation to intricate.
              </p>
          </div>
        </div>
      </div>

        <div class="py-5">
            <div class="container">
            <div class="row">
                <div class="col-12">

                <div class="table-responsive">
                <table class="table table-striped table-borderless">
                <thead>
                <tr>
                    <th scope="col">
                        <h5 class="text-primary pb-4 pb-md-5 fw-bold" style="font-size: 25px;">
                        {{ __("choose your") }} <br />
                        {{ __('plan') }}<span class="text-secondary fw-semibold fs-5 ms-1">/{{ __('month') }}</span>
                        </h5>
                    </th>
                    <th v-for="pricing_plan in pricing_plans"
                    :key="pricing_plan.id" scope="col" class="text-center">
                    <h5 class="fs-3 fw-bolder text-secondary my-1">
                      {{ pricing_plan.name }}
                    </h5>
                    <h5
                      class="fs-3 fw-bold text-primary mb-2"
                    >
                      {{ getDisplayAmount(pricing_plan.price) }}<span class="text-secondary">{{ __("/month") }}</span><br>
                       <span v-if="!pricing_plan.is_paid">
                        ({{ __("free") }})</span>
                    </h5>
                    <Link
                      v-if="
                        $page.props.auth &&
                        ($page.props.auth.logged_in_as == 'teacher' ||
                          $page.props.auth.logged_in_as == 'academy') &&
                        $page.props.auth.user[pricing_plan.type]
                          .pricing_plan_id == pricing_plan.id
                      "
                      :href="
                        route('pricing.show', {
                          type: pricing_plan.type,
                          slug: pricing_plan.slug,
                        })
                      "
                      class="btn btn-primary fs-6 my-2 rounded-pill"
                      >{{ __("Subscribed") }}
                    </Link>
                    <Link
                      v-else
                      :href="
                        route('pricing.show', {
                          type: pricing_plan.type,
                          slug: pricing_plan.slug,
                        })
                      "
                      class="btn btn-primary fs-6 my-2 rounded-pill"
                      >{{ __("Get This Plan") }}</Link
                    >
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="module in modules" :key="module.id">
                    <th scope="row" class="py-2">
                        {{ __(module.display_name) }}
                    </th>
                    <td v-for="pricing_plan in pricing_plans"
                  :key="pricing_plan.id"
                  class="py-2"
                  >
                       <i
                          v-if="
                            pricing_plan.modules.includes(module.module_code)
                          "
                          class="bi fs-2 bi-check text-success d-flex justify-content-center"
                        ></i>
                        <i v-else class="bi fs-2 bi-x d-flex text-danger justify-content-center"></i>

                    </td>
                </tr>
                </tbody>
                </table>

                </div>
                </div>
            </div>

        </div>
        </div>

      <!-- <div class="container">
        <div class="row py-5">
          <div class="col-12 d-flex flex-row align-items-center justify-content-center">
            <div class="row mt-4">
              <div class="col-4">
                <h5 class="text-primary mt-4 fw-bold ms-2" style="font-size: 25px;">
                  Choose your <br />
                  plan<span class="text-secondary fw-semibold fs-5 ms-1">/month</span>
                </h5>
                <ul class="liststyle">
                  <li v-for="module in modules" :key="module.id" class="categories">
                    {{ module.display_name }}
                  </li>
                </ul>
              </div>

              <div class="col-8 d-flex flex-row justify-content-evenly">
                <div
                  class="card bg-transparent"
                  style="width: 180px"
                  v-for="pricing_plan in pricing_plans"
                  :key="pricing_plan.id"
                >
                  <div class="card-body text-center">
                    <h5 class="card-title fs-3 fw-bolder text-secondary my-1">
                      {{ pricing_plan.name }}
                    </h5>
                    <h5
                      class="card-title fs-3 fw-bold text-primary mb-4"
                    >
                      {{ getDisplayAmount(pricing_plan.price) }}<span class="text-secondary">{{ __("/month") }}</span>
                       <span v-if="!pricing_plan.is_paid">
                        ({{ __("free") }})</span>
                    </h5>
                    <Link
                      v-if="
                        $page.props.auth &&
                        ($page.props.auth.logged_in_as == 'teacher' ||
                          $page.props.auth.logged_in_as == 'academy') &&
                        $page.props.auth.user[pricing_plan.type]
                          .pricing_plan_id == pricing_plan.id
                      "
                      :href="
                        route('pricing.show', {
                          type: pricing_plan.type,
                          slug: pricing_plan.slug,
                        })
                      "
                      class="btn btn-sm  btn-primary fs-6 rounded-pill"
                      >{{ __("Subscribed") }}
                    </Link>
                    <Link
                      v-else
                      :href="
                        route('pricing.show', {
                          type: pricing_plan.type,
                          slug: pricing_plan.slug,
                        })
                      "
                      class="btn btn-sm btn-primary fs-6 rounded-pill"
                      >{{ __("Get This Plan") }}</Link
                    >

                    <ul
                      class="list-group list-group-flush border-0 d-flex flex-column justify-content-center align-content-center"
                    >
                      <li
                        v-for="(module,index) in modules"
                        :key="module.id"
                        class="list-group-item bg-warning"
                        :class="{ 'bg-transparent': index % 2 != 0 }"
                      >
                        <i
                          v-if="
                            pricing_plan.modules.includes(module.module_code)
                          "
                          class="bi fs-2 bi-check text-success d-flex justify-content-center"
                        ></i>
                        <i v-else class="bi fs-2 bi-x d-flex text-danger justify-content-center"></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <!-- <div class="section pt-0 pricing-plan">
        <div class="container">
          <div class="row">
            <div class="col-12"></div>
            <div
              class="col-12 d-flex justify-content-center align-items-center"
              v-if="
                !$page.props.auth ||
                ($page.props.auth.logged_in_as != 'teacher' &&
                  $page.props.auth.logged_in_as != 'academy')
              "
            > -->
              <!-- <ul
                class="nav nav-pills nav-pills-c mt-4 rounded-pill p-3 text-center d-flex align-items-center justify-content-center"
                id="profileTabs"
                role="tablist"
              >
                <li class="nav-item" role="presentation">
                  <Link
                    :href="route('pricing', { type: 'teacher' })"
                    class="nav-link nav-link-c text-dark fw-bold rounded-pill"
                    :class="{ active: type == 'teacher' }"
                    type="button"
                    role="tab"
                    >{{ __n("teacher") }}
                  </Link>
                </li>
                v-if="hasModule('test')"
                <li class="nav-item" role="presentation">
                  <Link
                    :href="route('pricing', { type: 'academy' })"
                    class="nav-link nav-link-c text-dark fw-bold rounded-pill"
                    :class="{ active: type == 'academy' }"
                    type="button"
                    role="tab"
                    >{{ __n("academy") }}
                  </Link>
                </li>
              </ul> -->
            <!-- </div> -->
            <!-- <div class="col-12">
              <div class="row justify-content-center">
                <div
                  class="col-md-3 mt-5"
                  v-for="pricing_plan in pricing_plans"
                  :key="pricing_plan.id"
                >
                  <div class="card bg-transparent price-card">
                    <div class="card-body px-0 pb-2">
                      <span
                        class="position-absolute"
                        style="top: -20px; right: -20px"
                        v-if="
                          $page.props.auth &&
                          ($page.props.auth.logged_in_as == 'teacher' ||
                            $page.props.auth.logged_in_as == 'academy') &&
                          $page.props.auth.user[pricing_plan.type]
                            .pricing_plan_id == pricing_plan.id
                        "
                        ><i
                          class="bi display-1 text-success bi-check-circle-fill"
                        ></i
                      ></span>
                      <div class="px-3">
                        <h4 class="fw-bold card-title mb-0">
                          <span class="fw-bold fs-5">{{
                            pricing_plan.name
                          }}</span
                          ><span v-if="!pricing_plan.is_paid">
                            ({{ __("free") }})</span
                          >
                        </h4>
                         <p class="card-text mb-2 fs-6">{{ pricing_plan.tagline }}</p> -->
                        <!-- <div class="py-2 mb-1 fs-4 fw-bold">
                          {{ getDisplayAmount(pricing_plan.price) }}/<span
                            style="font-size: 14px"
                            class="fw-normal"
                            >{{ __("month") }}</span
                          >
                        </div>
                      </div>

                      <ul class="ps-0 mb-0">
                        <li
                          v-for="(module, index) in modules"
                          :key="module.id"
                          class="bg-light py-2 px-2 mb-1 d-flex justify-content-between align-items-center position-relative"
                          :class="{ 'bg-opacity-25': index % 2 != 0 }"
                        >
                          <div class="d-flex align-items-center">
                            <i
                              v-if="
                                pricing_plan.modules.includes(
                                  module.module_code
                                )
                              "
                              class="bi fs-2 bi-check text-success d-flex"
                            ></i>
                            <i
                              v-else
                              class="bi fs-2 bi-x d-flex text-danger"
                            ></i>
                            <span class="ms-2 pe-4">{{
                              module.display_name
                            }}</span>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4">
                      <Link
                        v-if="
                          $page.props.auth &&
                          ($page.props.auth.logged_in_as == 'teacher' ||
                            $page.props.auth.logged_in_as == 'academy') &&
                          $page.props.auth.user[pricing_plan.type]
                            .pricing_plan_id == pricing_plan.id
                        "
                        :href="
                          route('pricing.show', {
                            type: pricing_plan.type,
                            slug: pricing_plan.slug,
                          })
                        "
                        class="btn btn-secondary text-white py-2 w-100"
                        >{{ __("subscribed") }}
                      </Link>
                      <Link
                        v-else
                        :href="
                          route('pricing.show', {
                            type: pricing_plan.type,
                            slug: pricing_plan.slug,
                          })
                        "
                        class="btn btn-primary py-2 w-100"
                        >{{ __("get this plan") }}</Link
                      >
                    </div>
                  </div>
                </div>
              </div> -->
            <!-- </div> -->
          <!-- </div>
        </div>
      </div>  -->
    </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    Link,
  },
  props: ["pricing_plans", "modules"],
  mounted() {},
  data() {
    return {
      type: route().params.type,
    };
  },
  created() {},
});
</script>

<style scoped>
.nav-pills-c {
  background-color: #f3f3f3 !important;
  width: fit-content !important;
}
.nav-link-c.active {
  box-shadow: 2px 3px 7px #b5b5b5 !important;
}

.categories {
  list-style: none;
  color: #535353;
  font-size: 16px;
  margin-bottom: 20px;
  font-weight: 600;
}

.liststyle {
    margin-top: 91px;
    margin-left: -25px;
}

.btn-sm {
  height: 32px;
  width: 140px;
  padding-top: 7px;

}
.list-group {
  margin-top: 24px;
}
.list-group li {
  border: none;
  margin-bottom: 6px;
  width: 180px;
  margin-left: -16px;
}

</style>
