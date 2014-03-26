<?php

require 'src/Connect.php';
require 'src/Readings.php';
require 'src/Sensor.php';


$db = Connect::getInstance();


if (!empty($_POST)) {

    /*
     *   POST REQUEST
     */

    $sensor = new Sensor;

    try {

        $sensor->setReading($_POST['user_id'], $_POST['sensor_id'], $_POST['value'], $_POST['timestamp']);
        $sensor->insertReading()->response();

    } catch (Exception $e) {

        echo json_encode(array("error" => "unspecified error", "info" => $e));

    }

} else {

    /*
     *   GET REQUEST
     */
    
    // Get all variables if exist
    $user_id=   (   isset(  $_GET['user_id']    )   ?   $_GET['user_id']        :   false);   
    $date   =   (   isset(  $_GET['timestamp']  )   ?   $_GET['timestamp']      :   false);
    $before =   (   isset(  $_GET['before']     )   ?   $_GET['before']         :   false);
    $after  =   (   isset(  $_GET['after']      )   ?   $_GET['after']          :   false); 

    $readings = new Readings;

    $data = array(  'user_id'    =>  $user_id,
                    'readings'   =>  array()
                 );
                 
    foreach ($readings->fetch($user_id, $date, $before, $after) as $reading) {

        // for each sensor add new object
        $sensor = new Sensor;

        $sensor->setReading($reading['user_id'], $reading['sensor_id'], $reading['value'], $reading['timestamp']);

        $data[] = $sensor->getReading();

    }
    

}