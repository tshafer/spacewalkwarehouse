<!doctype html>
<html>
    @include('frontend.partials.header')
    <section id="main" class="full-width clearfix font-fix" style="max-width: inherit;">
        @include('flash::messages')
        @yield('content')
    </section>
    @include('frontend.partials.footer')
    @yield('scripts')
    </body>
</html>