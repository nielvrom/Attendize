@extends('Emails.Layouts.Master')

@section('message_content')
{{ trans('emails.hello') }},<br><br>

{{ trans('emails.order_for_event') }} <b>{{$order->event->title}}</b> {{ trans('emails.was_successful') }}.<br><br>

{{ trans('emails.tickets_attached') }}: {{route('showOrderDetails', ['order_reference' => $order->order_reference])}}


<h3>{{ trans('emails.order_details') }}</h3>
{{ trans('emails.order_reference') }}: <b>{{$order->order_reference}}</b><br>
{{ trans('emails.order_name') }}: <b>{{$order->full_name}}</b><br>
{{ trans('emails.order_date') }}: <b>{{$order->created_at->toDayDateTimeString()}}</b><br>
{{ trans('emails.order_email') }}: <b>{{$order->email}}</b><br>

<h3>{{ trans('emails.order_items') }}</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">
    <table style="width:100%; margin:10px;">
        <tr>
            <td>
                <b>{{ trans('emails.ticket') }}</b>
            </td>
            <td>
                <b>{{ trans('emails.quantity') }}</b>
            </td>
            <td>
                <b>{{ trans('emails.price') }}</b>
            </td>
            <td>
                <b>{{ trans('emails.fee') }}</b>
            </td>
            <td>
                <b>{{ trans('emails.total') }}</b>
            </td>
        </tr>
        @foreach($order->orderItems as $order_item)
                                <tr>
                                    <td>
                                        {{$order_item->title}}
                                    </td>
                                    <td>
                                        {{$order_item->quantity}}
                                    </td>
                                    <td>
                                        @if((int)ceil($order_item->unit_price) == 0)
                                            {{ trans('emails.free') }}
                                        @else
                                       {{money($order_item->unit_price, $order->event->currency)}}
                                        @endif

                                    </td>
                                    <td>
                                        @if((int)ceil($order_item->unit_price) == 0)
                                        -
                                        @else
                                        {{money($order_item->unit_booking_fee, $order->event->currency)}}
                                        @endif

                                    </td>
                                    <td>
                                        @if((int)ceil($order_item->unit_price) == 0)
                                            {{ trans('emails.free') }}
                                        @else
                                        {{money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity), $order->event->currency)}}
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <b>{{ trans('emails.sub_total') }}</b>
            </td>
            <td colspan="2">
               {{money($order->amount + $order->order_fee, $order->event->currency)}}
            </td>
        </tr>
    </table>

    <br><br>
</div>
<br><br>
{{ trans('emails.thank_you') }}
@stop
