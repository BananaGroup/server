<?php

class Readings {

    /**
     * Prints the current response
     * @return void
     */
    public function response() {
        
        echo json_encode($this->response);

    }


    public function fetch($user_id, $date, $before, $after) {

        if (!$user_id) {
            die(json_encode('Missing user_id'));
        }

        if ($date) {

            // get for specific date

        } else if ($before && $after) {

            // get for specific range

        } else if ($after) {

            // get for after date

        } else if ($before) {

            // get before date

        }

    }

}