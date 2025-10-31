<template>
    <div class="row" v-if="$page.props.auth.logged_in_as == 'teacher' || $page.props.auth.logged_in_as == 'academy'">

        <div class="col-md-2">
            <!-- <p class="mb-0">Please Make Video Call</p> -->
        </div>
        <div class="col-md-10 d-flex justify-content-end ">
            <button type="button" @click="joinEvent"
                v-if="fetched && !audioPermissionMessage && appointment.appointment_status_code == 2"
                :disabled="disableJoin" class="btn btn-primary px-5"> {{ __('make audio call') }}</button>

            <button type="button" @click="leaveEvent" v-if="disableJoin" class="btn btn-danger ms-lg-3 ms-0  px-5" plain
            :disabled="!disableJoin"> {{ __('leave call') }}</button>
            <button type="button" @click="updateAppointmentIsStarted" v-if="showStartedButton && !appointment.is_started" class="btn btn-primary ms-lg-3 ms-0  px-5" plain>

              {{ __('start appointment') }}
            </button>
        </div>
    </div>

    <div class="col-12" v-if="$page.props.auth.logged_in_as == 'student'">
        <div class="row" v-if="incomingCall && !autoJoin">
            <div class="col-md-6">
                <p class="mb-0">{{ __('waiting for incoming call') }}</p>
            </div>
            <div class="col-md-6 d-flex justify-content-end flex-wrap">
                <button type="button" :disabled="disableIncomingJoin"
                    @click="async () => { await this.joinEvent(); this.disableIncomingJoin = true }" v-if="incomingCall"
                    class="btn btn-primary">
                    {{ __('join call') }}
                </button>
                <button type="button" @click="leaveEvent" v-if="disableIncomingJoin" class="btn btn-danger" plain
                    :disabled="!disableIncomingJoin">{{ __('leave call') }}</button>
            </div>
        </div>
        <div class="row justify-content-center rounded-4" style="background-color: #E7F3FA;" v-else-if="!incomingCall && appointment.appointment_status_code == 2 && !autoJoin">
            <div class="col-md-12">
                <p class="mb-0 py-3">{{ __('waiting for incoming call') }}</p>
            </div>
        </div>
        <div class="row justify-content-center rounded-4"  style="background-color: #E7F3FA;" v-else-if="!incomingCall && appointment.appointment_status_code == 1 && !autoJoin">
            <div class="col-md-12">
                <p class="mb-0 py-3">{{ __('waiting for appointment acceptance') }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 agora-view mt-4" v-if="localStream">
        <div class="row">
            <div class="col-md-6">
                <div class="agora-video mt-md-0 mt-3">
                    <stream-player :stream="localStream" :domId="localStream.getId()" :appointment_id="appointment.id"
                        :id="id" stream_type="audio"></stream-player>
                </div>
            </div>
            <div class="col-md-6">
                <div class="agora-video mt-md-0 mt-3" :key="index" v-for="(remoteStream, index) in remoteStreams">
                    <stream-player :stream="remoteStreams[0]" :domId="remoteStreams[0].getId()"
                        :appointment_id="appointment.id" :id="id" stream_type="audio"></stream-player>
                </div>
            </div>
        </div>
    </div>

    <span id="permission_button_model" class="d-none" data-bs-toggle="modal" data-bs-target="#audioCallModel"></span>
    <!-- Modal -->
    <div class="modal fade" id="audioCallModel" tabindex="-1" aria-labelledby="audioCallModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="audioCallModelLabel">{{ __('Permission Warning') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" v-if="audioPermissionMessage">
                        {{ audioPermissionMessage }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close')
                    }}</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import RTCClient from "../../../agora-rtc-client.js";
import StreamPlayer from "./streamPlayerComponent.vue";

