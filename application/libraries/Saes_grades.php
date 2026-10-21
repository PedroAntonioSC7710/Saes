<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saes_grades {
    private $path;

    public function __construct() {
        $this->path = APPPATH . 'cache/saes_confirmaciones.json';
    }

    public function with_lock($callback) {
        $fp = fopen($this->path, 'c+');

        if (!$fp || !flock($fp, LOCK_EX)) {
            show_error('No se pudo acceder al archivo de confirmaciones.', 500);
            exit;
        }

        rewind($fp);
        $raw = stream_get_contents($fp);
        $data = json_decode($raw, true);

        if (!is_array($data)) {
            $data = array();
        }

        $result = call_user_func_array($callback, array(&$data));

        rewind($fp);
        ftruncate($fp, 0);
        fwrite($fp, json_encode($data));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);

        return $result;
    }

    public function key($prof, $mat, $grupo) {
        return (int) $prof . ':' . (int) $mat . ':' . (int) $grupo;
    }

    public function confirmed($prof, $mat, $grupo) {
        $key = $this->key($prof, $mat, $grupo);

        return $this->with_lock(function (&$data) use ($key) {
            return !empty($data[$key]);
        });
    }

    public function confirm($prof, $mat, $grupo) {
        $key = $this->key($prof, $mat, $grupo);

        return $this->with_lock(function (&$data) use ($key) {
            $data[$key] = date('c');
            return true;
        });
    }
}