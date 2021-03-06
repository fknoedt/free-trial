<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Free Trial Test">

    <meta name="author" content="Filipe Knoedt">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Free Trial') }}</title>

    <!-- Built-in javascript file -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Page's javascript function -->
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- jQuery notification library -->
    <script src="{{ asset('js/notify.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/free-trial.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>


</head>
<body>
<div id="alert_placeholder"></div>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <div class="float-left mr-2">
            <img src="/img/icon-color.svg" width="40" height="40">
        </div>
        <div class="float-right">
            <input class="form-control mr-sm-2 search-input" type="text" placeholder="Search Creative Market Pro" aria-label="Search">
        </div>
    </h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Graphics</a>
        <a class="p-2 text-dark" href="#">Fonts</a>
        <a class="p-2 text-dark" href="#">Templates</a>
        <a class="p-2 text-dark" href="#">Add-Ons</a>
        <a class="p-2 text-dark" href="#">Photos</a>
        <a class="p-2 text-dark" href="#">Themes</a>
    </nav>
    <a class="btn button-salmon" href="#">Join Now</a>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Get 3 free downloads!</h1>
    <p class="lead">Start your <strong>7-day trial</strong> to access thousands of curated photos, fonts, graphics and more to deliver quality designs faster.</p>
</div>

<div class="container" id="dialog-box">
    <div class="card-deck mb-3 text-center" id="card-1">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3>Get <strong>3 free downloads</strong> when you start your free trial today.</h3>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Get access to our full Pro catalog</li>
                    <li>Cancel anytime, risk free</li>
                    <li>7 days free</li>
                </ul>
                <input type="email" class="form-control mb-3" id="email" name="email" value="" required autofocus placeholder="Enter your Email Address">
                <button id="submitButton" type="button" class="btn btn-lg btn-block button-salmon" onclick="submitEmail()">START FREE YOUR TRIAL</button>
            </div>
            <p class="px-3"><small class="disclaimer-text">The free trial is for new members only. All assets downloaded during the free trial period are covered by a basic license.</small></p>
        </div>
    </div>
    <div class="card-deck mb-3 text-center" id="card-2" style="display: none;">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3>Unfortunately, the free trial is for <strong>new members only</strong>. It looks like you already have a Creative Market account.</h3>
                <!-- button type="button" class="btn btn-lg btn-block btn-secondary" onclick="displayCard1()">GO BACK</button -->
                <button type="button" class="btn btn-lg btn-block button-salmon mt-3" onclick="window.location.href='https://creativemarket.com/';">EXPLORE OUR CATALOG</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
