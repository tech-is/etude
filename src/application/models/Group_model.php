<?php
//データベース接続
class Group_model extends CI_Model{
    //データベース接続
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    //登録情報取得
    public function get_record()
    {
        //取得部分詳細設定で最新登録情報取得
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query=$this->db->get('booking');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return[];
        }
    }
    //希望チェック画面にて、希望日と同じ予約日を紐づけて連想配列で取得してくる
    public function get_booking_date($booking_date){
        $this->db->where('booking_date',$booking_date);
        $this->db->select('booking_date,start_time,end_time,people_num');
        return $this->db->get('booking')->result_array();
    }
    //受付入力情報のDB書き込み,ID取得
    public function insert_b($data1){
        //代表者情報のデータベース登録・booking_idの取得
        $this->db->insert('booking',$data1);
        $booking_id=$this->db->insert_id();
        $_SESSION["booking_id"]=$booking_id;
        //代表者を含む参加者全員の名前を確認画面から取得
        var_dump($_SESSION['full_name']);
        foreach($_SESSION['full_name'] as $key => $name) {
            if(!empty($name)) {   
                $data[] = [
                    'booking_id' => $booking_id,
                    'number' => $key,
                    'name' => $name
                ];
            }
        }
        //連想配列のinsert処理
        return $this->db->insert_batch('visitor',$data);
    }
    //検温結果のDB登録
    public function update_temperature($data,$booking_id,$number){
        $this->db->where('booking_id',$booking_id);
        $this->db->where('number',$number);
        $this->db->update('visitor',$data);
    }
    //
    public function last($booking_id){
        // $this->db->order_by('id','DESC');
        //bookingテーブルのbooking_idで紐づけられたvisitorテーブルの参加者から、参加者の人数をnumberカラムの最後の値で取得する
        $this->db->where('booking_id',$booking_id);
        $this->db->order_by('number','DESC');
        $this->db->limit(1);
        $this->db->select('number');
        return $this->db->get('visitor')->row_array();
    }
}    
?>