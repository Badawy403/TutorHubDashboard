<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-message.{appointmentID}', function ($appointmentID) {
    return true;
});

Broadcast::channel('chat-message-service.{serviceId}', function ($serviceId) {
    return true;
});

Broadcast::channel('make-agora-call.{appointmentID}', function ($appointmentID) {
    return true;
});
