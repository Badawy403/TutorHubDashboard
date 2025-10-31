
<x-mail::message>
# Contact Form Request,
You have received a new contact Form Request.

### Name:
{{$contact['name'] ?? ""}}

### Email:
{{$contact['email'] ?? ""}}

### Phone:
{{$contact['phone'] ?? ""}}

### Message:
{{$contact['message'] ?? ""}}

</x-mail::message>
