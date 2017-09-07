@extends('Emails.Layouts.Master')

@section('message_content')

<p>{{ trans('emails.hi_there') }},</p>
<p>
    {{ trans('emails.ticket_for_event') }} <b>{{{$attendee->event->title}}}</b> {{ trans('emails.cancelled') }}.
</p>

<p>
    {{ trans('emails.you_can_contact') }} <b>{{{$attendee->event->organiser->name}}}</b> {{ trans('emails.directly_at') }} <a href='mailto:{{{$attendee->event->organiser->email}}}'>{{{$attendee->event->organiser->email}}}</a> {{ trans('emails.reply_mail_info') }}.
</p>
@stop

@section('footer')

@stop
