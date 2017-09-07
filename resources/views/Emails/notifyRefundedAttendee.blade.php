@extends('Emails.Layouts.Master')

@section('message_content')

    <p>{{ trans('emails.hi_there') }},</p>
    <p>
        {{ trans('emails.received_refund') }} <b>{{{$attendee->event->title}}}</b>.
        <b>{{{ $refund_amount }}} {{ trans('emails.is_refunded') }}.</b>
    </p>

    <p>
        {{ trans('emails.you_can_contact') }} <b>{{{ $attendee->event->organiser->name }}}</b> {{ trans('emails.directly_at') }} <a href='mailto:{{{$attendee->event->organiser->email}}}'>{{{$attendee->event->organiser->email}}}</a> {{ trans('emails.reply_mail_info') }}.
    </p>
@stop

@section('footer')

@stop