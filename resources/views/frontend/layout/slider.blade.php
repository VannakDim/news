@php
    $sliders = DB::table('sliders')->get();
@endphp

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

            @foreach ($sliders as $key => $slider)
                <!-- Slide loop -->
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                    style="background-image: url({{ asset($slider->image) }});">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp kh-battambang">
                            <h2 class="kh-koulen">{{ $slider->title }}</span></h2>
                            <p class="text-center auto-hide">{{ $slider->description }}</p>
                            <div class="text-center"><a href="" class="btn-get-started auto-hide">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <a class="carousel-control-prev auto-hide" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next auto-hide" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section><!-- End Hero -->

@section('script')
    <script>
        $(document).ready(function() {
            handleViewportChange();
            window.addEventListener('resize', () => {
                handleViewportChange();
            });
        });

        // Function to handle viewport changes
        function handleViewportChange() {
            if (window.innerWidth <= 600) {
                    // console.log('Button is hidden due to small screen size');
                    $('.auto-hide').hide();
                } else {
                    // console.log('Button is shown due to large screen size');
                    $('.auto-hide').show();
                }
        }

    </script>
@endsection
