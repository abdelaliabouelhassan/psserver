@component('mail::message')
<h1>Hello , {{$username}} thank you for using our application.</h1>

<b>Please click the button below to verify your email address.</b>

@component('mail::button', ['url' => url('/verifyemail/' . $email . '/' . $token)])
    Verify Email Address
@endcomponent

<b>If you did not create an account, no further action is required.</b>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