export default defineComponent({
    components: {
        Head,
        ValidationErrors,
        Link,
        StreamPlayer
    },
    data() {
        return {
            option: {
                appid: "",
                token: "",
                channel: "",
            },
            disableJoin: false,
            localStream: null,
            remoteStreams: [],
            leftCommunication: false,
            incomingCall: false,
            disableIncomingJoin: false,
            audioPermissionMessage: null,
            fetched: false,
            showStartedButton: false,
            autoJoin:false,

        };
    },
    props: ['appointment'],
    methods: {
        async joinEvent() {
            if (this.appointment.appointment_status_code == 2) {
                await this.checkAudioEnabled();
                if (this.audioPermissionMessage != null) {
                    document.getElementById("permission_button_model").click();
                    return;
                }
            }
            else {
                return;
            }
            var self = this;
            this.rtc
                .joinChannel(this.option)
                .then(() => {
                    this.rtc
                        .publishStreamAudio()
                        .then((stream) => {
                            this.localStream = stream;
                            if (this.$page.props.auth.logged_in_as == 'teacher' || this.$page.props.auth.logged_in_as == 'academy') {
                                self.sendPushNotification();
                            }
                            self.makeAgoraCall();
                            self.showStartedButton = true
                        })
                        .catch((err) => {
                            console.log("publish local error", err);
                        });
                })
                .catch((err) => {
                    self.generateAgoraToken();
                    // self.joinEvent();
                    console.log("join channel error", err);
                });
            this.disableJoin = true;
        },
        async makeAgoraCall() {
            await axios.post(this.route('postApiMakeAgoraCall'), {
                appointment: this.appointment,
                channel: this.option.channel,
                token: this.option.token,
            }).then(res => {

            });
        },
        leaveEvent() {
            console.log('leave event call');
            this.leftCommunication = true;
            this.disableJoin = false;
            this.rtc
                .leaveChannel()
                .then(() => { })
                .catch((err) => {
                    console.log("leave error", err);
                });
            this.localStream = null;
            this.incomingCall = false;
            this.remoteStreams = [];
            this.disableIncomingJoin = false

        },

        generateString(length) {
            const characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            let result = "";
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(
                    Math.floor(Math.random() * charactersLength)
                );
            }

            return result;
        },
        async generateAgoraToken() {
            this.option.channel = this.generateString(10);
            await axios
                .get(
                    this.route("getAgoraToken", {
                        channel: this.option.channel
                    })
                )
                .then((res) => {
                    this.option.token = res.data.data;
                    this.fetching = false;
                });
        },
        async sendPushNotification() {
            var payload = {
                appointment : this.appointment ?? null,
                channel_name : this.option.channel ?? null,
                token : this.option.token ?? null,
            };
            console.log('/appointment_log/detail/"+ this.appointment.id +"?auth_tocken=" + this.option.token + "&channel_name=" + this.option.channel',"/appointment_log/detail/"+ this.appointment.id +"?auth_tocken=" + this.option.token + "&channel_name=" + this.option.channel);
            await axios
                .get(
                    this.route("getApiSendPushNotification", {
                        title: "Audio Call from " + this.$page.props.auth.logged_in_as,
                        body: "Please Join the Call",
                        deep_link: "/appointment_log/detail/"+ this.appointment.id +"?auth_tocken=" + this.option.token + "&channel_name=" + this.option.channel,
                        reciever_id: this.appointment.student_id,
                        payload: payload,
                    })
                )
                .then((res) => {
                    this.fetching = false;
                });
        },
        async checkAudioEnabled() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                stream.getTracks().forEach((track) => track.stop());
                this.audioPermissionMessage = null;
                console.log('Microphone permission granted', stream);
                // You can now use the stream to record audio or perform other operations.
            } catch (error) {
                console.error('Microphone permission denied', error);
                this.audioPermissionMessage = "Audio/Microphone permission denied by system"
                // this.$toast.error(error);

            }
        },
        checkPermissions() {
            this.checkAudioEnabled();
        },
        updateAppointmentIsStarted() {
            if (this.$page.props.auth.logged_in_as == "teacher") {
                axios.post(this.route('appointment_detail.updateStarted',{appointment_id:this.appointment.id})).then(res => {
                    if (res.data.success) {
                        this.$emit('showCompletedButton');
                        this.showStartedButton = false
                    }
                });
            }
            if (this.$page.props.auth.logged_in_as == "academy") {
                axios.post(this.route('academy.appointment_detail.updateStarted',{appointment_id:this.appointment.id})).then(res => {
                    if (res.data.success) {
                        this.$emit('showCompletedButton');
                        this.showStartedButton = false
                    }
                });
            }
        },
    },
    async created() {
        this.fetched = true
        if (this.$page.props.settings.agora_app_id) {
            this.option.appid = this.$page.props.settings.agora_app_id;
        }

        Echo.private(`make-agora-call.${this.appointment.id}`).listen(
            ".make-agora-call",
            (e) => {
                console.log(e);
                if (this.$page.props.auth.logged_in_as == 'student' && this.$page.props.auth.user.student.id == e.student_id) {
                    this.option.channel = e.channel
                    this.option.token = e.token
                    this.incomingCall = true

                }
            }
        );


        this.rtc = new RTCClient();
        let rtc = this.rtc;
        rtc.on("stream-added", (evt) => {
            let { stream } = evt;
            console.log("[agora] [stream-added] stream-added", stream.getId());
            rtc.client.subscribe(stream);
        });

        rtc.on("stream-subscribed", (evt) => {
            let { stream } = evt;
            console.log("[agora] [stream-subscribed] stream-added", stream.getId());

            if (!this.remoteStreams.find((it) => it.getId() === stream.getId())) {
                this.remoteStreams.push(stream);
            }
        });

        rtc.on("stream-removed", (evt) => {
            let { stream } = evt;
            console.log("[agora] [stream-removed] stream-removed", stream.getId());
            this.remoteStreams = this.remoteStreams.filter(
                (it) => it.getId() !== stream.getId()
            );
        });

        rtc.on("peer-online", (evt) => {
            console.log(`Peer ${evt.uid} is online`);
        });

        rtc.on("peer-leave", (evt) => {
            console.log(`Peer ${evt.uid} already leave`);
            this.remoteStreams = this.remoteStreams.filter(
                (it) => it.getId() !== evt.uid
            );
        });
        if (this.$page.props.auth.logged_in_as == 'teacher' || this.$page.props.auth.logged_in_as == 'academy') {
            await this.generateAgoraToken();
        }
        else
        {
            if (window.location.href.indexOf("?") > -1) {
                let uri = window.location.href.split("?");
                let params = uri[1].split("&");
                var auth_tocken = params[0].replace("auth_tocken=", "");
                var channel_name = params[1].replace("channel_name=", "");
                this.option.token = auth_tocken;
                this.option.channel = channel_name;
                this.joinEvent();
                this.incomingCall = false;
                this.autoJoin = true
            }
        }
    },
});
</script>

<style lang="scss" scoped>
.agora-title {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    color: #2c3e50;
}

.agora-view {
    height: 400px;
}

.agora-input {
    margin: 20px;
}

.agora-text {
    margin: 5px;
    font-size: 16px;
    font-weight: bold;
}

.agora-button {
    display: flex;
    justify-content: flex-end;
    margin: 20px;
}

.agora-video {
    width: 100%;
    height: 400px;
}

@media only screen and (max-width: 991.5px) {
    .agora-video {
        width: 100%;
        height: 250px;
    }
}

@media only screen and (max-width: 767px) {
    .agora-view {
        height: auto !important;
        margin-bottom: 0px !important;
    }

    .agora-video {
        margin: 0px;
        margin-top: 20px;
        height: 200px;
    }

    .agora-button {
        flex-direction: column;
        margin: 0px;

        .btn-danger {
            margin-top: 10px;
        }
    }
}
</style>

