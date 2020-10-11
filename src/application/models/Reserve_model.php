<?php

Class Reserve_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //トークンがテーブルにあるかどうか確認する。
    public function temp_mail_approval($token)
    {
        return $this->db->where('token', $token)
                        ->select('pre_regist_email')
                        ->get('pre_regist')
                        ->row_array();
    }

    //引数で指定したメールアドレスのレコードを取得する
    public function booking_mail_approval($mail)
    {
        return $this->db->where('booker_email', $mail)
                        ->get('booking')
                        ->row_array();
    }

    //仮登録アドレスの期限チェック用のtoken_timeを取得
    public function token_approval($mail)
    {
        return $this->db->where('pre_regist_email', $mail)
                ->select('token_time')
                ->get('pre_regist')
                ->row_array();
    }

    //仮登録メールの削除
    public function remove_temp_email($email)
    {
        //$emailで指定したレコードの削除
        return $this->db->where('pre_regist_email',$email)
                           ->delete('pre_regist');
    }

    //メールの仮登録を行う
    public function regist_mail($data)
    {
        //('テーブル名',書き込むデータ(連想配列keyをカラム名とする))
        // $this->db->get('mytable');
        return $this->db->insert('pre_regist', $data);
    }

    //予約本登録内容をテーブルに書き込むようにする。
    public function regist_reserve_info($booking_data)
    {
        //予約登録情報の入力
        return $this->db->insert('booking', $booking_data);
    }
    //予約本登録内容のvisitor(参加者情報)をテーブルに書き込むようにする。
    public function regist_visitor_info($visitor_data)
    {
        //予約登録情報(visitor)の入力
        // return $this->db->insert('visitor', $visitor_data);
        return $this->db->insert_batch('visitor', $visitor_data);
    }

    //指定されたemailのidを取得してくる。
    public function get_id_by_email($email)
    {
        return $this->db->where('booker_email', $email)
                        ->select('id')
                        ->get('booking')
                        ->row_array();
    }

    //トークン情報と一致するカラムを取得する。
    public function get_info_by_token($token)
    {
        return $this->db->where('token',$token)
                        ->get('booking')
                        ->row_array();
    }

    //指定のbooking_idを持つvisitor情報を取得する。
    public function get_visitor_by_booking_id($booking_id)
    {
        return $this->db->where('booking_id',$booking_id)
                        ->select('name,number')
                        ->get('visitor')
                        ->result_array();
    }

    //引数のトークンに対応するレコードをbookingテーブルから削除する。
    public function delete_record_by_token($token)
    {
        return $this->db->where('token',$token)
                        ->delete('booking');
    }

    //引数のアドレスに対応するレコードを仮登録テーブルから削除する。
    public function delete_record_by_email($email)
    {
        return $this->db->where('pre_regist_email',$email)
                        ->delete('pre_regist');
    }

    //引数のidに対応するvisitor情報を全て削除する。
    public function delete_visitor_by_id($id)
    {
        return $this->db->where('booking_id',$id)
                        ->delete('visitor');
    }

    //引数の予約日と同じ予約日のレコードを全て取得する。
    public function get_allrecord_same_booking_date($booking_date)
    {
        return $this->db->where('booking_date',$booking_date)
                        ->get('booking')
                        ->result_array();
    }







//////////////////////////////////////////////////////////////////////////

    //データベースから情報全て取得する
    public function get_all_board_data()
    {
        //日付順早い順で取得
        return $this->db->order_by('post_date','DESC')
            ->get('message')
            //複数の配列をわたすのでrow_array()は使えない。
            ->result_array();

    }
    //データベースから指定された数のレコードを取得する
    public function get_limit_board_data($limit)
    {
        //日付順早い順で取得
        return $this->db->limit($limit)
                ->order_by('post_date','DESC')
                ->get('message')
                //複数の配列をわたすのでrow_array()は使えない。
               ->result_array();

    }
    //データベースから引数$idで指定されたidの情報を取得する。
    public function get_id_board_data($id)
    {
        return $this->db->where('id', $id)
            ->select('id, view_name, message')
            ->get('message')
            ->row_array();
    }

    //掲示板の書き込み機能部（messageテーブルに書き込む)
    public function bbs_writing($data)
    {
        //('テーブル名',書き込むデータ)
        return $this->db->insert('message', $data);
    }

    //管理人による掲示板編集機能部
    public function bbs_edit($id,$data)
    {
        //$idで指定した書き込みidの更新
        return $this->db->where('id',$id)
                        ->update('message',$data);
    }
}
?>