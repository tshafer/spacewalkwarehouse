<footer>
    <div class="container">
        <div class="col-md-4">
            <div class="column">
                <h4>Information</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('privacy') }}">Policy Privacy</a></li>
                    <li><a href="{{ route('terms') }}">Terms and Conditions</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="column">
                <h4>Customer Service</h4>
                <ul>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="tel:800-622-6026">800-622-6026</a></li>
                    <li><a href="{{ route('contact') }}">Email:  Info@spacewalksales.com</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="column">
                <h4>Follow Us</h4>
                <ul class="social">
                    <li><a href="https://plus.google.com/100094190545606653988" target="_blank">Google Plus</a></li>
                    <li><a href="https://www.facebook.com/Inflatablesales/" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com/spacewalk" target="_blank">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar-inverse text-center copyright">
        Copyright &copy; {{ date('Y') }} Space Walk Sales All right reserved
    </div>
</footer>


<!--scripts include-->
<script src="{{url('/')}}/js/jquery.js"></script>
<script src="{{url('/')}}/js/bootstrap.js"></script>
<script src="{{url('/')}}/js/jquery.bxslider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/js/lightgallery-all.min.js"></script>
<script src="{{url('/')}}/js/lightslider.min.js"></script>
<script src="{{url('/')}}/js/mimity.js"></script>
<script src="{{url('/')}}/js/scripts.js"></script>
</body>
</html>