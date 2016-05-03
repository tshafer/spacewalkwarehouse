@include('partials.header')
@include('partials.slider')

@include('flash::messages')
@yield('content')

@include('partials.footer')
@yield('scripts')
