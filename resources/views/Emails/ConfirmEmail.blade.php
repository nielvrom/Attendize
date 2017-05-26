@extends('Emails.Layouts.Master')

@section('message_content')

<p>{{ trans('emails.hi') }} {{$first_name}}</p>
<p>
    {{ trans('emails.thank_you_register') }} {{ config('attendize.app_name') }}. {{ trans('emails.thrilled') }}.
</p>

<p>
    {{ trans('emails.confirm') }}.
</p>

<div style="padding: 5px; border: 1px solid #ccc;">
   {{route('confirmEmail', ['confirmation_code' => $confirmation_code])}}
</div>
<br><br>
<p>
    {{ trans('emails.questions') }}.
</p>
<p>
    {{ trans('emails.thank_you') }}
</p>

@stop

@section('footer')


@stop
