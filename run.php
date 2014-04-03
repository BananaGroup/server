<?php

require 'lib/functions.php';
require 'src/Connect.php';
require 'src/Readings.php';
require 'src/Sensor.php';


$db = Connect::getInstance();


/*
 *  POST/CREATE save reading(s)
 */
if (!empty($_POST)) {


    $readings  =  array();
    $responses =  array();


    // check datatype as CSV/JSON/POST, save it to readings array
    if (isset($_POST['datatype']) && $_POST['datatype'] == 'csv' && isset($_FILES['file'])) {

        $readings = csv_to_array($_FILES['file']['tmp_name']);

    } else if (isset($_POST['datatype']) && $_POST['datatype'] == 'json') {

        $readings = json_decode($_FILES['file']['tmp_name']);

    } else {

        $readings[] = array(  'user_id'    =>  (int) $_POST['user_id'],
                              'sensor_id'  =>  (int) $_POST['sensor_id'],
                              'value'      =>  $_POST['value'],
                              'timestamp'  =>  $_POST['timestamp']
                            );

    }


    // Insert each reading to the database
    foreach ($readings as $r) {

        // new object for each reading, and insert and save the response.
        $sensor = new Sensor;
        $sensor->setReading($r['user_id'], $r['sensor_id'], $r['value'], $r['timestamp']);
        $responses[] = $sensor->insertReading()->response;

    }


    // echo success messages as JSON
    echo json_encode($responses);


/*
 *  GET/READ get readings
 */
} else {


    // Get all variables if exist
    $user_id =  (  isset(  $_GET['user_id']    )   ?   $_GET['user_id']                :   false);   
    $date    =  (  isset(  $_GET['timestamp']  )   ?   urldecode($_GET['timestamp'])   :   false);
    $before  =  (  isset(  $_GET['before']     )   ?   urldecode($_GET['before'])      :   false);
    $after   =  (  isset(  $_GET['after']      )   ?   urldecode($_GET['after'])       :   false); 

    $readings = new Readings;


    // iniate response array
    $data = array(  'user_id'    =>  $user_id,
                    'readings'   =>  array()
                 );
                 
    $results = $readings->fetch($user_id, $date, $before, $after);

    while ($r = $results->fetch_array(MYSQLI_ASSOC)) {
        $data['readings'][] = $r;
    }

    echo json_encode($data);


}