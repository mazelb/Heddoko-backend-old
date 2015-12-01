@extends('layouts.web')

@section('html-class', 'auth-login')

@section('content')

<!-- <h1 class="inspiring-quote">{{ Inspiring::quote() }}</h1> -->
<h1 class="inspiring-quote">
    More Than Just a Coach
</h1>

<div class="page-signin">
    <div class="main-body">
        <div class="container" style="margin-bottom:50px;">

            <!-- Login form -->
            <form class="auth-form" role="form" method="POST" action="{{ url('/auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">

                    <!-- Username -->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-1">
                        <input
                            type="text"
                            name="username"
                            placeholder="Username"
                            required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required>

                        <a href="{{ url('/password/email') }}">Forgot password?</a>
                    </div>

                    <!-- Submit button -->
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        <input
                            type="submit"
                            class="btn btn-default"
                            name="name"
                            value="Login">

                        <a href="{{ url('/auth/register') }}" class="create-account">Create a new account</a>
                    </div>
                </div>

            </form>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- <div class="form-container">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">



					<div class="form-group">
						<input
                            type="text"
                            class="form-control"
                            placeholder="Username"
                            name="username">
					</div>
					<div class="form-group">
						<input type="password"
									 class="form-control"
									 placeholder="password"
									 name="password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
					</div>

                </form>

                <section>
                    <p class="text-center">
                        <a style="color:white" href="{{ url('/password/email') }}">Forgot your password?</a></p>
                    <p class="text-center" style="color:white" text-muted text-small>
                        Don't have an account yet? <a href="{{ url('/auth/register') }}">Sign up</a></p>
                </section>

            </div> -->
        </div>
    </div>

</div>

@endsection
