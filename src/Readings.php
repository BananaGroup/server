<?php

class Readings {

    public $response;

    /**
     * Prints the current response
     * @return void
     */
    public function response() {
        
        echo $this->response;

    }


    public function fetch($user_id, $date, $before, $after) {

        if (!$user_id) {
            die(json_encode('Missing user_id'));
        }

        $query = "SELECT * FROM sensors WHERE user_id=$user_id";
        

        if ($date) {

            // get for specific date
            $query .= " AND timestamp='$date'";

        } else if ($before && $after) {

            // get for specific range
            $query .= " AND timestamp between '$after' and '$before'";

        } else if ($after) {

            // get for after date
            $query .= " AND timestamp > '$after'";

        } else if ($before) {

            // get before date
            $query .= " AND timestamp < '$before'";

        } 
        
        $db = Connect::getInstance();

        // return MYSQL array of data
        return $db->query($query);

    }

}