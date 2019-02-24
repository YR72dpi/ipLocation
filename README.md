

# ipLocation
I coded this class for have some informations from ip.
This class use http://ip-api.com/.

If you have a question or just want talk with me, you can come on [my Twitter](https://twitter.com/DevIl00110000).

## How to use
It's simple. You can have informations in differentes format :
 - Array
 - JSON
 - XML
 - Serialized 

### Array
Code :
``` php
$ip_info = new iplocation("216.58.223.4");
$ip_info->array();
```
Return : (with var_dump)
``` php
**array** _(size=14)_
  'as' => string 'AS15169 Google LLC' _(length=18)_
  'city' => string 'Johannesburg' _(length=12)_
  'country' => string 'South Africa' _(length=12)_
  'countryCode' => string 'ZA' _(length=2)_
  'isp' => string 'Google LLC' _(length=10)_
  'lat' => float -26.2041
  'lon' => float 28.0473
  'org' => string 'Google LLC' _(length=10)_
  'query' => string '216.58.223.4' _(length=12)_
  'region' => string 'GT' _(length=2)_
  'regionName' => string 'Gauteng' _(length=7)_
  'status' => string 'success' _(length=7)_
  'timezone' => string 'Africa/Johannesburg' _(length=19)_
  'zip' => string '2041' _(length=4)_
```
### Object
Code :
``` php
$ip_info = new iplocation("216.58.223.4");
$ip_info->object();
```
Return : (with var_dump)
``` php
**object**(_stdClass_)[_2_]
  _public_ 'as' => string 'AS15169 Google LLC' _(length=18)_
  _public_ 'city' => string 'Johannesburg' _(length=12)_
  _public_ 'country' => string 'South Africa' _(length=12)_
  _public_ 'countryCode' => string 'ZA' _(length=2)_
  _public_ 'isp' => string 'Google LLC' _(length=10)_
  _public_ 'lat' => float -26.2041
  _public_ 'lon' => float 28.0473
  _public_ 'org' => string 'Google LLC' _(length=10)_
  _public_ 'query' => string '216.58.223.4' _(length=12)_
  _public_ 'region' => string 'GT' _(length=2)_
  _public_ 'regionName' => string 'Gauteng' _(length=7)_
  _public_ 'status' => string 'success' _(length=7)_
  _public_ 'timezone' => string 'Africa/Johannesburg' _(length=19)_
  _public_ 'zip' => string '2041' _(length=4)_
```

### Json
Code :
``` php
$ip_info = new iplocation("216.58.223.4");
$ip_info->json();
```
Return : (with var_dump)
``` php
string '{"as":"AS15169 Google LLC","city":"Johannesburg","country":"South Africa","countryCode":"ZA","isp":"Google LLC","lat":-26.2041,"lon":28.0473,"org":"Google LLC","query":"216.58.223.4","region":"GT","regionName":"Gauteng","status":"success","timezone":"Africa\/Johannesburg","zip":"2041"}' _(length=286)_
```

### XML
Code :
``` php
$ip_info = new iplocation("216.58.223.4");
$ip_info->xml();
```
Return : (with var_dump)
``` php
string '<?xml version="1.0" encoding="utf-8"?>
<params>
<param>
 <value>
  <struct>
   <member>
    <name>as</name>
    <value>
     <string>AS15169 Google LLC</string>
    </value>
   </member>
   <member>
    <name>city</name>
    <value>
     <string>Johannesburg</string>
    </value>
   </member>
   <member>
    <name>country</name>
    <value>
     <string>South Africa</string>
    </value>
   </member>
   <member>
    <name>countryCode</name>
    <value>
     <string>ZA</string>
    </value>
   </member>
   <'... _(length=1595)_
```

### serialized
Code :
``` php
$ip_info = new iplocation("216.58.223.4");
$ip_info->serialized();
```
Return : (with var_dump)
``` php
string 'a:14:{s:2:"as";s:18:"AS15169 Google LLC";s:4:"city";s:12:"Johannesburg";s:7:"country";s:12:"South Africa";s:11:"countryCode";s:2:"ZA";s:3:"isp";s:10:"Google LLC";s:3:"lat";d:-26.2041;s:3:"lon";d:28.0473;s:3:"org";s:10:"Google LLC";s:5:"query";s:12:"216.58.223.4";s:6:"region";s:2:"GT";s:10:"regionName";s:7:"Gauteng";s:6:"status";s:7:"success";s:8:"timezone";s:19:"Africa/Johannesburg";s:3:"zip";s:4:"2041";}' _(length=408)_
```

## Request by minute
[The api](http://ip-api.com/) set a limit of 150 request by minute. So there is a limit in a class. You can use status() for know if you can use the class
Exemple :
``` php
if($ip_info->status()["status"]) {
  // your code ...
}