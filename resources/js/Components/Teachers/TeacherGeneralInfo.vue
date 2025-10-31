<template>
  <form @submit.prevent="submit" class="profileForm">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-12">
            <div class="card border-0 overflow-hidden card-alt" >
              <div class="card-body" style="background: #EFEFEF ">
                <div class="col-12">
                  <div
                    class="d-flex align-items-center justify-content-between mx-3"
                  >
                    <div class="d-flex flex-column" v-if="$page.props.teacher.academy_id">
                      <label for="subscription" class="me-2"
                        ><b>{{ __("academy") }}:</b></label
                      >
                      <span>{{ $page.props.teacher.academy_name }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column align-items-center me-3">
                      <label for="status" class="me-2 mb-1"
                        ><b>{{ __("status") }}:</b></label
                      >

                      <span
                        v-if="
                          $page.props &&
                          $page.props.teacher &&
                          $page.props.teacher.is_active
                        "
                        class="badge bg-active rounded-pill px-3 py-2 fs-5"
                        >{{ __("active") }}</span
                      >
                      <span v-else class="badge bg-inactive px-3  rounded-pill py-2 fs-5">{{
                        __("inactive")
                      }}</span>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                      <label for="subscription" class="me-2 mb-1"
                        ><b>{{ __("Package") }}:</b></label
                      >
                      <span style="background-color: #FFA928;" class="badge rounded-pill px-3 py-2 fs-5 text-capitalize">{{
                        $page.props.teacher.pricing_plan_name ?? "N/A"
                      }}
                       <Link
                        :href="route('pricing', { type: 'teacher' })"
                        class="ms-2"
                        ><i class="bi bi-pencil text-white fw-bold"></i></Link>
                    </span>

                    </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
             <div class="card  mt-4 py-3 card-alt">
              <div class="card-body text-center">
                <label for="teacher-image">
                  <div
                    class="profile-image my-0 p-5 border-primary rounded-3 position-relative"
                    style="border-style: dotted;"
                  >
                    <label for="image" class="mb-3 fs-6 fw-bold text-secondary">{{ __('Upload your') }} <br> {{ __('Profile image') }}</label>

                    <div
                      class="icon m-3 position-absolute z-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                      style="cursor: pointer; width: 40px; height: 40px"
                    >
                      <i class="bi bi-pencil-fill"></i>

                    </div>
                    <img
                      v-if="form.image"
                      class="img-fluid w-100"
                      :src="form.image"
                      alt="logo"
                    />
                    <img
                      v-if="!form.image && $page.props.teacher.image"
                      class="img-fluid w-100"
                      :src="$page.props.teacher.image"
                      alt="logo"
                    />
                    <!-- <img
                      v-if="!form.image && !$page.props.teacher.image"
                      class="img-fluid w-100"
                      src="@/images/account/default_avatar_men.png"
                      alt="logo"
                    /> -->
                  </div>
                  <button
                    data-bs-toggle="modal"
                    id="ImageCropperModalButton"
                    data-bs-target="#imageCropModal"
                    style="display: none"
                  ></button>
                  <ImageCropperModal
                    :show="showImportModal"
                    id="imageCropModal"
                    :image_url="image_url"
                    @cropImage="cropImage"
                  >
                  </ImageCropperModal>
                </label>
                <input
                  id="teacher-image"
                  style="display: none"
                  @change="onFileChange"
                  type="file"
                />
                <!-- <input
                        id="teacher-image"
                        style="display: none"
                        @change="onFileChange"
                        type="file"
                    /> -->
              </div>
            </div>

            <div class="card  mt-4 py-3 card-alt">
              <div class="card-body text-center">
                <label for="teacher-image-cover">
                  <div
                    class="profile-image my-0 p-5 border-primary rounded-3 position-relative"
                    style="border-style: dotted;"
                  >
                    <label for="image" class="mb-3 fs-6 fw-bold text-secondary">{{ __('Upload your') }} <br> {{ __('cover image') }}</label>

                    <div
                      class="icon m-3 position-absolute z-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                      style="cursor: pointer; width: 40px; height: 40px"
                    >
                      <i class="bi bi-pencil-fill"></i>

                    </div>
                    <img
                      v-if="form.cover_image"
                      class="img-fluid w-100"
                      :src="form.cover_image"
                      alt="logo"
                    />
                    <img
                      v-if="!form.cover_image && $page.props.teacher.cover_image"
                      class="img-fluid w-100"
                      :src="$page.props.teacher.cover_image"
                      alt="logo"
                    />
                    <!-- <img
                      v-if="!form.image && !$page.props.teacher.image"
                      class="img-fluid w-100"
                      src="@/images/account/default_avatar_men.png"
                      alt="logo"
                    /> -->
                  </div>
                  <button
                    data-bs-toggle="modal"
                    id="coverImageCropModalButton"
                    data-bs-target="#coverImageCropModal"
                    style="display: none"
                  ></button>
                  <ImageCropperModal
                    :show="showCoverImportModal"
                    id="coverImageCropModal"
                    aspectRatio="1/8"
                    :image_url="cover_image_url"
                    @cropImage="cropCoverImage"
                  >
                  </ImageCropperModal>
                </label>
                <input
                  id="teacher-image-cover"
                  style="display: none"
                  @change="onFileChangeCover"
                  type="file"
                />
                <!-- <input
                        id="teacher-image"
                        style="display: none"
                        @change="onFileChange"
                        type="file"
                    /> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="row">
          <div class="col-12">
            <div class="card card-alt">
              <div class="card-body">
                <h2 class="text-primary fs-2 fw-bold ms-2">
                  {{ __('Basic Info')}}
                </h2>
                <hr />

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="category"
                        >{{ __("choose") }} {{ __("category") }}</label
                      >
                      <Multiselect
                        class="shadow-none h-100 p-2 outline border-0 rounded-3"
                        v-model="form.teacher_categories"
                        valueProp="id"
                        label="name"
                        groupLabel="name"
                        groupOptions="categories"
                        :groupSelect="true"
                        :groups="true"
                        mode="tags"
                        :close-on-select="false"
                        :searchable="true"
                        :options="this.teacher_categories"
                      />
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="speciality">{{
                                                __("speciality")
                                            }}</label>
                                            <input v-model="form.speciality" class="w-100 form-control px-3"
                                                placeholder="Please Enter" type="text" />
                                        </div>
                                    </div> -->
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="experience"
                        >{{ __("choose") }} {{ __("experience") }}</label
                      >
                      <Multiselect
                        class="shadow-none outline border-0 rounded-3 fs-5"
                        v-model="form.experience"
                        :close-on-select="true"
                        :searchable="true"
                        :options="experienceOptions"
                        valueProp="value"
                        label="name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="user_name">{{
                        __("username")
                      }}</label>
                      <input
                        v-model="form.user_name"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label
                        class="mb-2 label-text"
                        for="first_name"
                        >{{ __("first name") }}</label
                      >
                      <input
                        v-model="form.first_name"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="last_name">{{
                        __("last name")
                      }}</label>
                      <input
                        v-model="form.last_name"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="category"
                          >{{ __("choose") }} {{ __n("tag") }}</label
                        >
                        <Multiselect
                          :placeholder="__('please select')"
                          v-model="form.tags"
                          valueProp="id"
                          label="name"
                          mode="tags"
                          class="shadow-none h-100 p-2 outline border-0 rounded-3"
                          :close-on-select="false"
                          :searchable="true"
                          :options="this.tags"
                        />
                      </div>
                  </div>



                  <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="category"
                          >{{ __("choose") }} {{ __n("language") }}</label
                        >
                        <Multiselect
                          :placeholder="__('please select')"
                          v-model="form.languages"
                          valueProp="id"
                          label="name"
                          mode="tags"
                          class="shadow-none h-100 p-2 outline border-0 rounded-3"
                          :close-on-select="false"
                          :searchable="true"
                          :options="this.languages"
                        />
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="country"
                        >{{ __("select") }} {{ __("country") }}</label
                      >
                      <select
                        v-model="form.country_id"
                        @change="getStates()"
                        class="form-select rounded-3 fs-5"
                        aria-label="country"
                      >
                        <option value="null" selected disabled>
                          {{ __("country") }}
                        </option>
                        <option
                          v-for="country in this.countries"
                          :key="country.id"
                          :value="country.id"
                        >
                          {{ country.name }}
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="state"
                        >{{ __("select") }} {{ __("state") }}</label
                      >
                      <select
                        v-model="form.state_id"
                        @change="getCities()"
                        class="form-select rounded-3 fs-5"
                        aria-label="state"
                      >
                        <option value="null" selected disabled>
                          {{ __("state") }}
                        </option>
                        <option
                          v-for="state in this.states"
                          :key="state.id"
                          :value="state.id"
                        >
                          {{ state.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="address"
                        >{{ __("address line") }} 1</label
                      >
                      <textarea
                        v-model="form.address_line_1"
                        class="w-100 auth-input form-control px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="address"
                        >{{ __("address line") }} 2</label
                      >
                      <textarea
                        v-model="form.address_line_2"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      ></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="city"
                        >{{ __("select") }} {{ __("city") }}</label
                      >
                      <select
                        v-model="form.city_id"
                        class="form-select rounded-3 fs-5"
                        aria-label="city"
                      >
                        <option value="null" selected disabled>
                          {{ __("city") }}
                        </option>
                        <option
                          v-for="city in this.cities"
                          :key="city.id"
                          :value="city.id"
                        >
                          {{ city.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 label-text" for="zip_code">{{
                        __("zip code")
                      }}</label>
                      <input
                        v-model="form.zip_code"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3 position-relative">
                      <label
                        class="mb-2 label-text"
                        for="home_phone"
                        >{{ __("home phone") }}</label
                      >
                      <input
                        :disabled="disable_fields"
                        v-model="form.home_phone"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                      <div
                        class="spinner-border position-absolute"
                        ref="home_phone"
                        role="status"
                        style="top: 35px; right: 10px; display: none"
                      >
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3 position-relative">
                      <label
                        class="mb-2 label-text"
                        for="cell_phone"
                        >{{ __("cell phone") }}</label
                      >
                      <input
                        :disabled="disable_fields"
                        v-model="form.cell_phone"
                        class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                      <div
                        class="spinner-border position-absolute"
                        ref="cell_phone"
                        role="status"
                        style="top: 35px; right: 10px; display: none"
                      >
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3 position-relative">
                      <label class="mb-2 label-text" for="job_title">{{
                        __("job title")
                      }}</label>
                      <input
                        :disabled="disable_fields"
                        v-model="form.job_title"
                        class="w-100 form-control auth-input rounded-3 px-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                      <div
                        class="spinner-border position-absolute"
                        ref="job_title"
                        role="status"
                        style="top: 35px; right: 10px; display: none"
                      >
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3 position-relative">
                      <label class="mb-2 label-text" for="website">{{
                        __("website")
                      }}</label>
                      <input
                        :disabled="disable_fields"
                        v-model="form.website"
                        class="w-100 form-control auth-input rounded-3 px-3 fs-5"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                      <div
                        class="spinner-border position-absolute"
                        ref="website"
                        role="status"
                        style="top: 35px; right: 10px; display: none"
                      >
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3 position-relative">
                      <label class="mb-2 label-text" for="company">{{
                        __("company")
                      }}</label>
                      <input
                        :disabled="disable_fields"
                        v-model="form.company"
                        class="w-100 form-control auth-input rounded-3 fs-5 px-3"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                      <div
                        class="spinner-border position-absolute"
                        ref="company"
                        role="status"
                        style="top: 35px; right: 10px; display: none"
                      >
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3 position-relative">
                      <label class="mb-2 label-text" for="email">{{
                        __("email")
                      }}</label>
                      <input
                        :disabled="disable_fields"
                        v-model="form.email"
                        class="w-100 form-control auth-input rounded-3 fs-5 px-3"
                        :placeholder='__("Please Enter")'
                        type="text"
                      />
                      <div
                        class="spinner-border position-absolute"
                        ref="email"
                        role="status"
                        style="top: 35px; right: 10px; display: none"
                      >
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-3">
              <div class="row">
                <div class="col-12">
                  <div class="card card-alt">
                    <div class="card-body">
                      <label
                        class="mb-2 label-text"
                        for="description"
                        >{{ __("description") }}</label
                      >
                      <ul class="nav mb-3 modal-tabs nav-tabs gap-3 px-2 border-bottom  border-1 my-2" id="myTab" role="tablist">
                        <li
                          v-for="(lang, index) in $page.props
                            .translation_languages"
                          :key="lang.id"
                          class="nav-item"
                          role="presentation"
                        >
                          <button
                            :class="{ active: index == 0 }"
                            class="nav-link mr-1 fw-bold"
                            :id="`nav-${lang.code}-tab`"
                            data-bs-toggle="tab"
                            :data-bs-target="`#nav-${lang.code}`"
                            type="button"
                            role="tab"
                            :aria-controls="`nav-${lang.code}`"
                            aria-selected="true"
                          >
                            {{ lang.name }}
                          </button>
                        </li>
                      </ul>
                      <div
                        v-for="(lang, secondIndex) in $page.props
                          .translation_languages"
                        :key="lang.id"
                        class="tab-content mt-1"
                        id="myTabContent"
                      >
                        <div
                          :class="{ 'show active': secondIndex == 0 }"
                          class="tab-pane fade mb-2"
                          :id="`nav-${lang.code}`"
                          role="tabpanel"
                          :aria-labelledby="`nav-${lang.code}-tab`"
                        >
                          <div class="col-md-12">
                            <div class="form-group mb-3 rounded-3">
                              <textarea
                                :class="{
                                  'is-invalid':
                                    form.errors[`description.${lang.code}`],
                                }"
                                v-model="form.description[lang.code]"
                                class="form-control"
                              ></textarea>
                              <span
                                v-if="form.errors[`description.${lang.code}`]"
                              >
                                {{ form.errors[`description.${lang.code}`] }}
                              </span>
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

      <div class="col-12 py-4">
        <div class="profile-page-wizrd">
          <Wizard
            navigable-tabs
            hideButtons
            :custom-tabs="[
              {
                title: 'Home Address',
              },
              {
                title: 'Work Address',
              },
              {
                title: 'Billing Address',
              },
              {
                title: 'Shipping Address',
              },
            ]"
            :beforeChange="onTabBeforeChange"
            @change="onChangeCurrentTab"
          >
            <div v-if="currentTabIndex === 0">
              <div class="card card-alt">
                <div class="card-body p-4">
                  <!-- Home Address -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="country"
                          >{{ __("select") }} {{ __("country") }}</label
                        >
                        <select
                          v-model="form.country_id"
                          @change="getStates()"
                          class="form-select rounded-3 fs-5"
                          aria-label="country"
                        >
                          <option value="null" selected disabled>
                            {{ __("country") }}
                          </option>
                          <option
                            v-for="country in this.countries"
                            :key="country.id"
                            :value="country.id"
                          >
                            {{ country.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="state"
                          >{{ __("select") }} {{ __("state") }}</label
                        >
                        <select
                          v-model="form.state_id"
                          @change="getCities()"
                          class="form-select rounded-3 fs-5"
                          aria-label="state"
                        >
                          <option value="null" selected disabled>
                            {{ __("state") }}
                          </option>
                          <option
                            v-for="state in this.states"
                            :key="state.id"
                            :value="state.id"
                          >
                            {{ state.name }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="city"
                          >{{ __("select") }} {{ __("city") }}</label
                        >
                        <select
                          v-model="form.city_id"
                          class="form-select rounded-3 fs-5"
                          aria-label="city"
                        >
                          <option value="null" selected disabled>
                            {{ __("city") }}
                          </option>
                          <option
                            v-for="city in this.cities"
                            :key="city.id"
                            :value="city.id"
                          >
                            {{ city.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="zip_code">{{ __("zip code") }}</label>
                        <input
                          :disabled="disable_fields"
                          v-model="form.zip_code"
                          class="w-100 form-control auth-input rounded-3 fs-5 px-3"
                          :placeholder='__("Please Enter")'
                          type="text"
                        />
                        <div
                          class="spinner-border position-absolute"
                          ref="zip_code"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 1</label>
                        <div class="input-group-from position-relative">
                          <vue-google-autocomplete
                            id="map"
                            ref="address"
                            enable-geolocation
                            classname="w-100 form-control rounded-3 fs-5 px-3"
                            :placeholder="__('Please Enter')"
                            v-on:inputChange="updateLocation"
                            v-on:placechanged="getAddressData"
                          >
                          </vue-google-autocomplete>
                          <button
                            type="button"
                            class="btn position-absolute shadow-none"
                            style="right: 4px; top: 0px"
                            @click="getCurrentLocation()"
                          >
                            <i class="bi bi-geo-alt-fill"></i>
                          </button>
                        </div>
                        <GMapMap
                          :center="{
                            lat: this.form.latitude,
                            lng: this.form.longitude,
                          }"
                          :zoom="7"
                          class="mt-3"
                          map-type-id="terrain"
                          style="width: 100%; height: 500px"
                        >
                          <GMapMarker
                            @dragend="showInfo"
                            ref="myMarker"
                            @click="openInfoWIndow($event)"
                            :clickable="true"
                            :draggable="true"
                            :position="{
                              lat: this.form.latitude,
                              lng: this.form.longitude,
                            }"
                          />
                        </GMapMap>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 2</label>
                        <textarea
                          :disabled="disable_fields"
                          v-model="form.address_line_2"
                          class="w-100 form-control auth-input rounded-3 fs-5 px-3"
                          :placeholder='__("Please Enter")'
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="address_line_2"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="d-md-flex justify-content-end">
                      <button
                        type="button"
                        @click="onChangeCurrentTab(1)"
                        class="btn btn-primary"
                      >
                        {{ __("Next") }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="currentTabIndex === 1">
              <div class="card card-alt">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group mb-3">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-check form-switch">
                            <input
                              class="form-check-input"
                              v-model="billing_same_address"
                              @change="makeSameAddress('billing')"
                              type="checkbox"
                              role="switch"
                              id="CoCreationSwitch"
                            />
                            <label
                              class="form-check-label label-text"
                              for="CoCreationSwitch"
                              >{{ __("same as home address") }}?</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <!-- Billing Address -->
                      <div class="form-group mb-3">
                        <label
                         class="mb-2 label-text"
                         for="country"
                          >{{ __("select") }} {{ __("country") }}</label
                        >
                        <select
                          v-model="form.billing_country_id"
                          @change="getBillingStates()"
                          class="form-select rounded-3 fs-5"
                          aria-label="country"
                        >
                          <option value="null" selected disabled>
                            {{ __("country") }}
                          </option>
                          <option
                            v-for="country in this.countries"
                            :key="country.id"
                            :value="country.id"
                          >
                            {{ country.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="state"
                          >{{ __("select") }} {{ __("state") }}</label
                        >
                        <select
                          v-model="form.billing_state_id"
                          @change="getBillingCities()"
                          class="form-select rounded-3 fs-5"
                          aria-label="state"
                        >
                          <option value="null" selected disabled>
                            {{ __("state") }}
                          </option>
                          <option
                            v-for="state in this.billing_states"
                            :key="state.id"
                            :value="state.id"
                          >
                            {{ state.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="city"
                          >{{ __("select") }} {{ __("city") }}</label
                        >
                        <select
                          v-model="form.billing_city_id"
                          class="form-select rounded-3 fs-5"
                          aria-label="city"
                        >
                          <option value="null" selected disabled>
                            {{ __("city") }}
                          </option>
                          <option
                            v-for="city in this.billing_cities"
                            :key="city.id"
                            :value="city.id"
                          >
                            {{ city.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="zip_code">{{ __("zip code") }}</label>
                        <input
                          :disabled="disable_fields"
                          v-model="form.billing_zip_code"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        />
                        <div
                          class="spinner-border position-absolute"
                          ref="billing_zip_code"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 1</label>
                        <textarea
                          v-model="form.billing_address_line_1"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder="__('Please Enter')"
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="billing_address_line_1"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 2</label>
                        <textarea
                          :disabled="disable_fields"
                          v-model="form.billing_address_line_2"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="billing_address_line_2"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="d-md-flex gap-2 justify-content-end">
                        <button
                          type="button"
                          @click="onChangeCurrentTab(0)"
                          class="btn btn-dark"
                        >
                          {{ __("Back") }}
                        </button>

                        <button
                          type="button"
                          @click="onChangeCurrentTab(2)"
                          class="btn btn-primary"
                        >
                          {{ __("Next") }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="currentTabIndex === 2">
              <div class="card card-alt">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 mb-3">
                      <div class="form-check form-switch">
                        <input
                          class="form-check-input"
                          v-model="shipping_same_address"
                          @change="makeSameAddress('shipping')"
                          type="checkbox"
                          role="switch"
                          id="CoCreationSwitch"
                        />
                        <label class="form-check-label label-text" for="CoCreationSwitch"
                          >{{ __("same as home address") }}?</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="country"
                          >{{ __("select") }} {{ __("country") }}</label
                        >
                        <select
                          v-model="form.shipping_country_id"
                          @change="getShippingStates()"
                          class="form-select rounded-3 fs-5"
                          aria-label="country"
                        >
                          <option value="null" selected disabled>
                            {{ __("country") }}
                          </option>
                          <option
                            v-for="country in this.countries"
                            :key="country.id"
                            :value="country.id"
                          >
                            {{ country.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="state"
                          >{{ __("select") }} {{ __("state") }}</label
                        >
                        <select
                          v-model="form.shipping_state_id"
                          @change="getShippingCities()"
                          class="form-select rounded-3 fs-5"
                          aria-label="state"
                        >
                          <option value="null" selected disabled>
                            {{ __("state") }}
                          </option>
                          <option
                            v-for="state in this.shipping_states"
                            :key="state.id"
                            :value="state.id"
                          >
                            {{ state.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="city"
                          >{{ __("select") }} {{ __("city") }}</label
                        >
                        <select
                          v-model="form.shipping_city_id"
                          class="form-select rounded-3 fs-5"
                          aria-label="city"
                        >
                          <option value="null" selected disabled>
                            {{ __("city") }}
                          </option>
                          <option
                            v-for="city in this.shipping_cities"
                            :key="city.id"
                            :value="city.id"
                          >
                            {{ city.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="zip_code">{{ __("zip code") }}</label>
                        <input
                          :disabled="disable_fields"
                          v-model="form.shipping_zip_code"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        />
                        <div
                          class="spinner-border position-absolute"
                          ref="shipping_zip_code"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label for="address">{{ __("address line") }} 1</label>
                        <textarea
                          :disabled="disable_fields"
                          v-model="form.shipping_address_line_1"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="shipping_address_line_1"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 2</label>
                        <textarea
                          :disabled="disable_fields"
                          v-model="form.shipping_address_line_2"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="shipping_address_line_2"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="d-md-flex gap-2 justify-content-end">
                        <button
                          type="button"
                          @click="onChangeCurrentTab(1)"
                          class="btn btn-dark"
                        >
                          {{ __("Back") }}
                        </button>
                        <button
                          type="button"
                          @click="onChangeCurrentTab(3)"
                          class="btn btn-primary"
                        >
                          {{ __("Next") }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="currentTabIndex === 3">
              <div class="card card-alt">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 mb-3">
                      <div class="form-check form-switch">
                        <input
                          :disabled="disable_fields"
                          class="form-check-input label-text"
                          v-model="work_same_address"
                          @change="makeSameAddress('work')"
                          type="checkbox"
                          role="switch"
                          id="CoCreationSwitch"
                        />
                        <label class="form-check-label" for="CoCreationSwitch"
                          >{{ __("same as home address") }}?</label
                        >
                        <div
                          class="spinner-border position-absolute"
                          ref="work_same_address"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="country"
                          >{{ __("select") }} {{ __("country") }}</label
                        >
                        <select
                          v-model="form.work_country_id"
                          @change="getWorkStates()"
                          class="form-select rounded-3 fs-5"
                          aria-label="country"
                        >
                          <option value="null" selected disabled>
                            {{ __("country") }}
                          </option>
                          <option
                            v-for="country in this.countries"
                            :key="country.id"
                            :value="country.id"
                          >
                            {{ country.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="state"
                          >{{ __("select") }} {{ __("state") }}</label
                        >
                        <select
                          v-model="form.work_state_id"
                          @change="getWorkCities()"
                          class="form-select rounded-3 fs-5"
                          aria-label="state"
                        >
                          <option value="null" selected disabled>
                            {{ __("state") }}
                          </option>
                          <option
                            v-for="state in this.work_states"
                            :key="state.id"
                            :value="state.id"
                          >
                            {{ state.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="mb-2 label-text" for="city"
                          >{{ __("select") }} {{ __("city") }}</label
                        >
                        <select
                          v-model="form.work_city_id"
                          class="form-select rounded-3 fs-5"
                          aria-label="city"
                        >
                          <option value="null" selected disabled>
                            {{ __("city") }}
                          </option>
                          <option
                            v-for="city in this.work_cities"
                            :key="city.id"
                            :value="city.id"
                          >
                            {{ city.name }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="zip_code">{{ __("zip code") }}</label>
                        <input
                          :disabled="disable_fields"
                          v-model="form.work_zip_code"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        />
                        <div
                          class="spinner-border position-absolute"
                          ref="work_zip_code"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 1</label>
                        <textarea
                          :disabled="disable_fields"
                          v-model="form.work_address_line_1"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder="__('Please Enter')"
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="work_address_line_1"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group mb-3 position-relative">
                        <label class="mb-2 label-text" for="address">{{ __("address line") }} 2</label>
                        <textarea
                          :disabled="disable_fields"
                          v-model="form.work_address_line_2"
                          class="w-100 form-control auth-input px-3 rounded-3 fs-5"
                          :placeholder='__("Please Enter")'
                          type="text"
                        ></textarea>
                        <div
                          class="spinner-border position-absolute"
                          ref="work_address_line_2"
                          role="status"
                          style="top: 35px; right: 10px; display: none"
                        >
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </div>
                    </div>



                    <div class="col-12">
                      <div class="d-md-flex justify-content-end">
                        <button
                          type="button"
                          @click="onChangeCurrentTab(2)"
                          class="btn btn-dark"
                        >
                          {{ __("Back") }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Work Address -->
            </div>
          </Wizard>
        </div>
      </div>

      <div class="col-12 text-end pe-md-4">
        <button
          type="submit"
          :disabled="form.processing"
          class="submit btn btn-primary"
        >
          <SpinnerLoader v-if="form.processing" />
          {{ __("Update Profile") }}
        </button>
      </div>
    </div>
  </form>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import TeacherExperiences from "@/Components/Teachers/Experiences/TeacherExperiences.vue";
import TeacherEducations from "@/Components/Teachers/Educations/TeacherEducations.vue";

import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import VueGoogleAutocomplete from "vue-google-autocomplete";

export default defineComponent({
  components: {
    Head,
    ValidationErrors,
    Link,
    SpinnerLoader,
    ImageCropperModal,
    Multiselect,
    VueGoogleAutocomplete,
    TeacherExperiences,
    TeacherEducations,
  },
  props: ["active", "teacher"],
  async mounted() {
    this.formExperienceOptions();

    await this.locatorButtonPressed();
    await this.$refs.address.update(this.$page.props.teacher.address_line_1);
    this.form.latitude = parseFloat(this.$page.props.teacher.latitude);
    this.form.longitude = parseFloat(this.$page.props.teacher.longitude);
    if (!this.form.latitude && !this.form.longitude) {
      this.form.latitude = this.location_data.lat ?? -34.6161385;
      this.form.longitude = this.location_data.lng ?? -58.39748470000001;
    }
  },
  data() {
    return {
      currentTabIndex: 0,
      active_tab: null,
      billing_same_address: false,
      shipping_same_address: false,
      work_same_address: false,
      form: this.$inertia.form({
        teacher_categories: this.$page.props.teacher.teacher_category_ids ?? "",
        country_id: this.$page.props.teacher.country_id,
        experience: this.$page.props.teacher.experience ?? "",
        speciality: this.$page.props.teacher.speciality ?? "",
        state_id: this.$page.props.teacher.state_id,
        city_id: this.$page.props.teacher.city_id,
        first_name: this.$page.props.teacher.first_name,
        last_name: this.$page.props.teacher.last_name,
        description:
          this.$page.props.teacher.description_translations.length == 0
            ? {}
            : this.$page.props.teacher.description_translations,
        languages: this.$page.props.teacher.language_ids,
        tags: this.$page.props.teacher.tag_ids,
        prefix: this.$page.props.teacher.prefix,
        suffix: this.$page.props.teacher.suffix,
        home_phone: this.$page.props.teacher.home_phone,
        cell_phone: this.$page.props.teacher.cell_phone,
        job_title: this.$page.props.teacher.cell_phone,
        company: this.$page.props.teacher.company,
        website: this.$page.props.teacher.website,
        email: this.$page.props.teacher.email,

        state_id: this.$page.props.teacher.state_id,
        city_id: this.$page.props.teacher.city_id,
        address_line_1: this.$page.props.teacher.address_line_1,
        latitude: this.$page.props.teacher.latitude,
        longitude: this.$page.props.teacher.longitude,
        address_line_2: this.$page.props.teacher.address_line_2,
        zip_code: this.$page.props.teacher.zip_code,
        billing_country_id: this.$page.props.teacher.billing_country_id,
        billing_state_id: this.$page.props.teacher.billing_state_id,
        billing_city_id: this.$page.props.teacher.billing_city_id,
        billing_address_line_1: this.$page.props.teacher.billing_address_line_1,
        billing_address_line_2: this.$page.props.teacher.billing_address_line_2,
        billing_zip_code: this.$page.props.teacher.billing_zip_code,
        shipping_country_id: this.$page.props.teacher.shipping_country_id,
        shipping_state_id: this.$page.props.teacher.shipping_state_id,
        shipping_city_id: this.$page.props.teacher.shipping_city_id,
        shipping_address_line_1:
          this.$page.props.teacher.shipping_address_line_1,
        shipping_address_line_2:
          this.$page.props.teacher.shipping_address_line_2,
        shipping_zip_code: this.$page.props.teacher.shipping_zip_code,
        work_country_id: this.$page.props.teacher.work_country_id,
        work_state_id: this.$page.props.teacher.work_state_id,
        work_city_id: this.$page.props.teacher.work_city_id,
        work_address_line_1: this.$page.props.teacher.work_address_line_1,
        work_address_line_2: this.$page.props.teacher.work_address_line_2,
        work_zip_code: this.$page.props.teacher.work_zip_code,
        icon: null,
        image: null,
        cover_image: null,
        user_name: this.$page.props.teacher.user_name,
        is_co_creation: this.$page.props.teacher.is_co_creation ? true : false,
        is_out_of_office: this.$page.props.teacher.is_out_of_office
          ? true
          : false,
        is_energy_exchange: this.$page.props.teacher.is_energy_exchange
          ? true
          : false,
        is_hide_location: this.$page.props.teacher.is_hide_location
          ? true
          : false,
      }),
      image_url: null,
      cover_image_url: null,
      showImportModal: false,
      showCoverImportModal: false,
      croppedImageSrc: null,
      croppedCoverImageSrc: null,
      countries: this.$page.props.countries,
      states: this.$page.props.states,
      cities: this.$page.props.cities,
      teacher_categories: this.$page.props.teacher_categories,
      billing_states: this.$page.props.billing_states,
      billing_cities: this.$page.props.billing_cities,
      shipping_states: this.$page.props.shipping_states,
      shipping_cities: this.$page.props.shipping_cities,
      work_states: this.$page.props.work_states,
      work_cities: this.$page.props.work_cities,
      teacher_categories: this.$page.props.teacher_categories,
      languages: this.$page.props.languages,
      tags: this.$page.props.tags,
      disable_fields: false,
      experienceOptions: [],
    };
  },

  methods: {
    showInfo(info) {
      this.form.latitude = info.latLng.lat();
      this.form.longitude = info.latLng.lng();
    },
    autoUpdateProfile(elementRef) {
      this.disable_fields = true;
      this.$refs[elementRef].style.display = "block";
      this.autoUpdate(this.$refs[elementRef]);
    },
    async getCurrentLocation() {
      this.form.latitude = this.location_data.lat ?? -34.6161385;
      this.form.longitude = this.location_data.lng ?? -58.39748470000001;
      if (this.form.latitude && this.form.longitude) {
        var user_address = await this.getStreetAddressFrom(
          this.form.latitude,
          this.form.longitude
        );
        this.$refs.address.update(user_address);
      }
    },
    makeSameAddress(type) {
      if (type == "billing" && this.billing_same_address) {
        this.form.billing_country_id = this.form.country_id;
        this.billing_states = this.states;
        this.form.billing_state_id = this.form.state_id;
        this.billing_cities = this.cities;
        this.form.billing_city_id = this.form.city_id;
        this.form.billing_address_line_1 = this.form.address_line_1;
        this.form.billing_address_line_2 = this.form.address_line_2;
        this.form.billing_zip_code = this.form.zip_code;
      }
      if (type == "shipping" && this.shipping_same_address) {
        this.form.shipping_country_id = this.form.country_id;
        this.shipping_states = this.states;
        this.form.shipping_state_id = this.form.state_id;
        this.shipping_cities = this.cities;
        this.form.shipping_city_id = this.form.city_id;
        this.form.shipping_address_line_1 = this.form.address_line_1;
        this.form.shipping_address_line_2 = this.form.address_line_2;
        this.form.shipping_zip_code = this.form.zip_code;
      }
      if (type == "work" && this.work_same_address) {
        this.form.work_country_id = this.form.country_id;
        this.work_states = this.states;
        this.form.work_state_id = this.form.state_id;
        this.work_cities = this.cities;
        this.form.work_city_id = this.form.city_id;
        this.form.work_address_line_1 = this.form.address_line_1;
        this.form.work_address_line_2 = this.form.address_line_2;
        this.form.work_zip_code = this.form.zip_code;
      }
    },
    updateLocation(address) {
      this.form.address_line_1 = address.newVal;
    },
    getAddressData: function (addressData, placeResultData, id) {
      this.form.latitude = addressData.latitude;
      this.form.longitude = addressData.longitude;
      this.form.address_line_1 = addressData.route;
      // this.address = addressData;
    },
    onFileChange(e) {
      this.image_url = null;
      const file = e.target.files[0];
      this.image_url = URL.createObjectURL(file);
      this.croppedImageSrc = null;
      this.showImportModal = true;
    },
    onFileChangeCover(e) {
      this.cover_image_url = null;
      const file = e.target.files[0];
      this.cover_image_url = URL.createObjectURL(file);
      this.croppedCoverImageSrc = null;
      this.showCoverImportModal = true;
    },
    cropImage(image) {
      this.croppedImageSrc = image;
      this.form.image = image;
      this.image_url = null;
      this.showImportModal = false;
    },
    cropCoverImage(image) {
      this.croppedCoverImageSrc = image;
      this.form.cover_image = image;
      this.cover_image_url = null;
      this.showCoverImportModal = false;
    },

    getStates() {
      this.form.state_id = null;
      this.form.city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.country_id,
          })
        )
        .then((res) => {
          this.states = res.data.data;
        });
    },
    getCities() {
      this.form.city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.country_id,
            state_id: this.form.state_id,
          })
        )
        .then((res) => {
          this.cities = res.data.data;
        });
    },
    getBillingStates() {
      this.form.billing_state_id = null;
      this.form.billing_city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.billing_country_id,
          })
        )
        .then((res) => {
          this.billing_states = res.data.data;
        });
    },
    getBillingCities() {
      this.form.billing_city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.billing_country_id,
            state_id: this.form.billing_state_id,
          })
        )
        .then((res) => {
          this.billing_cities = res.data.data;
        });
    },
    getShippingStates() {
      this.form.shipping_state_id = null;
      this.form.shipping_city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.shipping_country_id,
          })
        )
        .then((res) => {
          this.shipping_states = res.data.data;
        });
    },
    getShippingCities() {
      this.form.shipping_city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.shipping_country_id,
            state_id: this.form.shipping_state_id,
          })
        )
        .then((res) => {
          this.shipping_cities = res.data.data;
        });
    },
    getWorkStates() {
      this.form.work_state_id = null;
      this.form.work_city_id = null;
      axios
        .get(
          this.route("account.getStates", {
            country_id: this.form.work_country_id,
          })
        )
        .then((res) => {
          this.work_states = res.data.data;
        });
    },
    getWorkCities() {
      this.form.work_city_id = null;
      axios
        .get(
          this.route("account.getCities", {
            country_id: this.form.work_country_id,
            state_id: this.form.work_state_id,
          })
        )
        .then((res) => {
          this.work_cities = res.data.data;
        });
    },
    autoUpdate(refElement) {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("teachers.update_general_info"), {
          preserveScroll: true,
          onSuccess: () => {
            refElement.style.display = "none";
            this.disable_fields = false;
          },
          onError: () => {
            refElement.style.display = "none";
            this.disable_fields = false;
          },
        });
    },
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("teachers.update_general_info"), {
          onSuccess: () => {
            this.goToNextTab();
          },
        });
    },
    goToNextTab() {
      this.$inertia.visit(route("account"), {
        data: { active_tab: "social-info" },
      });
    },
    onChangeCurrentTab(index) {

      this.currentTabIndex = index;
    },
    onTabBeforeChange() {
      if (this.currentTabIndex === 0) {
      }
    },
    async formExperienceOptions() {
      var options = [
        { value: "", name: this.__("choose") + this.__(" experience") },
      ];
      for (let i = 1; i < 40; i++) {
        if (i == 1) {
          var obj = { value: i, name: i + " year" };
        } else {
          var obj = { value: i, name: i + " years" };
        }
        options.push(obj);
      }
      this.experienceOptions = options;
    },
  },
  computed: {
    minDate() {
      const today = new Date().toISOString().split("T")[0];
      return today;
    },
  },
});
</script>


<style scoped>

.outline {
  outline: none;
}

input[type="text"]::placeholder {
  font-size: 12px;
}
</style>
<!-- <style src="@vueform/multiselect/themes/default.css"></style> -->
