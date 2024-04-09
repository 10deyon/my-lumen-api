<div style="
  margin-left: 10%; 
  width: 80%; 
  height: auto; 
  background-color: #F5F7F9; 
  margin: 0; 
  line-height: 1.4; 
  color: #839197; 
  font-family: 'Helvetica Neue', Helvetica, sans-serif;">

  <div style="text-align: center;">
    <img src="{{url('images/logo.png')}}" style="width: 20vh; height: 200px;" />
  </div>

  <div style="text-align: center; margin-bottom: 50px; color: #000000;">
    <h3>Password Reset</h3>
  </div>

  <div style="text-align: center;">
    <!-- <h1 style="margin-top: 0; color: #292E31; font-size: 18px; font-weight: bold; text-align: center;">Reset your password</h1> <br> -->
    <a  target="_blank" style="background-color: #FF3665; 
    color: #ffffff;
    padding: 1em 1.5em; 
    text-decoration: none; 
    border-radius: 10px; 
    width: 20vh; 
    text-transform: uppercase;" 
    
    href="https://web.netlify.app/change-password?token={{$token}}">Click to Reset Password</a>
  </div>

  <div style="font-size: 15px; font-weight: bold; color: #000000; text-align: center; margin-top: 8vh;">
    <p>If you’re having trouble clicking the button, copy and paste the URL below into your web browser.<br /> <br />

      <a href="https://web.netlify.app/change-password?token={{$token}}" target="_blank">https://web.netlify.app/change-password?token={{$token}}</a>
    </p>
  </div>

  <div style="margin-top: 7vh; height: 12vh; clear: both; background-color: #051E3E;">

    <p style="margin-top: 10px; color: #ffffff; font-size: 15px; line-height: 1.5em; padding: 1em; text-align: center;"> You received this email because you registered on our system. If you didn't make this request, you can safely delete this email. <br />
      </p>
    <p style="color: #ffffff; font-size: 14px; text-align: center"> Copyright &copy CreditMe</p>
  </div>
</div>

