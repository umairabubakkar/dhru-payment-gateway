<?php
// 
// DHRU FUSION PAYMENT GATEWAY DEMO STATES , (EXAMPLE WITH PAYPAL)
// 
defined("DEFINE_MY_ACCESS") or die ('<h1 style="color: #C00; text-align: center;"><strong>Restricted Access</strong></h1>'); 
function customgateway_config() {
    $configarray = array('name' => array('Type' => 'System','Value' => 'PayPal'),
                         'email' => array('Name' => 'PayPal Email','Type' => 'text','Size' => '40','Description' => 'Login Mail.'),
                         'SendBox' => array('Name' => 'Demo Mode SendBox ','Type' => 'yesno'),
                         'info' => array('Name' => 'Other Information','Type' => 'textarea','Cols' => '5','Rows' => '10'));
    return $configarray;
}

function customgateway_link($PARAMS) {
    global $config;
    global $lng_languag;
    $code = '';
    $invoiceid = $PARAMS['invoiceid'];
    $invoicetotal = $PARAMS['amount'];
    $invoicetotal = formatCurrency2($invoicetotal);
    $paypallink = 'https://www.paypal.com/cgi-bin/webscr';
    if($PARAMS['SendBox']) {
        $paypallink = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    }
    $code .= '<form action="'.$paypallink.'" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="'.$PARAMS['email'].'">';
    if($PARAMS['style']) {
        $code .= '<input type="hidden" name="page_style" value="'.$PARAMS['style'].'">';
    }
    $code .= '<input type="hidden" name="item_name" value="'.$PARAMS['description'].'">
    <input type="hidden" name="amount" value="'.$invoicetotal.'">
    <input type="hidden" name="tax" value="0.00">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="first_name" value="'.$PARAMS['clientdetails']['firstname'].'">
    <input type="hidden" name="last_name" value="'.$PARAMS['clientdetails']['lastname'].'">
    <input type="hidden" name="address1" value="'.$PARAMS['clientdetails']['address1'].'">
    <input type="hidden" name="city" value="'.$PARAMS['clientdetails']['city'].'">
    <input type="hidden" name="state" value="'.$PARAMS['clientdetails']['state'].'">
    <input type="hidden" name="zip" value="'.$PARAMS['clientdetails']['postcode'].'">
    <input type="hidden" name="country" value="'.$PARAMS['clientdetails']['country'].'">
    <input type="hidden" name="H_PhoneNumber" value="'.$PARAMS['clientdetails']['phonenumber'].'">
    <input TYPE="hidden" name="charset" value="'.$config['charset'].'">
    <input type="hidden" name="currency_code" value="'.$PARAMS['currency'].'">
    <input type="hidden" name="custom" value="'.$PARAMS['invoiceid'].'">
    <input type="hidden" name="return" value="'.$PARAMS['returnurl'].'&paymentsuccess=true">
    <input type="hidden" name="cancel_return" value="'.$PARAMS['returnurl'].'&paymentfailed=true">
    <input type="hidden" name="notify_url" value="'.$PARAMS['systemurl'].'/modules/gateways/callback/customgatewaycallback.php">
    <input type="hidden" name="bn" value="DHRUFUSION">
    <input type="hidden" name="rm" value="2">
    <input type="submit" value="'.$lng_languag["invoicespaynow"].'" alt="'.$lng_languag["invoicespaynow"].'">
    </form>';
    return $code;
}
?>