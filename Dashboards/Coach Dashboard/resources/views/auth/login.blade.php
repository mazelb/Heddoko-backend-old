@extends('angularnonapppages')

@section('content')

<div class="page-signin">

    <div class="signin-header">
        <div class="container text-center">
            <section class="logo">
                <i class="fa fa-2x fa-slack"></i></a>
            </section>
        </div>
    </div>

    <div class="main-body">
        <div class="container">
            <div class="form-container">

                <section class="row signin-social text-center">
                    <a href="javascript:;" class="btn btn-twitter" tooltip-placement="top" tooltip="Signin with twitter" tooltip-append-to-body="true"><i class="fa fa-twitter"></i></a>
                    <div class="space"></div>
                    <a href="javascript:;" class="btn btn-facebook" tooltip-placement="top" tooltip="Signin with facebook" tooltip-append-to-body="true"><i class="fa fa-facebook"></i></a>
                    <div class="space"></div>
                    <a href="javascript:;" class="btn btn-google-plus" tooltip-placement="top" tooltip="Signin with google" tooltip-append-to-body="true"><i class="fa fa-google-plus"></i></a>
                </section>

                <span class="line-thru">OR</span>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                    <fieldset>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email"
                                       class="form-control"
                                       placeholder="Email"
									   name="email"
									   value="{{ old('email') }}"
                                       >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password"
                                       class="form-control"
                                       placeholder="password"
									   name="password"
                                       >
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        </div>
                    </fieldset>
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

                <section>
                    <p class="text-center"><a href="{{ url('/password/email') }}">Forgot your password?</a></p>
                    <p class="text-center text-muted text-small">Don't have an account yet? <a href="{{ url('/auth/register') }}">Sign up</a></p>
                </section>
                
            </div>
        </div>
    </div>

</div>

@endsection
