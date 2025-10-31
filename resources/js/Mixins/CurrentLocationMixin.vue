<script>
export default {
    created(){
    },
    data() {
        return {
            location_data:{
                lat:"",
                lng:"",
                fetch:false
            },
             latitude: "",
             longitude: "",
             fetch:false
            }
    },
    methods: {
        async getStreetAddressFrom(lat, long) {
            try {
                var response= await fetch(
                    "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
                    lat +
                    "," +
                    long +
                    "&key=AIzaSyCCiLJ2oj495NdwWjSm3I_fBGX7UxYYW6s"
                );
                var data = await response.json()
                if (data.error_message) {
                    return ""
                } else {
                    return data.results[0].formatted_address;
                }

            } catch (error) {
                return ""
            }
        },
        async locatorButtonPressed() {
            return new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(
                position => {
                    this.location_data = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                            fetch:true
                        };
                    this.location_data.loc = this.location_data;
                    this.location_data.position = position;
                    this.latitude = position.coords.latitude
                    this.longitude = position.coords.longitude
                    resolve(position)
                },
                error => {
                    this.location_data = {
                            fetch:true
                        };
                        resolve(error)

                },
                )
            });

            },
    },
}
</script>
