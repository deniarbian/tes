<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oee_model extends CI_Model
{
    public function getOee()
    {
        $query = "SELECT * FROM `input_oee` ORDER BY `id_oee` ASC";
        return $this->db->query($query)->result_array();
    }


    public function cekoee($id)
    {
        $query = "SELECT * FROM `data_standaroee` WHERE `no_standar` = $id";
        return $this->db->query($query)->result();
    }

    public function get_grafik_oee($awal, $akhir)
    {
        // SPECIFIC DATE
        $oee = $this->db->select('*')->where("tgl_oee between '$awal' and '$akhir'")->get('input_oee')->result_array();
        //$oee = $this->db->select('*')->where("no_standar")->get('data_standaroee')->result_array();
        //$p_oee = [];
        foreach ($oee as $do) {
            $a = round(((($do['jam_kerja'] - ($do['breakdown'] + $do['setup']))/ $do['jam_kerja']) * 100), 1.0);
            $p = round((($do['jam_kerja'] / ($do['run_time']) / $do['ideal_runtime']) * 100), 1.0);
            $q = round((($do['total_count'] - $do['bad_count']) / $do['ideal_runtime'] * 100), 1.0);
            $o = round(($a/100) * ($p/100) * ($q/100) * 100);

            $oe = new stdClass();
            $oe->id_oee = $do['id_oee'];
            $oe->id_produksi = $do['id_produksi'];
            $oe->tgl_oee = $do['tgl_oee'];
            $oe->label_oee = mediumdate_indo($do['tgl_oee']);
            $oe->availability = $a;
            $oe->performance = $p;
            $oe->quality = $q;
            $oe->hasil_oee = $o;
            array_push($p_oee, $oe);
        }

        return $p_oee;
    }

    public function get_perhitungan_oee()
    {
        // ALL OEE
        $oee = $this->getOee();
        $p_oee = [];
        foreach ($oee as $do) {
            $a = round((($do['jam_kerja'] - ($do['breakdown'] + $do['setup']) / $do['jam_kerja']) * 0.1), 1.0);
            $p = round((($do['jam_kerja'] / ($do['run_time']) / $do['ideal_runtime']) * 100), 1.0);
            $q = round((($do['total_count'] - $do['bad_count']) / $do['ideal_runtime'] * 100), 1.0);
            $o = round(($a * $p * $q * 0.1), 0) / 100;

            $oe = new stdClass();
            $oe->id_oee = $do['id_oee'];
            $oe->availability = $a;
            $oe->performance = $p;
            $oe->quality = $q;
            $oe->hasil_oee = $o;
            array_push($p_oee, $oe);
        }

        return $p_oee;
    }
}
