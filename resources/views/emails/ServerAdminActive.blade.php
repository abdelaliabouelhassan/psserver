@component('mail::message')
Hello, your server has been deactivated

<hr>
{{ $description }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
