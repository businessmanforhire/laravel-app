@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/hospital-patient-profile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/carousel.css')}}">
@endsection
@section('content')

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">My Profile</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">My business profile </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{route('business.edit.profile')}}" class="btn btn-sm btn-primary">Edit profile</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="patient-profile">
                    <div class="row match-height">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 d-flex justify-content-around">
                                            <div class="patient-img-name text-center">
                                                @if($business->image=='')
                                                <img src="{{URL::asset('images/my_profile.png')}}" alt="" class=" rounded-circle  height-150">
                                                @else
                                                    <img src="{{asset('storage/images/business/'.$business->image)}}"   class="img-responsive rounded-circle  height-150" alt="">

                                                @endif


                                                    <br>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 d-flex justify-content-around">
                                            <div class="patient-info">
                                                <ul class="list-unstyled"><br><br>
                                                    <li>
                                                        <div class="patient-info-heading">Name </div> {{$business->business_name}}
                                                    </li>
                                                    <li>
                                                        <div class="patient-info-heading">Email: </div> {{Auth::user()->email}}
                                                    </li>
                                                    <li>
                                                        <div class="patient-info-heading">Contact:</div> {{Auth::user()->phone}}
                                                    </li>
                                                    <li>
                                                        <div class="patient-info-heading">Nuis:</div>  {{$business->nuis}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-gradient-y-info">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Address</h5>
                                </div>
                                <div class="card-content mx-2">
                                    <ul class="list-unstyled text-white patient-info-card">
                                        <li><span class="patient-info-heading">City : </span>{{\App\City::where('id',$business->city_id)->value('name')}}</li>
                                        <li><span class="patient-info-heading">Address :</span> {{$business->address}}</li>
                                        <li><span class="patient-info-heading">Delivery :</span> {{floatval($business->delivery_price)}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-gradient-y-warning">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Open Hours</h5>
                                </div>
                                <div class="card-content mx-2">
                                    <ul class="list-unstyled text-white">
                                        <li>Weekday <span class="float-right">{{$business->open}} - {{$business->close}} </span></li>
                                        <li>Weekend <span class="float-right">{{$business->weekend_open}} - {{$business->weekend_close}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="col-5">
                                            <h5 class="mb-1"><i class="ft-link"></i> Details</h5>
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td>Business:    </td>
                                                    <td>{{$business->business_name}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Category:     </td>
                                                    <td>{{\App\BusinessCategory::find($business->business_category_id)->name}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <h5 class="mb-1"><i class="ft-link"></i> Social Links</h5>
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td>Url:</td>
                                                    <td><a href="{{$business->url}}" target="_blank">{{$business->url}}</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <h5 class="mb-1"><i class="ft-info"></i> Description</h5>

                                            <td>{{$business->description}}</td>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="btn-group float-md-right" role="group" >
                                        <a href="{{route('business_images')}}" class="btn btn-sm btn-primary"><span class="la la-pencil-square-o"></span>Edit Images</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper">
                                            <div class="carousel">
                                                @if(count($business_images)>0)
                                                <button type="button" id="carousel-arrow-prev" class="carousel-arrow carousel-arrow-prev" arial-label="Image précédente"></button>
                                                <button type="button" id="carousel-arrow-next" class="carousel-arrow carousel-arrow-next" arial-label="Image suivante"></button>
                                                <img id="carousel-0" class="carousel-img carousel-img-displayed" src="{{asset('storage/images/business/'.$business_images[0]['image'])}}" alt="Winter" />
                                                @for($i=1;$i<count($business_images);$i++ )
                                                    <img id="carousel-{{$i}}" class="carousel-img carousel-img-noDisplay" src="{{asset('storage/images/business/'.$business_images[$i]['image'])}}" alt="Sea" />
                                                @endfor
                                                    @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/leaflet/leaflet.js')}}"></script>
    <script>
        document.getElementById('carousel-arrow-next').addEventListener('click',carouselSwipe,false);
        document.getElementById('carousel-arrow-prev').addEventListener('click',carouselSwipe,false);

        /**
         * Switch header carousel to next image (swipe right)
         */
        function carouselSwipe() {

            // Récupère les numéros de l'ancienne et la nouvelle image
            var currentImg = document.getElementsByClassName('carousel-img-displayed')[0].id.substring(9);
            var newImg = parseInt(currentImg);

            // Gestion du début et de la fin de la liste d'images
            if (this.id == 'carousel-arrow-next') {
                newImg++;
                if (newImg >= document.getElementsByClassName('carousel-img').length) {
                    newImg = 0;
                }
            } else if (this.id == 'carousel-arrow-prev') {
                newImg--;
                if (newImg<0) {
                    newImg = document.getElementsByClassName('carousel-img').length-1;
                }
            }

            // Disparition progressive de l'ancienne image
            document.getElementById('carousel-'+currentImg).className = 'carousel-img carousel-img-hidden';

            // Apparition progressive de la nouvelle image
            var displayedCarousel = document.getElementById('carousel-'+newImg);
            displayedCarousel.className = 'carousel-img carousel-img-hidden';
            setTimeout(function() {
                displayedCarousel.className = 'carousel-img carousel-img-displayed';
            },20);

            // Disparition totale de l'ancienne image
            setTimeout(function() {
                document.getElementById('carousel-'+currentImg).className = 'carousel-img carousel-img-noDisplay';
            },520);

        }
    </script>


@endsection
