@component('mail::message')


You Have new message from {{ $username }}

<b>email</b> : {{ $email }}

<hr>

{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
