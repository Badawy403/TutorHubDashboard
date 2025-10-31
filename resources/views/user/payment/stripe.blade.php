<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang("Payment with Stripe")</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
<script>
    "use strict";
    var stripe = Stripe('{{$data->publishable_key}}');
    stripe.redirectToCheckout({
        sessionId: '{{optional($data->checkoutSession)->id??''}}'
    });
</script>

</body>

</html>


