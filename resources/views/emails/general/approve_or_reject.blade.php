<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Consultation Portal</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">student Consultation Portal</div>

                    <div class="card-body">
                        <h3>student Approved Successfully</h3>

                        <h5 class="card-title">student ID: <strong>{{ $student->id }}</strong></h5>

                        <p class="card-text">student Name:
                            <strong>{{ $student->first_name ." ". $student->last_name }}</strong>
                        </p>
                        <p class="card-text"> student Experience: <strong>{{ $student->experience }}</strong></p>

                        <p class="card-text">student Address: <strong>{{ $student->address_line_1 }}</strong></p>

                        <p class="card-text">student Phone: <strong>{{ $student->cell_phone }}</strong></p>
                        <a href="{{ url('/students/profiles/' . $student->id) }}"
                            class="btn btn-primary text-white">Visit Your Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
