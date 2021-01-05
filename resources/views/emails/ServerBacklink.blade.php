@component('mail::message')
Hello. Your Server is Updated Automatically To inactive because we detect you don't have a backlink in your server
The body of your message.

<b>to active your server again you need to add a backlink</b>
<hr>
<span style="color: gray">Your Backlink :</span>
<b>{{ "<a href='$backlink' >Metine2 TopList</a>" }}</b> 


Thanks,<br>
{{ config('app.name') }}
@endcomponent
