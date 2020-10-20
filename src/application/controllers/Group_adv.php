<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_adv extends CI_Controller
{
	public function __construct()
	{
	parent::__construct();
	$this->load->library('session');
	$this->load->model('Booking_model');
	$this->load->model('group_model');
	$this->load->helper('url');
	}

	//受付画面表示
	public function index()
	{
		//SESSIONデータ削除
		$_SESSION = array();
		//画面表示
		$this->load->view('header');
		$this->load->view('top');
		$this->load->view('footer');
	}

	//1.予約受付選択後
	public function adv_login()
	{
		// if(isset($_POST['btn_dos']))
		// {
			//利用規約等同意確認画面
			$this->load->view('header');
			$this->load->view('adv_reception/privacy_protection_re');
			$this->load->view('footer');
        // }
	}

	//2.利用規約同意後
	public function assent()
	{
		if(isset($_POST['no']))
		{
			//TOP画面に戻る
			header('location: /');
			exit;
		}
		if(isset($_POST['yes']))
		{
			//同意後、おねがい画面
			$this->load->view('header');
			$this->load->view('adv_reception/note_re');
			$this->load->view('footer');
		}
	}

	//3.お願い画面表示後
	public function request()
	{
		if(isset($_POST['no']))
		{
			//TOP画面に戻る
			header('location: /');
			exit;
		}
		if(isset($_POST['yes']))
		{
			//承諾後、QRコード読み込み画面
			$this->load->view('header');
			$this->load->view('adv_reception/qr');
			$this->load->view('footer');
		}
	}

	//4.取込QRの有効性確認→確認画面
	public function validity_check()
	{
		$token = @$this->input->post('token')?: null;
		$data = null;
		$array = $this->Booking_model->get_id($token);
		// var_dump($array);
		// exit;
		if (isset($array)) {
		foreach ($array as $key => $id) {
		}
		$booking_id = $id?: null;
		$_SESSION['id'] = $id?: null;
		$_SESSION['num'] = 0;
		$_SESSION['last_number_flag'] = false;
		//予約情報・参加者情報の取得
		$data = null;
		$data['booking_data'] = $this->Booking_model->get_record($id);
		$data['visitor_data'] = $this->Booking_model->get_visitor_record($booking_id);
		//現在時刻
		$now = strtotime(date( "H:i:s"));
		//受付可能時間（start）予約開始時刻の５分前
		$range_start = strtotime($data['booking_data']['start_time'] . "-5 minute");
		//受付可能時間（end）予約開始時刻の５分後
		$range_end = strtotime($data['booking_data']['start_time'] . "+5 minute");

		// if(!empty($id) && is_numeric($id)) {
			//予約日かどうか
			if($data['booking_data']['booking_date'] == date("Y-m-d")){
				//受付可能時間（start）より後の時間かどうか
				if($now > $range_start){
					//受付可能時間（end）より前の時間かどうか
					if($now < $range_end){
						//必要な情報が入っているかどうか
						if (!empty($data['booking_data'])) {
							//csrfチェック
							$data['csrf_token_name'] = $this->security->get_csrf_token_name();
							$data['csrf_token_hash'] = $this->security->get_csrf_hash();
							$this->load->view('header');
							$this->load->view('adv_reception/confirmation_re',$data);
							$this->load->view('footer');
						}else {
									$_SESSION['error_message_1'] = '受付に必要な情報が登録されていません。';
									$_SESSION['error_message_2'] = '当日受付または事前予約より空き状況をご確認のうえ、再度お申込みください。';
									//csrfチェック
									$data['csrf_token_name'] = $this->security->get_csrf_token_name();
									$data['csrf_token_hash'] = $this->security->get_csrf_hash();
									$this->load->view('header');
									$this->load->view('adv_reception/over_the_time_limit',$data);
									$this->load->view('footer');
						}
					}else {
						$_SESSION['error_message_1'] = '受付可能な時間を過ぎています。';
						$_SESSION['error_message_2'] = '当日受付または事前予約より空き状況をご確認のうえ、再度お申込みください。';
						//csrfチェック
						$data['csrf_token_name'] = $this->security->get_csrf_token_name();
						$data['csrf_token_hash'] = $this->security->get_csrf_hash();
						$this->load->view('header');
						$this->load->view('adv_reception/over_the_time_limit',$data);
						$this->load->view('footer');
					}
				}else {
					$_SESSION['error_message_1'] = '受付時間は予約時間の５分前からです。';
					$_SESSION['error_message_2'] = '時間をご確認のうえ、再度受付を行ってください。';
					//csrfチェック
					$data['csrf_token_name'] = $this->security->get_csrf_token_name();
					$data['csrf_token_hash'] = $this->security->get_csrf_hash();
					$this->load->view('header');
					$this->load->view('adv_reception/over_the_time_limit',$data);
					$this->load->view('footer');
				}
			}else {
				$_SESSION['error_message_1'] = '本日の予約ではありません。';
				$_SESSION['error_message_2'] = '当日受付または事前予約より空き状況をご確認のうえ、再度お申込みください。';
				//csrfチェック
				$data['csrf_token_name'] = $this->security->get_csrf_token_name();
				$data['csrf_token_hash'] = $this->security->get_csrf_hash();
				$this->load->view('header');
				$this->load->view('adv_reception/over_the_time_limit',$data);
				$this->load->view('footer');
			}
		}else {
			$_SESSION['error_message_1'] = '有効なQRコードではありません。';
			$_SESSION['error_message_2'] = '当日受付または事前予約より空き状況をご確認のうえ、再度お申込みください。';
			//csrfチェック
			$data['csrf_token_name'] = $this->security->get_csrf_token_name();
			$data['csrf_token_hash'] = $this->security->get_csrf_hash();
			$this->load->view('header');
			$this->load->view('adv_reception/invalid_qr',$data);
			$this->load->view('footer');
		}
	}

	//5.予約内容確認（変更画面で戻るボタンを押した時必要）
	public function confirmation()
	{
		$id = $_SESSION['id'];
		$booking_id = $_SESSION['id'];
		//予約情報・参加者情報の取得
		$data = null;
		$data['booking_data'] = $this->Booking_model->get_record($id);
		$data['visitor_data'] = $this->Booking_model->get_visitor_record($booking_id);
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();
		$this->load->view('header');
		$this->load->view('adv_reception/confirmation_re',$data);
		$this->load->view('footer');
	}

	//6.予約内容変更
	public function change()
	{
		$id = $_SESSION['id']?: null;
		$booking_id = $_SESSION['id']?: null;
		//予約情報・参加者情報の取得
		$data = null;
		$data['booking_data'] = $this->Booking_model->get_record($id);
		$data['visitor_data'] = $this->Booking_model->get_visitor_record($booking_id);
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();
		$this->load->view('header');
		$this->load->view('adv_reception/change',$data);
		$this->load->view('footer');
	}

// 7.変更内容確認
	public function change_confirmation()
	{
		for($value = 1; $value<=5;$value++){
				unset($_SESSION['check_flag'][$value]);
				unset($_SESSION["name{$value}"]);
		}
		$id = $_SESSION['id']?: null;
		$booking_id = $_SESSION['id']?: null;
		$check_flag = @$this->input->post('check_flag')?: null;
		$people_num = @$this->input->post('people_num')?: null;
		for($value=1;$value<5;$value++){
		$name[$value]= @$this->input->post("name{$value}")?: null;
		$_SESSION["name{$value}"] = $name[$value];
		}
		$count = 1;
		if(!empty($check_flag)) {
			foreach ($check_flag as $value){
							$_SESSION['check_flag'][$value] = 1;
							$count = $count + 1;
							}
							$_SESSION['people_num'] = $count;
			}else{
						$_SESSION['people_num'] = $count;
			}
		$data = null;
		$data['booking_data'] = $this->Booking_model->get_record($id);
		$data['visitor_data'] = $this->Booking_model->get_visitor_record($booking_id);
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();
		$this->load->view('header');
		$this->load->view('adv_reception/change_confirmation',$data);
		$this->load->view('footer');
	}

//8.変更内容の登録と検温画面の表示
	public function modify_data_temperature_measurement()
	{
			$id = $_SESSION['id']?: null;
			$booking_id = $_SESSION['id']?: null;
			$people_num = @$this->input->post('people_num', true);
			if($people_num != $_SESSION['people_num']){
				$people_num = $_SESSION['people_num'];
				$new_people_num=[
				'people_num' => $people_num,
				];
				//人数の変更の登録
				$this->Booking_model->modify_people_num($id,$new_people_num);
			}
			if($people_num!=1){
					// var_dump($_SESSION);
					$cut = 0 ;
				for ($value=1; $value <= $people_num; $value++){
					if(((isset($_SESSION['check_flag'][$value+1])) && $_SESSION['check_flag'][$value+1] == true)){
						$number = $value + 1;
						$new_number = $value - $cut + 1;
						$visitor=[
							// $visitor_name[$value]=[
						'name'=> $_SESSION["name{$value}"],
						'number'=> $new_number,
							];
						// 参加者名の変更の登録
						$this->Booking_model->modify_visitor($booking_id,$number,$visitor);
					}
					else{
						$number = $value + 1;
						$cut = $cut + 1;
						//参加者情報の削除
							$this->Booking_model->delete_visitor_data($booking_id,$number);
					}
				}
			}
			$data['booking_data'] = $this->Booking_model->get_record($id);
			$data['visitor_data'] = $this->Booking_model->get_visitor_record($booking_id);
			//csrfチェック
			$data['csrf_token_name'] = $this->security->get_csrf_token_name();
			$data['csrf_token_hash'] = $this->security->get_csrf_hash();
			//何人目の処理かを判定させる為に参加者人数が必要。numberの最後の数を人数の最大値として使用。
			$last_number=$this->group_model->last($_SESSION['id']);

			//検温画面へ
			$this->load->view('header');
			$this->load->view('adv_reception/temperature_measurement_re',$data);
			$this->load->view('footer');
	}

	// 9.検温結果を入力する画面//
	public function temperature_measurement()
	{
		$id = $_SESSION['id'];
		$booking_id = $_SESSION['id'];
		//受付情報の取得
		$data['booking_data'] = $this->Booking_model->get_record($id);
		$data['visitor_data'] = $this->Booking_model->get_visitor_record($booking_id);
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();
		//何人目の処理かを判定させる為に参加者人数が必要。numberの最後の数を人数の最大値として使用。
		$last_number=$this->group_model->last($_SESSION['id']);
		//last_number_flagは、$last_numberと$_SESSION['num']の値が等しい時を意味し、within_range画面の判断材料とする
		if($_SESSION['num']==$last_number['number']-1){
			$_SESSION['last_number_flag']=true;
		}
		//$_SESSION['num']が$last_numberよりも大きい値なら画面表示へ進まない
		if($last_number>$_SESSION['num']){
			$data['visitor_num']=$_SESSION['num'];

			$this->load->view('header');
			$this->load->view('adv_reception/temperature_measurement_re', $data);
			$this->load->view('footer');
		}
	}

	// 10.検温結果を登録、判定後次の画面へ//
	public function measurement()
	{
		//検温「登録」押させたら
		if(isset($_POST['register']))
		{
			//検温入力取得
			$_SESSION['temperature']=$this->input->post('temperature');
			$visitor_num=$_SESSION['num'];
			$data=[
				'temperature'=> floatval($_SESSION['temperature'])
			];
			$booking_id=$_SESSION['id'];
			$number=intval($visitor_num);
			$this->group_model->update_temperature($data,$booking_id,$number);

			//結果を案内画面へ（結果によって分岐処理）
			$temperature['value']=$_SESSION['temperature'];
			$this->load->view('header');
			$this->load->view('adv_reception/judgment_re',$temperature);
			$this->load->view('footer');
		}
	}

	// 11.入館案内画面表示//
	public function measurement_finish()
	{
	$this->load->view('header');
	$this->load->view('adv_reception/measurement_complete_re');
	$this->load->view('footer');
	}
	// 12.TOP画面へ戻る//
	public function finish()
	{
		if(isset($_POST['finish']))
		{
			//SESSIONデータ削除
			$this->session->sess_destroy();
			//TOP画面に戻す
			header("Location: index");
			exit;
		}
	}
}
