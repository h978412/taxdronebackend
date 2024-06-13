<?php 
$clientKey = $requestParams["clientKey"];
$amount = $requestParams["amount"];
$businessName = $requestParams["businessName"];
$transactionDes = $requestParams["transactionDes"];
$orderId = $requestParams["orderId"];
$callBackUrl = $requestParams["callBackUrl"];
$customerName = $requestParams["customerName"];
$customerMobile = $requestParams["customerMobile"];
$customerEmail = $requestParams["customerEmail"];

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Payment')</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <header>
    </header>

    <main>

    </main>


    <footer>

    </footer>

    <script>

        console.log("i am in scripts");
        const clientKey = "<?php echo $clientKey; ?>"
        const amount = "<?php echo $amount; ?>"
        const businessName = "<?php echo $businessName; ?>"
        const transactionDes = "<?php echo $transactionDes; ?>"
        const orderId = "<?php echo $orderId; ?>"
        const callBackUrl = "<?php echo $callBackUrl; ?>"
        const customerName = "<?php echo $customerName; ?>"
        const customerMobile = "<?php echo $customerMobile; ?>"
        const customerEmail = "<?php echo $customerEmail; ?>"


        var options = {
            "key": clientKey,
            "amount": amount,
            "currency": "INR",
            "name": businessName,
            "description": transactionDes,
            "image": "https://example.com/your_logo",
            "order_id": orderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "callback_url": callBackUrl,
            "prefill": {
                "name": customerName,
                "email": customerEmail,
                "contact": customerMobile
            },
            "notes": {
                "returnUrl": callBackUrl
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        console.log(options);

        var rzp1 = new Razorpay(options);
        rzp1.open();
    </script>
    
</body>

</html>