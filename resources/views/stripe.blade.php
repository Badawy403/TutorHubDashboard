<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stripe Payment</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <style>
        .submit-button {
            margin-top: 10px;
        }

        .mtop {
            margin-top: 90px;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Stripe Payment</h2>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display Stripe-specific Errors -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" id="payment-form" action="{!! route('addmoney.stripe') !!}">
                    {{ csrf_field() }}

                    <div class='form-group'>
                        <label class='control-label mb-2'>Card Number</label>
                        <input autocomplete='off' class='form-control card-number' size='20' type='text'
                            name="card_no" placeholder="1234 5678 9012 3456" required>
                        <div class="error-message" id="card-number-error"></div>
                    </div>

                    <div class='row align-items-center my-3'>
                        <div class='col-md-4 form-group cvc required'>
                            <label class='control-label mb-2'>CVV</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='***' size='4'
                                type='text' name="cvvNumber" required>
                            <div class="error-message" id="cvv-error"></div>
                        </div>
                        <div class='col-md-4 form-group expiration required'>
                            <label class='control-label mb-2'>Expiration Month</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='4' type='text'
                                name="ccExpiryMonth" required>
                            <div class="error-message" id="expiry-month-error"></div>
                        </div>
                        <div class='col-md-4 form-group expiration required'>
                            <label class='control-label mb-2'>Expiration Year</label>
                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                type='text' name="ccExpiryYear" required>
                            <div class="error-message" id="expiry-year-error"></div>
                        </div>
                    </div>

                    <div class='form-row'>
                        <div class='col-md-12 mb-3'>
                            <div class='total btn btn-primary w-100 '>
                                Total: <span class='amount'>{{ $default_currency->symbol }}
                                    {{ getAmount($fund->amount) }}</span>
                                <input type="hidden" name="currency_code" value="{{ $default_currency->code }}">
                                <input type="hidden" name="appointment_id" value="{{ $appointment->id ?? '' }}">
                                <input class='form-control' type='hidden' name="amount" value={{ $fund->amount }}>
                            </div>
                        </div>
                    </div>

                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <button class='btn btn-success px-4 fs-5 fw-bold btn-block submit-button' type='submit'>Pay
                                »</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            // Clear any previous error messages
            document.getElementById('card-number-error').innerHTML = '';
            document.getElementById('cvv-error').innerHTML = '';
            document.getElementById('expiry-month-error').innerHTML = '';
            document.getElementById('expiry-year-error').innerHTML = '';

            const cardNumber = document.querySelector('.card-number').value.replace(/\s+/g, ''); // Remove spaces
            const cvc = document.querySelector('.card-cvc').value;
            const expiryMonth = document.querySelector('.card-expiry-month').value;
            const expiryYear = document.querySelector('.card-expiry-year').value;

            const cardNumberRegex = /^[0-9]{16}$/;
            const cvcRegex = /^[0-9]{3}$/;
            const monthRegex = /^(0[1-9]|1[0-2])$/;
            const yearRegex = /^20[2-9][0-9]$/;

            let valid = true;

            // Card number validation
            if (!cardNumberRegex.test(cardNumber)) {
                document.getElementById('card-number-error').innerHTML =
                    "Please enter a valid 16-digit card number.";
                valid = false;
            }

            // CVC validation
            if (!cvcRegex.test(cvc)) {
                document.getElementById('cvv-error').innerHTML = "Please enter a valid 3-digit CVV.";
                valid = false;
            }

            // Expiry month validation
            if (!monthRegex.test(expiryMonth)) {
                document.getElementById('expiry-month-error').innerHTML =
                    "Please enter a valid expiration month (MM).";
                valid = false;
            }

            // Expiry year validation
            if (!yearRegex.test(expiryYear)) {
                document.getElementById('expiry-year-error').innerHTML =
                    "Please enter a valid expiration year (YYYY).";
                valid = false;
            }

            // Prevent form submission if validation fails
            if (!valid) {
                e.preventDefault();
            }
        });

        // Auto format card number input
        document.querySelector('.card-number').addEventListener('input', function(e) {
            let cardInput = e.target.value.replace(/\s+/g, ''); // Remove spaces
            if (cardInput.length > 16) cardInput = cardInput.slice(0, 16); // Limit to 16 digits
            e.target.value = cardInput.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
        });

        document.querySelector('.card-cvc').addEventListener('input', function(e) {
            let cardCvv = e.target.value.replace(/\s+/g, ''); // Remove spaces
            if (cardCvv.length > 3) cardCvv = cardCvv.slice(0, 3); // Limit to 16 digits
            e.target.value = cardCvv.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
        });
        document.querySelector('.card-expiry-month').addEventListener('input', function(e) {
            let cardCvv = e.target.value.replace(/\s+/g, ''); // Remove spaces
            if (cardCvv.length > 2) cardCvv = cardCvv.slice(0, 2); // Limit to 16 digits
            e.target.value = cardCvv.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
        });
        document.querySelector('.card-expiry-year').addEventListener('input', function(e) {
            let cardCvv = e.target.value.replace(/\s+/g, ''); // Remove spaces
            if (cardCvv.length > 4) cardCvv = cardCvv.slice(0, 4); // Limit to 16 digits
            e.target.value = cardCvv.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
        });
    </script>

</body>

</html>
