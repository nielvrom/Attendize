<style>
    /*
    @todo  This is temp - move to styles*/
    h3 {
        border: none !important;
        font-size: 30px;
        text-align: center;
        margin: 0;
        margin-bottom: 30px;
        letter-spacing: .2em;
        font-weight: 200;
    }

    .order_header {
        text-align: center
    }

    .order_header .massive-icon {
        display: block;
        width: 120px;
        height: 120px;
        font-size: 100px;
        margin: 0 auto;
        color: #63C05E;
    }

    .order_header h1 {
        margin-top: 20px;
        text-transform: uppercase;
    }

    .order_header h2 {
        margin-top: 5px;
        font-size: 20px;
    }

    .order_details.well, .offline_payment_instructions {
        margin-top: 25px;
        background-color: #FCFCFC;
        line-height: 30px;
        text-shadow: 0 1px 0 rgba(255, 255, 255, .9);
        color: #656565;
        overflow: hidden;
    }

    .ticket_download_link {
        border-bottom: 3px solid;
    }
</style>
<section id="order_form" class="container">
    <div class="row">
        <div class="col-md-12 order_header">
            <span class="massive-icon">
                <i class="ico ico-checkmark-circle"></i>
            </span>
            <h1>{{ trans('event.viewOrder.title') }}</h1>
            <h2>
                {!! trans('event.viewOrder.ticketline',['ticketlink'=> route('showOrderTickets', ['order_reference' => $order->order_reference])])!!}
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="content event_view_order">
                @if($event->post_order_display_message)
                    <div class="alert alert-dismissable alert-info">
                        {{ nl2br(e($event->post_order_display_message)) }}
                    </div>
                @endif
                <div class="order_details well">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <b>{{trans('forms.firstname')}}</b><br> {{$order->first_name}}
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b>{{trans('forms.lastname')}}</b><br> {{$order->last_name}}
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b>{{trans('event.viewOrder.amount')}}</b><br> {{$order->event->currency_symbol}}{{number_format($order->total_amount,2)}}
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b>{{trans('event.viewOrder.reference')}}</b><br> {{$order->order_reference}}
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b>{{trans('event.viewOrder.date')}}</b><br> {{$order->created_at->toDateTimeString()}}
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b>{{trans('forms.email')}}</b><br> {{$order->email}}
                        </div>
                    </div>
                </div>
                @if(!$order->is_payment_received)
                    <h3>{{trans('event.viewOrder.payment.title')}}</h3>
                    <div class="alert alert-info">
                        {{trans('event.viewOrder.payment.info')}}
                    </div>
                    <div class="offline_payment_instructions well">
                        {!! Markdown::parse($event->offline_payment_instructions) !!}
                    </div>

                @endif
                <h3>{{trans('event.viewOrder.items.title')}}</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                {{trans('event.viewOrder.items.ticket')}}
                            </th>
                            <th>
                                {{trans('event.viewOrder.items.quantity')}}
                            </th>
                            <th>
                                {{trans('event.viewOrder.items.price')}}
                            </th>
                            <th>
                                {{trans('event.viewOrder.items.bookingfee')}}
                            </th>
                            <th>
                                {{trans('event.viewOrder.items.total')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <b>{{trans('event.viewOrder.items.subtotal')}}</b>
                            </td>
                            <td colspan="2">
                                {{money($order->total_amount, $order->event->currency)}}
                            </td>
                        </tr>
                        @if($order->is_refunded || $order->is_partially_refunded)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <b>Refunded Amount</b>
                                </td>
                                <td colspan="2">
                                    {{money($order->amount_refunded, $order->event->currency)}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <b>{{trans('event.viewOrder.items.total')}}</b>
                                </td>
                                <td colspan="2">
                                    {{money($order->total_amount - $order->amount_refunded, $order->event->currency)}}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <h3>{{trans('event.viewOrder.attendees.title')}}</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                        @foreach($order->attendees as $attendee)
                            <tr>
                                <td>
                                    {{$attendee->first_name}}
                                    {{$attendee->last_name}}
                                    (<a href="mailto:{{$attendee->email}}">{{$attendee->email}}</a>)
                                </td>
                                <td>
                                    {{$attendee->ticket->title}}
                                </td>
                                <td>
                                    @if($attendee->is_cancelled)
                                        {{trans('event.viewOrder.attendees.cancelled')}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

