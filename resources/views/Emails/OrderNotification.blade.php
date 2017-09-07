@extends('Emails.Layouts.Master')

@section('message_content')
{{ trans('emails.hello') }},<br><br>

{{ trans('emails.received_new_order') }} <b>{{$order->event->title}}</b>.<br><br>

@if(!$order->is_payment_received)
    <b>{{ trans('emails.order_requires_payment') }}.</b>
    <br><br>
@endif


{{ trans('emails.order_summary') }}:
<br><br>
{{ trans('emails.order_reference') }}: <b>{{$order->order_reference}}</b><br>
{{ trans('emails.order_name') }}: <b>{{$order->full_name}}</b><br>
{{ trans('emails.order_date') }}: <b>{{$order->created_at->toDayDateTimeString()}}</b><br>
{{ trans('emails.order_email') }}: <b>{{$order->email}}</b><br>


<h3>{{ trans('emails.order_items') }}</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">

    <table style="width:100%; margin:10px;">
        <tr>
            <th>
                {{ trans('emails.ticket') }}
            </th>
            <th>
                {{ trans('emails.quantity') }}
            </th>
            <th>
                {{ trans('emails.price') }}
            </th>
            <th>
                {{ trans('emails.booking_fee') }}
            </th>
            <th>
                {{ trans('emails.total') }}
            </th>
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
                {{money($order->total_amount, $order->event->currency)}}
            </td>
        </tr>
    </table>


    <br><br>
    {{ trans('emails.manage_order') }}: {{route('showEventOrders', ['event_id' => $order->event->id, 'q'=>$order->order_reference])}}
    <br><br>
</div>
<br><br>
{{ trans('emails.thank_you') }}
@stop
