<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct();
	$this->load->library('session');
	$this->load->model('group_model');
	$this->load->helper('url');
	}
	//受付画面表示
	public function index()
	{
		$this->load->view('header');
		$this->load->view('top');
		$this->load->view('footer');
	}
	//1.当日受付選択後
	public function dos_login()
	{
		if(isset($_POST['btn_dos']))
		{
			//利用規約等同意確認画面
			$this->load->view('header');
			$this->load->view('dos_reception/privacy_protection');
			$this->load->view('footer');
        }
	}
	//2.
	public function assent()
	{
		if(isset($_POST['no']))
		{
			//TOP画面に戻る
			header('location: /Group/index');
			exit;
		}
		if(isset($_POST['yes']))
		{
			//同意後、おねがい画面
			$this->load->view('header');
			$this->load->view('dos_reception/note');
			$this->load->view('footer');
		}
	}
	//3.
	public function request()
	{
		if(isset($_POST['no']))
		{
			//TOP画面に戻る
			header('location: /Group/index');
			exit;
		}
		if(isset($_POST['yes']))
		{
			//承諾後、希望日時入力画面
			$this->load->view('header');
			$this->load->view('dos_reception/detail_input');
			$this->load->view('footer');
		}
	}
	//4.希望チェック
	public function hope()
	{
		if(isset($_POST['cancel']))
		{
			//TOP画面に戻る
			header('location: /Group/index');
			exit;
		}
		if(isset($_POST['check']))
		{
			//一時間当たりの最大収容可能人数。10名で設定中。
			$limit_num_per_hour=10;

			//入力された希望情報を取得
			$data=@$this->input->post(array('booking_date','start_time','end_time','people_num'))?: null;
			$_SESSION=array_merge($_SESSION,$data);
			// var_dump($_SESSION);
			// exit;

			//strposでstart_timeの“時”が出てくる所を探索して,intvalでstart_timeとend_timeで取得した文字列の値を整数型（int）にする
			$index_start=strpos($data['start_time'],":");
			$input_start=intval(substr($data['start_time'],0,$index_start));
			$index_end=strpos($data['end_time'],":");
			$input_end=intval(substr($data['end_time'],0,$index_end));
			// var_dump($input_start);
			// var_dump($input_end);
			// exit;

			//データベースより、予約日が同じ日の情報を横列全て取得してくる
			$exsiting_data=$this->group_model->get_booking_date($data['booking_date']);
			// var_dump($exsiting_data);
			// var_dump($exsiting_data[1]['start_time']);
			//1時間当たりの予約可能人数を表す
			$bookable_array=array_fill(1,24,$limit_num_per_hour);
			// print_r($bookable_array);
			foreach($exsiting_data as $e_data){
				$s_time=intval(substr($e_data['start_time'],0,2));
				$e_time=intval(substr($e_data['end_time'],0,2));
				// var_dump($s_time);
				// var_dump($e_time);
				// exit;
				
				for($i=$s_time; $i<$e_time; $i++){
					$bookable_array[$i+1] -= $e_data['people_num'];
				}
			}
			//今回入力された値(int型にする）が受付可能かを判定
			for($i=$input_start; $i<$input_end; $i++){
				$bookable_array[$i+1] -= intval($data['people_num']);
			}
			//一つでも残り予約可能人数配列が負になっていれば予約不可能判定
			$unacceptable_flg=FALSE;
			foreach($bookable_array as $num){
				if($num<0){
					$unacceptable_flg=true;
				}
			}
			// var_dump($bookable_array);
			// var_dump($unacceptable_flg);
			// exit;
			//予約不可であればメッセージを表示させ、予約可能であれば次の画面へ遷移する
			if($unacceptable_flg===true){
				$_SESSION['book_unacceptable']="空がありません。時間帯と人数を変更してください。";
				$this->load->view('header');
				$this->load->view('dos_reception/detail_input',$_SESSION['book_unacceptable']);
				$this->load->view('footer');
			}else{
				unset($_SESSION['book_unacceptable']);
				$_SESSION['book_unacceptable']='';
				//チェックボタン後、受付内容入力画面
				$this->load->helper(array('form','url'));
				$this->load->library('form_validation');
				$this->load->view('header');
				$this->load->view('dos_reception/name_input');
				$this->load->view('footer');
			}
		}
	}
	//5.
	public function check()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');

        if(isset($_POST['no']))
		{
			//戻るで、希望日時入力画面
			$this->load->view('header');
			$this->load->view('dos_reception/detail_input');
			$this->load->view('footer');
			return;
		}
			//エラーメッセージの設定
			$this->form_validation->set_rules('enter_name','フリガナ','required');
			$this->form_validation->set_rules('full_name_1','代表者氏名','required');
			$this->form_validation->set_rules('tel','代表者電話番号','required');
			$this->form_validation->set_message('required','【Error】%sを入力してください');

			if($this->form_validation->run() == FALSE)
			{
				//未入力の時、入力画面再表示
				$this->load->helper(array('form','url'));
				$this->load->library('form_validation');
				$this->load->view('header');
				$this->load->view('dos_reception/name_input');
				$this->load->view('footer');
			}else{
				//確認画面に入力データを表示だけさせる
				$_SESSION["enter_name"]=$this->input->post('enter_name',true)?:null;
				$_SESSION["full_name_1"]=$this->input->post('full_name_1',true)?:null;
				$_SESSION["tel"]=$this->input->post('tel',true)?:null;
				for($i=1; $i<=5; $i++)
				{
					if(!empty($this->input->post('full_name_'.$i,true)))
					{
						$_SESSION["full_name"][$i] = $this->input->post('full_name_'.$i,true);
					}
				}
				$this->load->view('header');
				$this->load->view('dos_reception/confirmation');
				$this->load->view('footer');
			}
	}
	//6.
	public function input()
	{
		//フォームを表示させる
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		if(isset($_POST['no']))
		{
			//全てのSESSIONデータを連想配列で取得
			$data=$this->session->all_userdata();
			//入力値を引き継いで、入力画面に戻る
			$this->load->view('header');
			$this->load->view('dos_reception/name_input',$data);
			$this->load->view('footer');
		}
		if(isset($_POST['yes']))
		{
			//sessionデータの取得
			$enter_name=$this->session->userdata('enter_name');
			$full_name_1=$this->session->userdata('full_name_1');
			$tel=$this->session->userdata('tel');
				$data1=[
					'booker'=> $full_name_1,
					'booker_yomi'=> $enter_name,
					'booker_tel'=>$tel,
					'booking_date'=>$_SESSION['booking_date'],
					'start_time'=>$_SESSION['start_time'],
					'end_time'=>$_SESSION['end_time'],
					'people_num'=>$_SESSION['people_num'],
				];
			//モデルでDB登録、returnによりbooking_idで紐づけられたvisitorの全情報を取得
			if (!$this->group_model->insert_b($data1)) {
				//行先を決める　　　　※
				header("");
				exit;
			}
			//検温画面へ進む為、temperature_measurement()へ飛ぶ
			$_SESSION['num']=0;
			//現在の検温者が最終検温者であるフラグ
			$_SESSION['last_number_flag']=false;

			header("Location: temperature_measurement?visitor_num=1");
			exit;
		}
	}
	// 7.
	//検温結果を入力する画面//
	public function temperature_measurement()
	{
		//一人目表示
		// $data['visitor_num']=$this->input->get('visitor_num');
		$_SESSION['num']+=1;
		//何人目の処理かを判定させる為に参加者人数が必要。numberの最後の数を人数の最大値として使用。
		$last_number=$this->group_model->last($_SESSION['booking_id']);
		//last_number_flagは、$last_numberと$_SESSION['num']の値が等しい時を意味し、within_range画面の判断材料とする
		if($_SESSION['num']==$last_number['number']){
			$_SESSION['last_number_flag']=true;
		}
		//$_SESSION['num']が$last_numberよりも大きい値なら画面表示へ進まない
		if($last_number>$_SESSION['num']){
			$data['visitor_num']=$_SESSION['num'];
			$this->load->view('header');
			$this->load->view('dos_reception/temperature_measurement', $data);
			$this->load->view('footer');
		}
	}
	// 8.
	public function measurement()
	{
		//検温「登録」押させたら
		if(isset($_POST['register']))
		{
			//検温入力取得
			$_SESSION['temperature']=$this->input->post('temperature');
			$visitor_num=$this->input->post('visitor_num');
			$data=[
				'temperature'=> floatval($_SESSION['temperature'])
			];
			$booking_id=$_SESSION['booking_id'];
			$number=intval($visitor_num);
			$this->group_model->update_temperature($data,$booking_id,$number);
			
			//結果を案内画面へ（結果によって分岐処理）
			$temperature['value']=$_SESSION['temperature'];
			$this->load->view('header');
			$this->load->view('dos_reception/judgment',$temperature);
			$this->load->view('footer');
		}
	}
	// 9.
	public function measurement_finish()
	{
	$this->load->view('header');
	$this->load->view('dos_reception/measurement_complete');
	$this->load->view('footer');
	}
	// 10.
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
?>