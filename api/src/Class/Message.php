<?php

class Message {

    public function errorPDO(PDOException $e) {
        return error_log('ERROR IN : ' . __CLASS__ . '/' . __FUNCTION__ . ' - ' . $e->getMessage());
    }

}
