<template>
    <div>
        <div class="row mb-5">
            <div class="col">
                <div
                    class="card p-4 border-0 bg-primary-light shadow rounded-md text-center"
                >
                    <div class="fs-3 text-primary fw-bold">50+</div>
                    <span class="fs-5"> {{ __("total") }}</span>
                </div>
            </div>

            <div class="col">
                <div
                    class="card p-4 border-0 bg-primary-light shadow rounded-md text-center"
                >
                    <div class="fs-3 text-primary fw-bold">2</div>
                    <span class="fs-5"> {{ __("today") }}</span>
                </div>
            </div>

            <div class="col">
                <div
                    class="card p-4 border-0 bg-primary-light shadow rounded-md text-center"
                >
                    <div class="fs-3 text-primary fw-bold">10</div>
                    <span class="fs-5"> {{ __("pending") }}</span>
                </div>
            </div>

            <div class="col">
                <div
                    class="card p-4 border-0 bg-primary-light shadow rounded-md text-center"
                >
                    <div class="fs-3 text-primary fw-bold">0</div>
                    <span class="fs-5"> {{ __("cancelled") }}</span>
                </div>
            </div>

            <div class="col">
                <div
                    class="card p-4 border-0 bg-primary-light shadow rounded-md text-center"
                >
                    <div class="fs-3 text-primary fw-bold">25</div>
                    <span class="fs-5"> {{ __("complete") }}</span>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card spotlight-card shadow-sm p-4 item-h border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div
                                    class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                    style="height: 150px"
                                >
                                    <img
                                        class="img-fluid"
                                        src="@/images/account/default_avatar_men.png"
                                        alt="teacher"
                                    />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2
                                                    class="mb-3 fs-6 text-capitalize"
                                                >
                                                    Teacher Name
                                                </h2>

                                                <div
                                                    style="font-size: 14px"
                                                    class="text-start me-5"
                                                >
                                                    <p>
                                                        Lorem ipsum dolor sit
                                                        amet consectetur
                                                        adipisicing elit.
                                                        Obcaecati laudantium
                                                        aliquid laborum.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-end">
                                                <button
                                                    class="btn btn-outline-primary px-3 shadow-sm mb-3 rounded"
                                                >
                                                    {{ __("view details") }}
                                                </button>

                                                <button
                                                    class="btn btn-primary"
                                                >
                                                    {{ __("rescedule") }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 py-3 bg-primary-light rounded-lg">
                                <div class="col-md-8">
                                    <div class="d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-3">
                                            <i
                                                class="bi bi-calendar3 me-3 fs-4 text-primary"
                                            ></i>
                                            <span class=""
                                                >Monday, May 9, 2023</span
                                            >
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <i
                                                class="bi bi-clock-fill me-3 fs-4 text-primary"
                                            ></i>
                                            <span class="">9:00 - 9:45 am</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-end me-4">
                                        <i
                                            class="bi bi-camera-video-fill me-3 fs-4 text-primary"
                                        ></i>
                                        <span class=""> {{ __("video call") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card spotlight-card shadow-sm p-4 item-h border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div
                                    class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                    style="height: 150px"
                                >
                                    <img
                                        class="img-fluid"
                                        src="@/images/account/default_avatar_men.png"
                                        alt="teacher"
                                    />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2
                                                    class="mb-3 fs-6 text-capitalize"
                                                >
                                                    Teacher Name
                                                </h2>

                                                <div
                                                    style="font-size: 14px"
                                                    class="text-start me-5"
                                                >
                                                    <p>
                                                        Lorem ipsum dolor sit
                                                        amet consectetur
                                                        adipisicing elit.
                                                        Obcaecati laudantium
                                                        aliquid laborum.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-end">
                                                <button
                                                    class="btn btn-outline-primary px-3 shadow-sm mb-3 rounded"
                                                >
                                                    {{ __("view details") }}
                                                </button>

                                                <button
                                                    class="btn btn-primary"
                                                >
                                                    {{ __("rescedule") }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 py-3 bg-primary-light rounded-lg">
                                <div class="col-md-8">
                                    <div class="d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-3">
                                            <i
                                                class="bi bi-calendar3 me-3 fs-4 text-primary"
                                            ></i>
                                            <span class=""
                                                >Monday, May 9, 2023</span
                                            >
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <i
                                                class="bi bi-clock-fill me-3 fs-4 text-primary"
                                            ></i>
                                            <span class="">9:00 - 9:45 am</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-end me-4">
                                        <i
                                            class="bi bi-camera-video-fill me-3 fs-4 text-primary"
                                        ></i>
                                        <span class="">Video Call</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card spotlight-card shadow-sm p-4 item-h border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-3">
                                <div
                                    class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                                    style="height: 150px"
                                >
                                    <img
                                        class="img-fluid"
                                        src="@/images/account/default_avatar_men.png"
                                        alt="teacher"
                                    />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2
                                                    class="mb-3 fs-6 text-capitalize"
                                                >
                                                    Teacher Name
                                                </h2>

                                                <div
                                                    style="font-size: 14px"
                                                    class="text-start me-5"
                                                >
                                                    <p>
                                                        Lorem ipsum dolor sit
                                                        amet consectetur
                                                        adipisicing elit.
                                                        Obcaecati laudantium
                                                        aliquid laborum.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-end">
                                                <button
                                                    class="btn btn-outline-primary px-3 shadow-sm mb-3 rounded"
                                                >
                                                    {{ __("view details") }}
                                                </button>

                                                <button
                                                    class="btn btn-primary"
                                                >
                                                    {{ __("rescedule") }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 py-3 bg-primary-light rounded-lg">
                                <div class="col-md-8">
                                    <div class="d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-3">
                                            <i
                                                class="bi bi-calendar3 me-3 fs-4 text-primary"
                                            ></i>
                                            <span class=""
                                                >Monday, May 9, 2023</span
                                            >
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <i
                                                class="bi bi-clock-fill me-3 fs-4 text-primary"
                                            ></i>
                                            <span class="">9:00 - 9:45 am</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-end me-4">
                                        <i
                                            class="bi bi-camera-video-fill me-3 fs-4 text-primary"
                                        ></i>
                                        <span class="">Video Call</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
