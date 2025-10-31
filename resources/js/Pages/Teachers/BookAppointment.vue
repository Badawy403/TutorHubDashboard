<template>

  <app-layout title="Appointment">
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="d-flex justify-content-center align-items-center">
                <ul
              class="nav justify-content-center mb-4"
              id="appointmentTab"
              role="tablist"
            >
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link px-4"
                  disabled
                  id="info-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#info-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="info-tab-pane"
                  aria-selected="true"
                >
                  <div class="d-flex flex-column">
                    <span
                      class="rounded-circle border border-primary d-flex align-items-center text-black justify-content-center  m-auto"
                      style="width: 80px; height: 80px"
                      :class="{ 'bg-primary text-white': currentTabIndex == 0 || currentTabIndex == 1 || currentTabIndex == 2 }"
                    >
                    <i class="bi bi-calendar2-day-fill display-6"></i>
                    </span>

                    <span class="text-primary mt-1 fw-bold fs-1">{{
                      __("Schedule Appointment")
                    }}</span>
                    <p class="fs-6 text-secondary mt-1">
                      Our team of highly skilled attorneys <br />comprises
                      seasoned professionals
                    </p>
                  </div>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link px-4"
                  disabled
                  id="payment-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#payment-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="payment-tab-pane"
                  aria-selected="false"
                >
                  <div class="d-flex flex-column">
                    <span
                      class="rounded-circle border border-primary d-flex justify-content-center text-black align-items-center  m-auto"
                      style="width: 80px; height: 80px"
                      :class="{ 'bg-primary text-white':  currentTabIndex == 1 || currentTabIndex == 2 }"
                    >
                    <i class="bi bi-credit-card-fill display-6 "></i>
                    </span>

                    <span class="text-primary mt-1 fs-1 fw-bold">{{
                      __("Make a Payment")
                    }}</span>
                    <p class="fs-6 mt-1 text-secondary">
                      Our team of highly skilled attorneys<br />comprises
                      seasoned professionals.
                    </p>
                  </div>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link px-4"

                  disabled
                  id="final-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#final-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="final-tab-pane"
                  aria-selected="false"
                >
                  <div class="d-flex flex-column">
                    <span
                      class="rounded-circle border border-primary d-flex align-items-center text-black justify-content-center  m-auto"
                      style="width: 80px; height: 80px"
                      :class="{ 'bg-primary text-white': currentTabIndex == 2 }"

                >
                <i class="bi bi-check-lg display-6"></i>
                </span>
                    <span class="fs-1 mt-1 fw-bold text-primary">{{
                      __("Booking Confirmation")
                    }}</span>
                    <p class="fs-6 mt-1 text-secondary">
                      Our team of highly skilled attorneys<br />comprises
                      seasoned professionals.
                    </p>
                  </div>
                </button>
              </li>
            </ul>
            </div>

            <div class="tab-content" id="appointmentTabContent">
              <div
                class="tab-pane fade"
                :class="{ 'show active': currentTabIndex == 0 }"
                id="info-tab-pane"
                role="tabpanel"
                aria-labelledby="info-tab"
                tabindex="0"
              >
                <!-- <div class="row" v-if="fetching">
                  <div class="col-md-12">
                    <div class="skeleton-structure">
                      <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-end">
                          <div
                            style="width: 160px; height: 40px"
                            class="bg-skeleton mb-2 p-3 rounded-5"
                          ></div>
                        </div>
                      </div>
                      <div class="row">
                        <div
                          class="card shadow p-3 border-0"
                          style="max-width: initial"
                        >
                          <div
                            style="width: 180px; height: 20px"
                            class="bg-skeleton mb-2 p-3 me-2 rounded-2 mb-4"
                          ></div>

                          <div>
                            <ul class="list-unstyled d-flex flex-wrap">
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                              <li
                                style="width: 160px; height: 50px"
                                class="bg-skeleton mb-2 p-3 me-2 rounded-5"
                              ></li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                          <div
                            style="width: 160px; height: 40px"
                            class="bg-skeleton mb-2 p-3 rounded-5"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->

                <div class="row" v-if="!paymentScreen">
                  <div class="col-md-4 mb-4" v-if="is_schedule_required">
                    <div class="card h-100">
                      <div class="card-body">
                        <h3 class="fw-bold ms-md-5 ms-2 text-primary fs-4 mb-3 py-2">
                          {{ __("Select the Date") }}
                        </h3>
                        <VueDatePicker
                          auto-apply
                          inline
                          :scroll="false"
                          v-model="selected_date"
                          :enable-time-picker="false"
                          :min-date="new Date()"
                          @update:model-value="fetchAvailableSlots"
                        >
                        </VueDatePicker>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8 mb-4"  v-if="is_schedule_required" >
                    <div class="card shadow-sm h-100">
                      <div class="card-body ms-3">
                        <h3 class="fw-bold text-primary fs-4 mb-3 py-2">
                          {{ __("Book a time slots") }}
                        </h3>
                        <div
                          class="position-relative h-100 pt-3"
                        >
                          <div v-if="fetchedSchedule" style="margin: -8px">
                            <ul
                              class="list-unstyled mb-0 lists"

                            >
                              <li
                                class="d-inline-block me-3 li"
                                v-for="(
                                  slot, index
                                ) in fetchedSchedule.schedule_slots"
                                :key="index"
                              >
                                <button
                                  type="button"
                                  class="btn shadow-sm rounded-3 px-2 "
                                  :class="{
                                    'btn-primary':
                                      selected_slot_index === index,
                                    'bg-danger text-white pe-none ':
                                      slot.is_disabled,
                                  }"
                                  :disabled="slot.is_disabled"
                                  @click="selectSlot(index, slot)"
                                >
                                  {{ slot.start_time }} - {{ slot.end_time}}
                                </button>
                              </li>
                            </ul>
                          </div>
                          <div
                            v-else
                            class="position-absolute top-50 start-50 translate-middle"
                          >
                            <div class="text-center">
                              <i
                                class="bi bi-exclamation-circle-fill fs-1 text-primary"
                              ></i>
                              <p class="fw-normal">
                                {{
                                  __(
                                    "schedule is not available against this date"
                                  )
                                }}
                              </p>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <div class="col-md-12 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="fw-bold text-primary fs-4 my-3 ms-0 ms-md-4">
                          {{ __("ask your question") }}
                        </h3>
                        <div class="mb-3 ms-md-3 mx-md-5">
                        <textarea
                          id="question"
                          class="form-control bg-warning text-black"
                          v-model="form.question"
                          cols="50"
                          rows="6"
                        ></textarea>

                        </div>
                        <label for="form-group" class="mb-3 ms-0 ms-md-4 fw-bold text-primary">{{   __("attachment") }}</label>
                        <div class="form-group file-select ms-0 py-1 ms-md-4 me-md-5 d-flex align-items-center mb-0">
                        <div class="d-flex align-items-center">
                        <label for="attachment_file" class="btn btn-secondary text-white px-5 ms-0 ms-md-2">{{ __("Select a File") }}</label>
                        <input
                            class="custom-file-input"
                            placeholder="Please Enter"
                            type="file"
                            id="attachment_file"
                            ref="attachment_file"
                            @change="processFile($event)"
                            name="attachment_file"
                            style="display: none;"
                          />
                          <img
                            v-if="attachment_view"
                            :src="attachment_view"
                            height="70"
                            width="70"
                            class="ms-3 rounded-4"
                          />
                        </div>
                          <label class="me-2" style="font-size: 14px;" for="info">{{__('certificate file validation')}}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card shadow-sm">
                      <div class="card-body px-md-5">
                        <div class="row align-items-center">
                          <div
                            class="col-md-3 border-end"
                          >
                            <div class="d-flex ms-0 ms-md-2 gap-4 align-items-center">
                                <img v-if="teacher.image" class="profile rounded-4" :src="teacher.image" alt="profile img">
                                <img v-else class="profile rounded-4" src="@/images/account/default_avatar_men.png"/>
                               <!-- <i class="bg-primary rounded-3 p-4"></i> -->
                              <div
                                class="d-flex py-2 mb-2 flex-column"
                                style="width: fit-content"
                              >
                                <div >
                                    <span class="fs-4 text-primary fw-bold"
                                      >{{ teacher.first_name ?? "" }}
                                      {{ teacher.last_name ?? "" }}</span
                                    >
                                </div>
                                <span class="fw-semibold text-secondary fs-5 mt-1">{{ teacher.experience }} Year Experience</span>
                              </div>

                            </div>
                          </div>
                          <div
                            class="col-md-3 border-end "
                          >
                            <div class="d-flex py-2 justify-content-start justify-content-md-center">
                              <div
                                class="d-flex flex-column"
                                style="width: fit-content"
                              >
                                <div class="fs-5 text-primary">
                                  <span class="fw-bold text-secondary"
                                    >{{ __("Appointment Type") }}: &nbsp;</span
                                  >
                                  {{
                                    fetchedSchedule
                                      ? getDisplayAmount(fetchedSchedule.fee)
                                      : ""
                                  }}
                                </div>
                                <div class="fs-5 mt-2 text-primary">
                                  <span class="fw-bold text-secondary"
                                    >{{ __("fee") }}: &nbsp;</span
                                  >
                                  {{
                                    fetchedSchedule
                                      ? getDisplayAmount(fetchedSchedule.fee)
                                      : ""
                                  }}
                                </div>
                              </div>
                            </div>
                          </div>

                          <div
                            class="col-md-3"
                          >
                            <div class="d-flex justify-content-start justify-content-md-center">
                              <div
                                class="d-flex flex-column"
                                style="width: fit-content"
                              >
                                <div class="fs-5 text-primary">
                                  <span class="fw-bold text-secondary"
                                    >{{ __("Date") }}: &nbsp;</span
                                  >
                                  {{ getFormattedDate(selected_date) }}
                                </div>
                                <div v-if="selected_start_time" class="fs-5 mt-2 text-primary">
                                  <span class="fw-bold text-secondary"
                                    >{{ __("Time") }}: &nbsp;</span
                                  >
                                  {{ selected_start_time }} -
                                  {{ selected_end_time }}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="d-flex justify-content-end pe-0 pe-md-4 mt-3 mt-md-0">
                              <div
                                class="d-flex flex-column continue"

                              >
                                <button

                                  type="button"
                                  class="btn btn-primary rounded-pill px-5 fw-bold"
                                  :disabled="
                                    !form.selected_schedule_id &&
                                    is_schedule_required
                                  "
                                  @click="
                                    continuePaymentScreen(),
                                      onChangeCurrentTab(1)
                                  "
                                >
                                  {{ __("Continue") }}
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="tab-pane"
                :class="{ 'show active': currentTabIndex == 1 }"
                id="payment-tab-pane"
                role="tabpanel"
                aria-labelledby="payment-tab"
                tabindex="0"
              >
                <div class="row">
                  <!-- <div class="col-md-6">
                    <div class="card border border-1 shadow-sm border-info bg-transparent">
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-content-center">
                            <h3 class="fw-bold text-primary fs-1 mb-3"> {{ __("Select Payment Methods") }} </h3>
                            <div class="d-flex gap-2 ">
                            <button class= "btn btn-info btn-sm  rounded-5" @click=prev>Prev</button>
                            <button class="btn btn-primary btn-sm  rounded-5" @click=next>Next</button>

               </div>


 </div>


                   </div>

                    </div>
                  </div> -->

                  <div class="col-md-7">
                    <div
                      class="card bg-transparent border border-info border-1 p-3"
                    >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <span class="fw-bold fs-2 ps-3 py-3 text-primary">{{
                              __("Select Payment Methods")
                            }}</span>

                            <!-- <span class="fs-5">{{ teacher.first_name ?? "" }} {{ teacher.last_name ?? ""}}</span> -->
                          </div>
                          <div class="col-12 mt-4">
                            <Carousel

                              ref="carousel"
                              v-model="currentSlide"
                              :key="key"
                              :settings="settings"
                              :breakpoints="breakpoints"
                            >
                              <Slide
                                v-for="(gateway, index) in gateways"
                                :key="index"
                              >
                                <div
                                  :class="{
                                    'border border-1 border-primary rounded-3':
                                      form.gateway == gateway.code,
                                  }"
                                  @click="this.form.gateway = gateway.code"
                                >
                                  <div
                                    class="d-flex align-content-center justify-content-around bg-white py-2 rounded-3 payment-icons"
                                  >
                                    <img
                                      class=""
                                      :src="gateway.image"
                                      :alt="gateway.name"
                                    />
                                  </div>
                                  <h6 class="fs-6 mt-2 text-center fw-bold">
                                    {{ gateway.name }}
                                  </h6>
                                </div>
                              </Slide>

                              <template #addons>
                                <Navigation />
                              </template>


                            </Carousel>

                            <hr />
                          </div>

                          <!-- <div class="col-12">

                            <div class="d-flex justify-content-between mb-2">
                             <input class="fs-4 border-0 py-2 rounded-3 ps-3 shadow-lg" type="text" placeholder="Card Details" style="width: 210px;"/>
                             <input class="fs-4 border-0 py-2 rounded-3 ps-3 shadow-lg" type="text" placeholder="Cvv" style="width: 140px;"/>
                             <input class="fs-4 border-0 py-2 rounded-3 ps-3 shadow-lg" type="text" placeholder="Expiry Date" style="width: 140px;"/>
                            </div>



                            </div> -->

                          <div
                            class="col-12 mt-2 mb-5 text-center align-content-center"
                            v-if="parseInt($page.props.settings.enable_wallet_system)"
                          >
                            <button
                             @click="{form.gateway = 'wallet'; addFundRequest()}"
                              class="btn rounded-3 text-primary fw-bold fs-4 btn-sm btn-white"
                            >
                              <span class="mx-2"
                                ><img
                                  src="@/images/icons/wallet.png"
                                  width="20"
                                  height="20"
                              /></span>
                              {{  __("complete your transaction using your wallet") }}
                            </button>
                          </div>

                          <div class="d-grid mb-2">
                            <button
                            @click="addFundRequest" :disabled="form.processing || !form.gateway"
                              class="btn btn-primary rounded-pill fw-bold fs-3"
                            >
                             {{ __("Pay Now") }}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="card mt-4 mt-md-0 p-md-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <span class="fw-bold fs-2 ps-2 py-3 text-primary">{{
                              __("Your Appointment Summary")
                            }}</span>

                            <!-- <span class="fs-5">{{ teacher.first_name ?? "" }} {{ teacher.last_name ?? ""}}</span> -->

                            <hr />
                            <div class="col-12 px-2">
                              <div
                                class="d-flex justify-content-between align-content-center py-2"
                              >
                                <div>
                                  <span
                                    class="fw-bolder text-secondary fs-5 d-block mb-1"
                                    >{{ __("Selected Tutor") }}</span
                                  >
                                  <span class="fs-5 text-secondary d-block">{{ teacher.first_name ?? "" }}
                                      {{ teacher.last_name ?? "" }}</span>
                                </div>
                                <div>
                                  <img class="img-fluid" src="@/images/icons/User.png" />
                                </div>
                              </div>
                            </div>
                            <hr />
                            <div class="col-12 px-2">
                              <div
                                class="d-flex justify-content-between align-content-center py-2"
                              >
                                <div>
                                  <span
                                    class="fw-bolder text-secondary fs-5 d-block mb-1"
                                    >{{ __("Date and Time") }}</span
                                  >
                                  <span class="fs-5 text-secondary d-block"> {{ getFormattedDate(selected_date) }} </span>
                                </div>

                                <div>
                                  <img class="img-fluid" src="@/images/icons/calendar.png" />
                                </div>
                              </div>
                            </div>
                            <hr />

                            <div class="col-12 px-2">
                              <div
                                class="d-flex justify-content-between align-content-center py-2"
                              >
                                <div>
                                  <span
                                    class="fw-bolder text-secondary fs-5 d-block mb-1"
                                    >{{ __("Selected Payment Method") }}</span
                                  >
                                  <span
                                     v-if="form.gateway"
                                    class="fs-5 text-secondary d-block"
                                    >{{ form.gateway.toUpperCase() }}</span
                                  >
                                </div>

                                <div>
                                  <img class="img-fluid" src="@/images/icons/payment.png" />
                                </div>
                              </div>
                            </div>
                            <hr />
                            <div class="col-12 py-2">
                              <span
                                class="fw-bold px-2 d-block text-secondary fs-5"
                                >{{ __("Total Fees") }}</span
                              >
                              <span
                                class="fs-2 px-2 fw-bold d-block text-primary"
                                >{{
                                  fetchedSchedule
                                    ? getDisplayAmount(fetchedSchedule.fee)
                                    : ""
                                }}</span
                              >
                            </div>
                          </div>
                          <!-- <span class="fs-5">{{ getFormattedDate(selected_date)}}</span> -->
                          <!-- <div class="col-12  px-3 d-flex flex-row justify-content-between align-content-center">

                                <div class="d-flex flex-column ">
                                    <span class="fw-bold me-3">{{ __("Date and Time") }}</span>
                                <span class="fw-bold me-3">{{ __("16th January 2024") }}</span>
                                </div> -->
                          <!-- <span class="fs-5">{{ selected_start_time }} to {{ selected_end_time }}</span> -->
                          <!-- </div> -->

                          <!-- <div class="col-12">
                                <span class="fw-bold me-3">{{ __("fee") }}</span>
                                <span class="fs-5">{{fetchedSchedule ? getDisplayAmount(fetchedSchedule.fee) : '' }}</span>
                            </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-md-2">
                      <button type="button" class="btn btn-primary" @click="onChangeCurrentTab(0),  this.paymentScreen = false;">{{ __("back") }}</button>
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-primary"  @click="addFundRequest" :disabled="form.processing || !form.gateway">
                                {{ __("make payment") }}
                    </button>
                  </div>
                  <div class="col-md-2">
                    <button type="button" @click="this.form.gateway = 'wallet'" class="btn btn-info ms-3">
                                {{ __("Pay Using Wallet") }}
                    </button>
                  </div> -->
                </div>
              </div>
              <div
                class="tab-pane"
                :class="{ 'show active': currentTabIndex == 2 }"
                id="final-tab-pane"
                role="tabpanel"
                aria-labelledby="final-tab"
                tabindex="0"
              >
                <div v-if="paymentDone" class="thank-you-section mt-5">
                  <div class="p-3 mb-4 rounded-lg bg-primary-light">
                    <div
                      class="row justify-content-center align-content-center"
                    >
                      <div class="col-md-7">
                        <div
                          class="card bg-transparent border border-info border-1"
                        >
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12 p-4 text-center">
                                <img
                                  src="@/images/icons/thankyou.png"
                                  width="160"
                                  height="160"
                                />
                                <p class="fs-1 mb-1 fw-bold">
                                  {{ __("thank you") }}
                                </p>
                                <p class="fs-5 mb-0">
                                  {{ __('Your payment has been completed.') }}<br />
                                  {{ __("Click the button below to view your appointment log.") }}
                                </p>
                                <!-- {{ __("For Your Payment") }} {{ fetchedSchedule ? getDisplayAmount(fetchedSchedule.fee) : '' }} -->
                                <!-- <p class="fs-4 mb-0">
                                {{ __("Appointment No") }} {{ bookedAppointmentDetail.id }}
                                </p>
                                <p class="fs-4 mb-0">
                                {{ __("Payment Status") }}: Paid
                                </p> -->

                                <div class="d-grid mt-5 mb-3 text-center">
                                  <Link
                                    :href="route('appointment_log')"
                                    class="btn btn-sm px-2 btn-primary"
                                  >
                                    <span class="circle" aria-hidden="true">
                                      <span class="icon arrow"></span>
                                    </span>
                                    <span class="button-text fs-5">{{
                                      __("View Appointment Log")
                                    }}</span>
                                  </Link>
                                </div>
                              </div>

                              <!-- <div class="col-12 mt-5 text-center">
                                   <button @click="
                                    continuePaymentScreen(), onChangeCurrentTab()" class="btn rounded-pill w-100 btn-sm btn-primary fw-bold fs-4" >View Appointment Log</button>
                            </div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12">
                                <span class="fw-bold fs-2 ps-2 text-primary">{{
                                  __("Your Appointment Summary")
                                }}</span>
                                <!-- <span class="fs-5">{{ teacher.first_name ?? "" }} {{ teacher.last_name ?? ""}}</span> -->
                                <hr />

                                <div class="col-12 px-2">
                                  <div
                                    class="d-flex justify-content-between align-content-center"
                                  >
                                    <div>
                                      <span
                                        class="fw-bolder text-secondary fs-5 d-block"
                                        >{{ __("Selected Tutor") }}</span
                                      >
                                      <span
                                        class="fs-5 text-secondary d-block"
                                        >{{ teacher.first_name ?? "" }} {{ teacher.last_name ?? "" }}</span
                                      >
                                    </div>
                                    <div>
                                      <img src="@/images/icons/User.png" />
                                    </div>
                                  </div>
                                </div>

                                <hr />
                                <div class="col-12 px-2">
                                  <div
                                    class="d-flex justify-content-between align-content-center"
                                  >
                                    <div>
                                      <span
                                        class="fw-bolder text-secondary fs-5 d-block"
                                        >{{ __("Date and Time") }}</span
                                      >
                                      <span
                                        class="fs-5 text-secondary d-block" >{{ getFormattedDate(selected_date) }} </span>
                                    </div>

                                    <div>
                                      <img src="@/images/icons/calendar.png" />
                                    </div>
                                  </div>
                                </div>
                                <hr />

                                <div class="col-12 px-2">
                                  <div
                                    class="d-flex justify-content-between align-content-center"
                                  >
                                    <div>
                                      <span
                                        class="fw-bolder text-secondary opacity-50 fs-5 d-block"
                                        >{{
                                          __("Selected Payment Method")
                                        }}</span
                                      >
                                      <span v-if="form.gateway"
                                        class="fs-5 text-secondary opacity-50 d-block"
                                        >{{form.gateway.toUpperCase() }}</span
                                      >
                                    </div>

                                    <div>
                                      <img src="@/images/icons/payment.png" />
                                    </div>
                                  </div>
                                </div>
                                <hr />
                                <div class="col-12">
                                  <span
                                    class="fw-bold px-2 d-block text-secondary fs-5"
                                    >{{ __("Total Fees") }}</span
                                  >
                                  <span
                                    class="fs-2 px-2 fw-bold d-block text-primary"
                                    >{{
                                    fetchedSchedule
                                        ? getDisplayAmount(fetchedSchedule.fee)
                                        : ""
                                    }}</span
                                  >
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import CalenderSkeleton from "@/Components/Skeleton/CalenderSkeleton.vue";
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";

