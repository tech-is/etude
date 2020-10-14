<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Bookingテーブルから全ての予約・受付情報を呼び出す
    public function get_all_record($limit=null)
    {
        // !empty($limit)? $this->db->limit($limit): false;
        return $this->db->order_by('booking_date', 'DESC')
            ->get('booking')
            ->result_array();
    }

    //Bookingテーブルから特定の予約・受付情報を呼び出す
    public function get_record($id)
    {
        return $this->db->where('id', $id)
            ->select('id,token,booker,booker_yomi,booker_tel,booker_email,booking_date,start_time,end_time,people_num,booking_status')
            ->get('booking')
            ->row_array();
    }

    //特定の予約のvisitor(参加者情報)を取得
    public function get_visitor_record($booking_id)
    {
        return $this->db->where('booking_id', $booking_id)
            ->select('id,booking_id,number,name,temperature')
            ->get('visitor')
            ->result_array();
    }

    //人数の変更をテーブルに書き込む。
    public function modify_people_num($id,$new_people_num)
    {
        //予約登録情報の入力
        return $this->db->where('id', $id)
        ->update('booking', $new_people_num);
    }

    //visitor_name(参加者名)の変更をテーブルに書き込む。
    public function modify_visitor($booking_id,$number,$visitor)
    {
        //booking_idとnumberが同じ行を呼び出す
        $visitor_data = array('booking_id' => intval($booking_id), 'number' => $number);
        //参加者名(visitor_name)の更新
        return $this->db->where($visitor_data)
        ->update('visitor',$visitor);
    }

    public function delete_visitor_data($booking_id,$number)
    {
        //booking_idとnumberが同じ行を呼び出す
        $visitor_data = array('booking_id' => intval($booking_id), 'number' => $number);
         //参加者情報(visitor_data)の削除
        return $this->db->where($visitor_data)
            ->delete('visitor');
    }

}
