# Nest plugin for Munin


Create a graph with Target and Ambient temperature or your Nest

Just edit the script with your DEVIDEID, ACCESSTOKEN AND STRUCTUREID

### GUIDE TO OBTAIN DEVIDEID, ACCESSTOKEN AND STRUCTUREID 
Thanks to http://remco.bierings.eu/?p=132

#### Step 1 – Create a Nest Developer account and product

You must create a Nest Developer account here if you don’t have one – https://developer.nest.com/

Then create a Product.  Mine is called “Control Nest from shell”.  Make sure you grant read/write permissions for the Thermostat and Away.

Copy down the Product ID and Product Secret values.  You will need them later.  You will also need the Authorization URL in the next step so don’t close this window!

#### Step 2 – Get your PIN Code for your Nest Thermostat

Nest Thermostat Authorization ScreenCopy the Authorization URL shown on the right side of the Nest Developer Product Details page and paste it into a new browser window.  It should prompt you to allow your Product to connect to your personal Nest account.  Click on Continue.

It should then give you a PIN Code.  Copy this down carefully!!!

 
#### Step 3 – Get your Access Code

Now that you have a PIN Code, you need to generate an API Access Code using your PIN Code and the Product ID and Product Secret from your Nest Developer Product Details Page.

```curl -X POST "https://api.home.nest.com/oauth2/access_token?client_id=YOUR_PRODUCT_ID&code=YOUR_PIN_CODE&client_secret=YOUR_PRODUCT_SECRET&grant_type=authorization_code"```

Replace the YOUR_* values with the correct values for your application the Nest PIN.   Then execute this in your command line.  You should get back a long access token that starts with a “c.”.  This long string is your Access Token and will be used for authorization for API calls.

#### Step 4 – Get Your Nest Thermostat and Structure IDs

Now that you have your Access Token you can retrieve the IDs for your Thermostat and Structure (Home) which you’ll need to setup the command line API aliases.

```curl -L https://developer-api.nest.com/devices/thermostats\?auth\=%YOUR_ACCESS_TOKEN%"```

This command will return a big block of JSON data.  What you are looking for in there are two values: the device_id and the structure_id.  Copy those values, you will need them soon.
