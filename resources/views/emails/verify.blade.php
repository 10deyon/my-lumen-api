<div style="margin-left: 10%; width: 80%; height: 100%; background-color: #ffe;">

    <div style="text-align: center;">
        <img src="{{url("images/logo.jpeg")}}" style="width: 20vh; height: 200px;" />
    </div>

    <div style="text-align: center; margin-bottom: 50px;">
        <h3>Welcome to Accelerate</h3>
    </div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">

                    <div style="text-align: center;">
                        <a target="_blank" style="background-color: #D5472A;
                        color: white;
                        padding: 1em 1.5em;
                        text-decoration: none;
                        border-radius: 10px;
                        width: 20vh;
                        text-transform: uppercase;" href="{{url('/api/v1/merchant/email/verify')}}?token={{$token}}">Click to activate</a>
                    </div>

                    <div style="text-align: center;">
                        <h1>{{$otp}}</h1>
                    </div>

                    <p>Your email has been used to register on our system follow the link below to verify<br />
                        <a href="{{url('/api/v1/merchant/email/verify')}}?token={{$token}}" target="_blank">{{url('/api/v1/merchant/email/verify')}}?token={{$token}}</a>
                    </p>

                    <div style="text-align: center; margin-top: 8vh;">
                        <p>Your email has been used to register on our system follow the link below to verify<br />
                            <a href="{{url('/api/v1/merchant/email/verify')}}?token={{$token}}" target="_blank">{{url('/api/v1/merchant/email/verify')}}?token={{$token}}</a>
                        </p>

                    </div>

                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>











<div style="margin-left: 10%; width: 80%; height: 100%; background-color: #ffe;">

    <div style="text-align: center;">
        <img src="{{url("images/logo.jpeg")}}" style="width: 20vh; height: 200px;" />
    </div>

    <div style="text-align: center; margin-bottom: 50px;">
        <h3>Welcome to Accelerate</h3>
    </div>
  
    <div style="text-align: center;">
        <a  target="_blank" style="background-color: #D5472A;
        color: white;
        padding: 1em 1.5em;
        text-decoration: none;
        border-radius: 10px;
        width: 20vh;
        text-transform: uppercase;" href="{{url('/api/v1/merchant/email/verify')}}?token={{$token}}">Click to activate</a>
    </div>

    <div style="text-align: center;">
        <h1>{{$otp}}</h1>
    </div>

    <div style="text-align: center; margin-top: 8vh;">
        <p>Your email has been used to register on our system follow the link below to verify<br />
            <a href="{{url('/api/v1/merchant/email/verify')}}?token={{$token}}" target="_blank">{{url('/api/v1/merchant/email/verify')}}?token={{$token}}</a>
        </p>

    </div>

    <div style="
    margin-top: 10vh;
    /* negative value of footer height */
    height: 10vh;
    clear: both;
    background-color: #E78B47;">
        <div style="text-align: center; ">
            Copyright &copy Accelerate
        </div>
    </div>  

{{-- 
    #D5472A
    Secondary:  #E78B47 --}}
</div>

