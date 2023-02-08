# Google Maps Geocode
Retrieve geo data by any data via google maps geocode with Php



```php
$key = "AIzaSyXXXXXXXXXXXXXXXXXXX";

/** 
 * By place_id
 */
$args = [
  'place_id' =>  'Ei5WaWEgR2lvdmFubmkgZGVsbGEgUGVubxxxxxx'
];


/** 
 * By coords
 */
$args = [
  'lat' =>  '41.1234',
  'lng' =>  '12.1234',
];


/** 
 * By formatted address
 */
$args = [
  'address' =>  'Piazza Venezia 1, 00126 Roma RM, Italy',
];


$data = getCoords( $args , $key );

```