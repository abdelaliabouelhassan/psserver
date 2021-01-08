@component('mail::message')
Forgot Password 

Your Code : {{ $code }}

<b>If you did not create an account, no further action is required.</b>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
