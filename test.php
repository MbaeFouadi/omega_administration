<?php $ch = curl_init();
            // define options
            $optArray = array(
                CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                CURLOPT_RETURNTRANSFER => true
            );

            // apply those options
            curl_setopt_array($ch, $optArray);

            // execute request and get response
            $result = curl_exec($ch);

            // also get the error and response code
            $errors = curl_error($ch);
            $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            // var_dump($errors);
            $sessionId= substr($result,3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="https://26900.tagpay.fr/online/online.php" method="post">

        <input type="hidden" name="sessionid" value="<?=$sessionId?>">
        <input type="hidden" name="merchantid" value="2274832632922162">
        <input type="hidden" name="amount" value="2000">
        <input type="hidden" name="currency" value="174">
        <!-- <input type="hidden" name="accepturl" value="autorisation.univ-comores.km/accepturl">
        <input type="hidden" name="cancelurl" value="autorisation.univ-comores.km/cancelurl">
        <input type="hidden" name="declineurl" value="autorisation.univ-comores.km/declineurl"> -->
        <input name="ok" type="submit" value="Payment">
    </form>


    <!-- <a href="https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162">aaa</a> -->
</body>
</html>

