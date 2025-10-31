<script>
import Echo from "laravel-echo";
import Pusher from "pusher-js";
export default {
  created() {
    window.Pusher = Pusher;
    window.Echo = new Echo({
      broadcaster: "pusher",
      key: this.$page.props.settings.pusher_app_key,
      cluster: this.$page.props.settings.pusher_app_cluster,
      forceTLS: true,
    });
  },
};
</script>
