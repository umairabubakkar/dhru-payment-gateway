<?php
// 
// DHRU FUSION PAYMENT GATEWAY DEMO STATES , (EXAMPLE WITH PAYPAL)
//
// Default include files 
define("DEFINE_MY_ACCESS", true);
include '../../../comm.php';
require '../../../includes/fun.inc.php';
include '../../../includes/gateway.fun.php';
include '../../../includes/invoice.fun.php';


// Load gateway parameters .
$GATEWAY = loadGatewayModule('customgateway');


// Get Data from Merchnat .
// for e.g. they are sending you in POST 
$GETDATA = $_POST ;


// if payment Pending Or Failed (for e.g. merchant sent you with 'status' )
if ($GETDATA['status'] == 'Pending' )
{
    logTransaction('customgateway', $_POST , 'Pending');
    exit();
}

// Search same transaction id is not repeated again .
if ($GETDATA['TXNID'])
{
    if (checkTransID($GETDATA['TXNID']))
    {
        exit();
    }
}

// Find Invoice id in call back POST DATA .
if ($GETDATA['INVOICEID'])
{
    // Add payment  
    addPayment($GETDATA['INVOICEID'], $GETDATA['TXNID'], $GETDATA['AMOUNT'], $GETDATA['FEE'], 'customgateway');
    logTransaction('customgateway', $_POST , 'Successful ');
    exit();
}

?>