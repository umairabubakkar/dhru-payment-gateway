# dhru-payment-gateway
# To get started
Download gateway development kit (Download)

Unzip and find “customgateway.php” from this download and rename to "yourgatewayname.php ". It should be all lowercase and must start with a letter.

All functions within a gateway module must be prefixed with the filename also so once you’ve chosen a name, open the file and replace all occurrences of "customgateway_" with " yourgatewayname_ "

# Config Array
Next, you can configure the yourgatewayname_config array.

This function is the primary function required by all gateway modules and defines both the friendly display name for the module and any custom fields/options/settings your gateway module requires.

The available field types are text, dropdown, text area and yes/no (checkboxes)

the sample config array in customgateway.php demonstrates with PayPal payment gateway and how to use each of these types.

# Creating Payment gateway button
Now, create new function yourgatewayname_link($PARAMS)

And return with gateway specific code (an example for how to do this is shown in the gateway module supplied with this download kit.)

This should normally take the format of a form post and you simply need to return the HTML code for the form from this function.

The variables are available in $PARAMS .

# Callbacks
A sample callback file is included in the downloaded kit for a named customgatewaycallback.php To utilise this script, you simply need to rename it to match your gateway module and modify the variables within it as per the comments in the code, and to match the variables your specific gateway returns.
