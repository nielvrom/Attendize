@extends('Emails.Layouts.Master')

@section('message_content')
{{trans('emails.hello')}},<br><br>

{!! trans('emails.ordersucccess', ['eventtitle'=> $order->event->title ]) !!}<br><br>

{{trans('emails.attachment')}} {{trans('emails.view_order_info')}}: {{route('showOrderDetails', ['order_reference' => $order->order_reference])}}

@if(!$order->is_payment_received)
<br><br>
<b>{{trans('emails.requires_payment')}} {{route('showOrderDetails', ['order_reference' => $order->order_reference])}}</b>
<br><br>
@endif
<h3>{{trans('emails.orderdetails.title')}}</h3>
{{trans('emails.orderdetails.reference')}}: <b>{{$order->order_reference}}</b><br>
{{trans('emails.orderdetails.name')}}: <b>{{$order->full_name}}</b><br>
{{trans('emails.orderdetails.date')}}: <b>{{$order->created_at->toDayDateTimeString()}}</b><br>
{{trans('emails.orderdetails.email')}}: <b>{{$order->email}}</b><br>
<a href="{!! route('downloadCalendarIcs', ['event_id' => $order->event->id]) !!}">Add To Calendar</a>
<h3>{{trans('emails.orderitems.title')}}</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">
    <table style="width:100%; margin:10px;">
        <tr>
            <td>
                <b>{{trans('emails.orderitems.ticket')}}</b>
            </td>
            <td>
                <b>{{trans('emails.orderitems.qty')}}</b>
            </td>
            <td>
                <b>{{trans('emails.orderitems.price')}}</b>
            </td>
            <td>
                <b>{{trans('emails.orderitems.fee')}}</b>
            </td>
            <td>
                <b>{{trans('emails.orderitems.total')}}</b>
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
                                        FREE
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
                                        FREE
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
                <b>{{trans('emails.orderitems.subtotal')}}</b>
            </td>
            <td colspan="2">
               {{money($order->amount + $order->order_fee, $order->event->currency)}}
            </td>
        </tr>
    </table>

    <br><br>
</div>
<br><br>
{{trans('emails.thank_you')}}
@stop
