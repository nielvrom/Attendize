@if(!$event->is_live)
<section id="goLiveBar">
    <div class="container">
                @if(!$event->is_live)
                This event is not visible to the public - <a style="background-color: green; border-color: green;" class="btn btn-success btn-xs" href="{{route('MakeEventLive' , ['event_id' => $event->id])}}" >Publish Event</a>
                @endif
    </div>
</section>
@endif
<section id="organiserHead" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div onclick="window.location='{{$event->event_url}}#organiser'" class="event_organizer">
                    <b>{{$event->organiser->name}}</b> {{trans('event.header.presents')}}
                </div>
            </div>
        </div>
    </div>
</section>
<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 property="name">{{$event->title}}</h1>
            <div class="event_venue">
                <span property="startDate" content="{{ $event->start_date->toIso8601String() }}">
                    {{ $event->start_date->format('l d F H:i') }}
                </span>
                -
                <span property="endDate" content="{{ $event->end_date->toIso8601String() }}">
                     @if($event->start_date->diffInHours($event->end_date) <= 12)
                        {{ $event->end_date->format('H:i') }}
                     @else
                        {{ $event->end_date->format('l d M H:i') }}
                     @endif
                </span>
                @
                <span property="location" typeof="Place">
                    <b property="name">{{$event->venue_name}}</b>
                    <meta property="address" content="{{ urldecode($event->venue_name) }}">
                </span>
            </div>

            <div class="event_buttons">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="{{$event->event_url}}}#tickets">{{trans('event.header.tickets')}}</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="{{$event->event_url}}}#details">{{trans('event.header.details')}}</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="{{$event->event_url}}}#location">{{trans('event.header.location')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
