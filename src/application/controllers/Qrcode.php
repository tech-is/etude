<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode extends CI_Controller {

	public function __construct()
	{
		// CI_Model constructor の呼び出し
		parent::__construct();
	}

	public function index()
	{
		//postは想定していない
		if($_SERVER["REQUEST_METHOD"] === "POST"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		//リンクのトークンを取得
		$token = @$this->input->get('token') ?: null;

		//リンクのトークン情報に一致する情報をデータテーブルから情報
		$data = $this->Reserve_model->get_info_by_token($token);

		// var_dump($data['id']);

		//booking_idに一致するvisitor情報を取得してくる。
		$visitor_data = $this->Reserve_model->get_visitor_by_booking_id($data['id']);

		// var_dump($visitor_data);
		
		$data["visitor"] = $visitor_data;

		// //予約時間表示のための成形
		// $data['detail_visit_info'] = $data['booking_date'].'  '.$data['start_time'].':00 ~'.$data['end_time'].':00';
		// print_r($visitor_data);

		// exit;
		//qrコード表示するときに使うトークンを持たせる。
		// $data=[
		// 	'token' => $token,
		// ];

		
		$this->load->view('header');
		$this->load->view('qr_view',$data);
	}
	
}
?>