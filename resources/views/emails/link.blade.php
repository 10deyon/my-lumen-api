<div style="margin-left: 10%; width: 80%; height: 100%; background-color: #ffe;">

    <div style="text-align: center;">
        <img src="{{url("images/logo.jpeg")}}" style="width: 20vh; height: 200px;" />
    </div>

    <div style="text-align: center; margin-bottom: 50px;">
        <h3>Payment Link</h3>
    </div>


    <div style="text-align: center; margin-top: 8vh;">
       <p>Description: {{$link->description}}</p>
       <p>Link: {{$link->short_link}}</p>

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


</div>

