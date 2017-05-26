@extends('Emails.Layouts.Master')

@section('message_content')
    <div>
        {{ trans('emails.hello') }},<br><br>
        {{ trans('emails.reset_password') }}: {{ route('showResetPassword', ['token' => $token]) }}.
        <br><br><br>
        {{ trans('emails.thank_you') }},<br>
        {{ trans('emails.team_tickety') }}
    </div>
@stop