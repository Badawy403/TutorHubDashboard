import moment from 'moment';
// import tune from '../../../public/assets/sound/message.mp3';

export default {
    methods: {
        getFormattedDate(date) {
            return moment(date).format("DD MMM YYYY LT")
        },
        getFormattedDateOnly(date) {
            return moment(date).format("DD MMM YYYY")
        },
        getFormattedCurrentDate() {
            return moment().format("DD/MM/YY")
        },
        dateCheck(date) {
            return moment(this.getFormattedDateOnly(date)).isAfter(this.getFormattedCurrentDate(), 'month')
        },
        getFormattedTime(date) {
            return moment(date).format("hh:mm  a")
        },
        formateProfileString(string) {
            if (string && string != 'undefined') {
                return string.charAt(0).toUpperCase();
            }
        },
        getUserTenantCode() {
            return this.$page.props.user_tenant_code
        },
        clearSession() {
            this.$page.props.session_message = []
            this.$page.props.errors = []
        },
        disablePastDate() {
            // const dtToday = new Date();
            //
            // let month = dtToday.getMonth() + 1;
            // let day = dtToday.getDate();
            // const year = dtToday.getFullYear();
            // if (month < 10)
            //     month = '0' + month.toString();
            // if (day < 10)
            //     day = '0' + day.toString();
            //
            // return year + '-' + month + '-' + day;
            let today = new Date().toISOString().slice(0, 16);

            document.getElementsByName("Beginn")[0].min = today;
            document.getElementsByName("Ende")[0].min = today;
        },
        formatAMPM(date) {
            let hours = date.getHours();
            let minutes = date.getMinutes();
            let ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            return hours + ':' + minutes + ' ' + ampm;
        },
        scrollToBottom() {
            let objDiv = document.getElementById("messages");
            objDiv.scrollTop = objDiv.scrollHeight;
        },
        getContentTypes(type) {
            if (type == 'info') {
                return 4
            } else if (type == 'chat') {
                return 1
            }
            else if (type == 'file') {
                return 2
            } else {
                return 1
            }
        },
        playSound() {
            const audio = new Audio(this.$page.props.auth.tenant.request_tune);
            return audio.play();
        },
        formatDecimal(number) {
            return parseInt(number).toFixed(2);
        },
        getPageContent(key) {
            var index = this.$page.props.all_pages_content.findIndex(obj => obj.name == key)
            if (index >= 0) {
                return this.$page.props.all_pages_content[index].value

            } else {
                return null
            }
        },
        getPageContentType(key) {
            var index = this.$page.props.all_pages_content.findIndex(obj => obj.name == key)
            if (index >= 0) {
                return this.$page.props.all_pages_content[index].type
            } else {
                return null
            }
        },
        inputNumbersOnly(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        },
        hostName() {
            return 'https://' + location.hostname
        },
        checkObjectValuesIsNotNull(obj) {
            const values = Object.values(obj);
            return values.some((value) => value !== null && value !== undefined && value !== "");
        },
        getDisplayAmount(amountParam) {
            var default_currency = this.$page.props.default_currency;
            let amount  = parseFloat(amountParam);
            if (default_currency) {
                if (default_currency.direction == "ltr") {
                    return default_currency.symbol + '' + amount.toFixed(parseInt(default_currency.decimal_places));
                } else if (default_currency.direction == "rtl") {
                    return amount.toFixed(default_currency.decimal_places)+ '' + default_currency.symbol;
                }
            } else {
                return amount;
            }
        },
        getDefaultCurrencySymbol() {
            var default_currency = this.$page.props.default_currency;
            return default_currency.symbol;
        },
        isSubscriptionEnabled() {
            return this.$page.props.settings.commission_type == 'subscription_base';
        },
        isCommissionEnabled() {
            return this.$page.props.settings.commission_type == 'commission_base';
        },
        calculateCommissionAmount(fee, commission) {
            if (fee > 0) {
                let updated_fee = parseFloat(fee);
                if (commission.commission_type == 'fixed_rate') {
                    updated_fee = updated_fee + commission.rate
                }
                else {
                    let percentage_value = (updated_fee / 100) * commission.rate;
                    updated_fee = updated_fee + percentage_value
                }
                return updated_fee;
            }
            else
            {
                return 0;
            }

        }
    },
}
