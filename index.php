<?php

function getCoords( array $fields, string $key ) {

  if( !$fields || !$key ) return;

  $data = [];

  $params = http_build_query($fields);

  $endpoint = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&key=$key&$params";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $endpoint );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($ch);
  $result = json_decode( $result );

  $result = $result->results[0];

  $address_components = $result->address_components;

  $key = [
    'address'   => 'address',
    'city'      => 'administrative_area_level_3',
    'provincia' => 'administrative_area_level_2',
    'regione'   => 'administrative_area_level_1',
    'number'    => 'street_number',
    'route'     => 'route',
    'country'   => 'country',
    'cap'       => 'postal_code',
  ];

  $address  = $result->formatted_address;
  $lat      = $result->geometry->location->lat;
  $lng      = $result->geometry->location->lng;
  $place_id = $result->place_id;

  if( !$result ) return;

  if( $address )  $data['indirizzo']  = $address;
  if( $lat )      $data['lat']        = $lat;
  if( $lng )      $data['lng']        = $lng;
  if( $place_id ) $data['place_id']   = $place_id;
  
  foreach( $result->address_components as $item ){
    $type = $item->types[0];
    if( $type == $key['number'] )     $data['street_number']    = $item->long_name;
    if( $type == $key['route'] )      $data['street']           = $item->long_name;
    if( $type == $key['city'] )       $data['city']             = $item->long_name;
    if( $type == $key['country'] )    $data['country']          = $item->long_name;
    if( $type == $key['country'] )    $data['country_code']     = $item->short_name;
    if( $type == $key['provincia'] )  $data['provincia']        = $item->long_name;
    if( $type == $key['provincia'] )  $data['provincia_sigla']  = $item->short_name;
    if( $type == $key['regione'] )    $data['regione']          = $item->long_name;
    if( $type == $key['cap'] )        $data['cap']              = $item->long_name;
  }

  return $data;

}