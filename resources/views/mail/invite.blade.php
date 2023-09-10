<x-mail::message>
# Hello!

{{$senderName}} invited you to join the project "{{$projectName}}".<br>
Please click the button below to join the project.

<x-mail::button :url="$url" color="green">
Accept Invitation
</x-mail::button>

If you did not create an account, please create one with your email address.<br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
