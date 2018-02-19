@extends('Emails.Layouts.Master')

@section('message_content')

<p>{{ trans('emails.hi_there') }},</p>
<p>{{ trans('emails.received_message') }} <b>{{ (isset($sender_name) ? $sender_name : $event->organiser->name) }}</b> {{ trans('emails.relation_event') }} <b>{{ $event->title }}</b>.</p>
<p style="padding: 10px; margin:10px; border: 1px solid #f3f3f3;">
    {{nl2br($message_content)}}
</p>

<p>
    {{ trans('emails.you_can_contact') }} <b>{{ (isset($sender_name) ? $sender_name : $event->organiser->name) }}</b> {{ trans('emails.directly_at') }} <a href='mailto:{{ (isset($sender_email) ? $sender_email : $event->organiser->email) }}'>{{ (isset($sender_email) ? $sender_email : $event->organiser->email) }}</a>, {{ trans('emails.reply_mail') }}.
</p>
@stop

@section('footer')


@stop
