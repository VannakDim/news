@php
    $contact=DB::table('contacts')->first();
@endphp
<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Company</h3>
                    <p>{{ $contact->address }}<br>
                        <strong>Phone:</strong> {{ $contact->phone }}<br>
                        <strong>Email:</strong> {{ $contact->email }}<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright <strong><span>កូនខ្មែរ</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
                Designed by <a href="https://t.me/vannak_dim"  target="_blank" rel="noopener noreferrer">Vannak Dim</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            @if ($contact->facebook)
                <a href="{{ $contact->facebook }}" target="_blank" rel="noopener noreferrer" class="facebook"><i class="bx bxl-facebook"></i></a> 
            @endif
            @if ($contact->instagram)
                <a href="{{ $contact->instagram }}" target="_blank" rel="noopener noreferrer" class="instagram"><i class="bx bxl-instagram"></i></a> 
            @endif
            @if ($contact->telegram)
                <a href="{{ $contact->telegram }}" target="_blank" rel="noopener noreferrer" class="telegram"><i class="bx bxl-telegram"></i></a>
            @endif
            @if ($contact->twitter)
                <a href="{{ $contact->twitter }}" target="_blank" rel="noopener noreferrer" class="twitter"><i class="bx bxl-twitter"></i></a>
            @endif
            @if ($contact->linkedin)
                <a href="{{ $contact->linkedin }}" target="_blank" rel="noopener noreferrer" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            @endif
            @if ($contact->youtube)
                <a href="{{ $contact->youtube }}" target="_blank" rel="noopener noreferrer" class="youtube"><i class="bx bxl-youtube"></i></a>
            @endif
            
        </div>
    </div>
</footer><!-- End Footer -->