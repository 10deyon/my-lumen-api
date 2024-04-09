<div style="margin-left: 10%; width: 80%; height: 100%; background-color: #ffe;">

    <div style="text-align: center;">
        <img src="{{url("images/logo.jpeg")}}" style="width: 20vh; height: 200px;" />
    </div>

    <div style="text-align: center; margin-bottom: 50px;">
        <h2>Settlement Notification</h2>
    </div>

    <table style="border: 1px solid black; width: 100%; border-collapse: collapse; border: 1px solid black;">
        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Reference</th>
            <td style="border: 1px solid black; padding: 10px;">{{$transaction->transaction_reference}}</td>
        </tr>
        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Account Name</th>
            <td style="border: 1px solid black; padding: 10px;">{{$transaction->account->account_name}}</td>
        </tr>
        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Account Number</th>
            <td style="border: 1px solid black; padding: 10px;">{{$transaction->account->account_number}}</td>
        </tr>

        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Bank Name</th>
            <td style="border: 1px solid black; padding: 10px;">{{$transaction->account->bank->name}}</td>
        </tr>

        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Amount</th>
            <td style="border: 1px solid black; padding: 10px;"><b>NGN</b> {{ (double)$transaction->amount }}</td>
        </tr>

        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Status</th>
            <td style="border: 1px solid black; padding: 10px;">{{ucwords($transaction->status)}}</td>
        </tr>


        <tr>
            <th style="border: 1px solid black; text-align: left; background-color: #E78B47; color: black; padding: 10px;">Date</th>
            <td style="border: 1px solid black; padding: 10px;">{{$transaction->created_at}}</td>
        </tr>

    </table>

  



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

