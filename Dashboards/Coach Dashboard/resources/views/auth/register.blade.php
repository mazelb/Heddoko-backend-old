@extends('angularnonapppages')

@section('content')

<div class="page-signup">

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
                    <a href="javascript:;" class="btn btn-twitter" tooltip-placement="top" tooltip="Signup with twitter" tooltip-append-to-body="true"><i class="fa fa-twitter"></i></a>
                    <div class="space"></div>
                    <a href="javascript:;" class="btn btn-facebook" tooltip-placement="top" tooltip="Signup with facebook" tooltip-append-to-body="true"><i class="fa fa-facebook"></i></a>
                    <div class="space"></div>
                    <a href="javascript:;" class="btn btn-google-plus" tooltip-placement="top" tooltip="Signup with google" tooltip-append-to-body="true"><i class="fa fa-google-plus"></i></a>
                </section>

                <span class="line-thru">OR</span>

                <section>
				
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
				
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input  type="text"
                                        class="form-control"
                                        placeholder="Name"
										name="name"
										value="{{ old('name') }}"
                                        >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email"
                                       class="form-control"
                                       placeholder="E-mail Address"
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
                                       placeholder="Password"
									   name="password"
                                       >
                            </div>
                        </div>						
						<div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </span>
                                <input type="password"
                                       class="form-control"
                                       placeholder="Confirm Password"
									   name="password_confirmation"
                                       >
                            </div>
                        </div>

                        <div class="form-group">
                            <p class="text-muted text-small">By clicking on Sign up, you agree to <a href="javascript:;">terms & conditions</a> and <a href="javascript:;">privacy policy</a></p>
                            <div class="divider"></div>
							<button type="submit" class="btn btn-primary btn-block btn-lg">Sign up</button>
                        </div>
 
                    </form>
                </section>

                <section>
                    <p class="text-center text-muted">Already have an account? <a href={{ url('/auth/login') }} >Log in now</a></p>
                </section>

            </div>
        </div>
    </div>
</div>

@endsection