export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    ValidationErrors,
    CalenderSkeleton,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  props: [
    "schedule",
    "teacher_id",
    "appointment_type_id",
    "is_schedule_required",
    "teacher",
    "appointment_type_name",
    "gateways",
  ],
  created() {
    this.selected_date = ref(new Date());
    this.fetchedSchedule = this.schedule;
    if (route().params.paymentSuccess) {
      this.bookedAppointmentDetail.id = route().params.appointmentId;
      this.onChangeCurrentTab(2);
      this.paymentDone = true;
    }
  },
  data() {
    return {
      transaction: null,
      cardElement: {},
      currentTabIndex: 0,
      selected_date: "",
      paymentScreen: false,
      fetchedSchedule: "",
      fetching: false,
      selected_slot_index: "",
      selected_start_time: "",
      selected_end_time: "",
      attachment_view: "",
      form: this.$inertia.form({
        selected_schedule_id: "",
        teacher_id: this.teacher_id,
        date: this.selected_date,
        appointment_type_id: this.appointment_type_id,
        question: "",
        attachment: "",
        gateway: null
      }),
      windowWidth: window.innerWidth,
      isMobileScreen: true,
      paymentDone: true,
      bookedAppointmentDetail: {},
      settings: {
        itemsToShow: 1,
        snapAlign: "start",
        autoplay: false,
      },
      // breakpoints are mobile firstTop Featured Teachers
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 2,
          snapAlign: "start",
        },
        // 1024 and up
        1024: {
          itemsToShow: 2,
          snapAlign: "start",
        },
        1240: {
          itemsToShow: 4,
          snapAlign: "start",
        },
      },
      key: 1,
    };
  },
    methods: {

    addFundRequest() {
      this.form.date = this.selected_date;
      this.form.post(this.route("students.book_appointment"), {
        onSuccess: (resp) => {
          if (this.form.gateway == "wallet") {
            this.bookedAppointmentDetail = resp.props.response_data.appointment;
            this.onChangeCurrentTab(3);
            this.paymentDone = true;
          } else {
            window.location.replace(
              this.route("user.addFund.confirm", {
                transaction: resp.props.response_data.fund.transaction,
              })
            );
            this.bookedAppointmentDetail = resp.props.response_data.appointment;
            this.onChangeCurrentTab(3);
            this.paymentDone = true;
          }
        },
      });
    },
    onChangeCurrentTab(index, oldIndex) {
      this.currentTabIndex = index;
      this.key++;
    },
    fetchAvailableSlots() {
      this.form.selected_schedule_id = "";
      this.selected_slot_index = "";
      this.selected_start_time = "";
      this.selected_end_time = "";
      this.fetching = true;
      axios
        .get(
          this.route("getApiAppointmentScheduleSlots", {
            selected_date: this.selected_date,
            teacher_id: this.teacher_id,
            appointment_type_id: this.appointment_type_id,
          })
        )
        .then((res) => {
          this.fetchedSchedule = res.data.data ?? "";
          this.fetching = false;
        });
    },
    selectSlot(index, slot) {
      if (
        this.form.selected_schedule_id &&
        this.form.selected_schedule_id == slot.id
      ) {
        this.form.selected_schedule_id = "";
        this.selected_slot_index = "";
        this.selected_start_time = "";
        this.selected_end_time = "";
      } else {
        this.form.selected_schedule_id = slot.id;
        this.selected_slot_index = index;
        this.selected_start_time = slot.start_time;
        this.selected_end_time = slot.end_time;
      }
    },
    processFile(event) {
      this.form.attachment = event.target.files[0];
      if (event.target.files[0].type.includes("image")) {
        this.attachment_view = URL.createObjectURL(event.target.files[0]);
      } else {
        this.attachment_view = "";
      }
    },
    async continuePaymentScreen() {
      this.onChangeCurrentTab(0);
      this.paymentScreen = true;
    },
    onResize() {
      this.windowWidth = window.innerWidth;
      if (this.windowWidth < 768) {
        this.isMobileScreen = false;
      }
    },
  },

  mounted() {
    this.key++;
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },
});
</script>


<style scoped>
.btn{
    font-size:12px !important;
}

</style>



