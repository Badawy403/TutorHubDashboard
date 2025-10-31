<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tutor Consultation Portal</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">tutor Consultation Portal</div>

                    <div class="card-body">
                        <h3>tutor Approved Successfully</h3>

                        <h5 class="card-title">tutor ID: <strong>{{ $tutor->id }}</strong></h5>

                        <p class="card-text">tutor Name:
                            <strong>{{ $tutor->first_name ." ". $tutor->last_name }}</strong>
                        </p>
                        <p class="card-text"> tutor Experience: <strong>{{ $tutor->experience }}</strong></p>

                        <p class="card-text">tutor Address: <strong>{{ $tutor->address_line_1 }}</strong></p>

                        <p class="card-text">tutor Phone: <strong>{{ $tutor->cell_phone }}</strong></p>
                        <a href="{{ url('/tutors/profiles/' . $tutor->id) }}"
                            class="btn btn-primary text-white">Visit Your Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
