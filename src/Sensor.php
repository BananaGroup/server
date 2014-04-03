<?php
class Sensor extends Readings
{

    private $user_id;
    private $sensor_id;
    private $value;
    private $timestamp;


    /**
     * Set Objects values
     * @param int   $user_id    User ID
     * @param int   $sensor_id  Sensor ID
     * @param int   $value      Sensor Value
     * @param date  $timestamp  Timestamp
     */
    public function setReading($user_id, $sensor_id, $value, $timestamp) {

        $this->user_id = (int) $user_id;
        $this->sensor_id = (int) $sensor_id;
        $this->value = $value;
        $this->timestamp = $timestamp;

    }


    /**
     * Return contents of object
     * @return  array   return all values of the sensor
     */
    public function getReading() {

        return array(   'user_id'   => $user_id,
                        'sensor_id' => $sensor_id,
                        'value'     => $value,
                        'timestamp' => $timestamp
                    );

    }


    /**
     * Insert Reading into Database
     * @return $this
     */
    public function insertReading() {

        $db = Connect::getInstance();

        $insert = $db->query("INSERT INTO sensors (user_id, sensor_id, value, `timestamp`) VALUES ({$this->user_id}, {$this->sensor_id}, {$this->value}, '{$this->timestamp}')");

        // Create Array on Result
        if ($insert) {

            $this->response = array(
                    "success" => "true",
                    "user_id" => $this->user_id,
                    "reading" => array(
                        "sensor_id" => $this->sensor_id,
                        "value" => $this->value
                        ),
                    "timestamp" => $this->timestamp
                );

        } else {

            $this->response = array("error" => "insert error");

        }

        return $this;

    }

}