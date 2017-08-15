{{ trans('emails.hi') }} {{$attendee->first_name}},<br><br>

{{ trans('emails.attachment') }}<br><br>

{{ trans('emails.view_order_info') }} {{route('showOrderDetails', ['order_reference' => $attendee->order->order_reference])}} {{ trans('emails.anytime') }}.<br><br>

{{ trans('emails.order_reference') }} <b>{{$attendee->order->order_reference}}</b>.<br>

{{ trans('emails.thank_you') }}<br>

