@extends('layouts.booking')

@section('content')
    <single-object :property="{{ $property }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <h1 class="mt-3">{{ $property->title }}</h1>
                    <div class="slider">
                        <div v-for="image in this.media">
                            <img :src="image.image.medium.url" />
                        </div>
                    </div>
                    <p>
                        {!! $property->description !!}
                    </p>
                    <hr>
                </div>
                <div class="col-3">
                    <h3 class="mt-3">{{__('Info')}}</h3>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><strong>{{__('Price per day')}}:</strong> {{ $property->price_per_day }}</li>
                                @if($property->country) <li><strong>{{__('Country')}}:</strong> {{ $property->country->name }}</li>@endif
                                @if($property->state)<li><strong>{{__('State')}}:</strong> {{ $property->state->name }}</li>@endif
                                @if($property->city)<li><strong>{{__('City')}}:</strong> {{ $property->city->name }}</li>@endif
                                <li><strong>{{__('Created')}}:</strong> {{ \Carbon\Carbon::parse($property->created_at)->format('M d, Y') }}</li>
                                <li><strong>{{__('Rating')}}:</strong>
                                    <star-rating
                                        :read-only="true"
                                        :star-size="20"
                                        :rating="this.property.avgrating / 2"
                                        :increment="0.5"
                                        :show-rating="false"
                                    ></star-rating>
                                </li>
                            </ul>
                            @auth
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    {{__('Book object')}}
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <book-object :property="{{ $property }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="/sign-in" class="btn btn-primary">{{__('Book object')}}</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </single-object>
@endsection

@section('css')
{{--    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>--}}
@endsection

@section('header-js')
    <script src="https://js.stripe.com/v3/"></script>
    {{--    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>--}}
@endsection
<script>
    import StarRating from "vue-star-rating/src/star-rating";
    export default {
        components: {StarRating}
    }
</script>
