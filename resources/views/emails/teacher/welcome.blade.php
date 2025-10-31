// ->line('Get ready for an amazing journey with us. ')
            // ->line('Here is your Login Credentials:')
            // ->line('Email:'. $this->user->email)
            // ->line('Password:'. $this->password)
            ->line('Thank you for using our application!')
Dear <b> {{$this->user->name}}</b>,

Get ready for an amazing journey with us.

Here is your Login Credentials:

<b>Email: </b> {{$this->user->email}}
<b>Password: </b> {{$this->password}}
Thank you for using our application!
