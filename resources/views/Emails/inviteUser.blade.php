@extends('Emails.Layouts.Master')

@section('message_content')

<p>{{ trans('emails.hello') }}</p>
<p>
    {{ trans('emails.added_to') }} {{ config('attendize.app_name') }} {{ trans('emails.added_to') }} {{$inviter->first_name.' '.$inviter->last_name}}.
</p>

<p>
    {{ trans('emails.login_details') }}.<br><br>

    {{ trans('emails.username') }}: <b>{{$user->email}}</b> <br>
    {{ trans('emails.password') }}: <b>{{$temp_password}}</b>
</p>

<p>
    {{ trans('emails.change_temporary_password') }}.
</p>

<div style="padding: 5px; border: 1px solid #ccc;" >
   {{route('login')}}
</div>
<br><br>
<p>
    {{ trans('emails.questions_reply') }}.
</p>
<p>
    {{ trans('emails.thank_you') }}
</p>

@stop

@section('footer')


@stop
