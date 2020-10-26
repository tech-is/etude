<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {

	public function __construct()
	{
		// CI_Model constructor の呼び出し
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('phpmailer');
		$this->load->model('Reserve_model');
	}

	//仮メールのurlの行先がここ
	public function index()
	{
		//postは想定していない
		if($_SERVER["REQUEST_METHOD"] === "POST"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		//リンクのトークンを取得
		$token = @$this->input->get('token') ?: null;

		//トークンが存在しないとき(悪意あるアクセス)
		if($token===null){
			//不正なURLエラー画面
			header('Location: http://etude.com/Reservation/view_error_message?errortype=1');
			exit;
		}

		//トークンが一致するアドレスを取得する。
		$mail = $this->Reserve_model->temp_mail_approval($token);

		//トークンが一致するものがなかった時の処理(悪意あるアクセス)
		if($mail===null){
			//不正なURLエラー画面
			header('Location: http://etude.com/Reservation/view_error_message?errortype=1');
			exit;
		}

		
		//トークンの期限確認のため(配列でしか返ってこないので一時的に受ける)
		$temp_data = $this->Reserve_model->token_approval($mail['pre_regist_email']);
		//値が取得できなかった場合(通常起こりえないエラー)
		if($temp_data===null){
			//緊急なURLエラー画面
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		$token_time = intval($temp_data['token_time']);
		$now = time();
		
		//1800秒つまり30分を超えていたら期限が切れているページを表示する。
		if(($now-$token_time)>1800){

			//仮登録情報も消す
			$sql_flg = $this->Reserve_model->remove_temp_email($mail['pre_regist_email']);

			//削除に失敗したとき
			if($sql_flg===false){
				//緊急なURLエラー画面
				header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
				exit;
			}

			//トークン期限切れエラー
			header('Location: http://etude.com/Reservation/view_error_message?errortype=2');
			exit;
		}
		
		// //urlリンクからタブを2つ開かれるとセッションが被ってしまうのでそれが起こらない処理間に合えば
		// $token= password_hash(time(),PASSWORD_DEFAULT);
		// $_SESSION[$token]['ffff']] = 4;

		//セッションで入力値は保持していく。
		$_SESSION['booker_email'] = $mail['pre_regist_email'];

		//ここで一応予約可否削除しておかないと予約失敗判定時に
		//ブラウザバック戻るボタンをされたときに表示が残る。
		unset($_SESSION['book_unacceptable']);

		//詳細入力画面
		$this->view_detail_input_reserve();
	}
	//最初のページはここで表示する。
	//メール入力画面表示  
	public function input_mail()
	{
		//postは想定していない
		if($_SERVER["REQUEST_METHOD"] === "POST"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();
		//セッションの仕分け？
		// $_SESSION[$token]=array();
		$this->load->view('header');
		$this->load->view('reservation/mail_input',$data);
	}

	//エラーメッセージ画面を表示
	public function view_error_message()
	{
		//postは想定していない(ここはなんか不要な気もする)
		if($_SERVER["REQUEST_METHOD"] === "POST"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		$error_type = @$this->input->get('errortype') ?: null;

		switch ($error_type){
			case null:
			case 1:
			  $error_message['mes'] = '不正なurlです。';
			  break;
			case 2:
			  $error_message['mes'] = 'トークンの期限切れです。';
			  break;
			case 3:
			  $error_message['mes'] = 'メールの送信に失敗しました。';
			  break;
			case 4:
			  $error_message['mes'] = 'このメールの予約情報が既に存在します。';
			  break;
			case 5:
			  //get postが想定外だった場合の処理
			  $error_message['mes'] = '不正なアクセスです。';
			  break;
			case 99:
			  //通常起こることが考えられないエラー
			  $error_message['mes'] = '緊急エラー';
			  break;

			default:
			break;
			}

		$this->load->view('header');
		$this->load->view('reservation/error_message',$error_message);
	}


	//予約詳細入力画面表示
	public function view_detail_input_reserve()
	{

		//csrfチェックたぶんデータベースに行くとこ以外不要
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();

		$this->load->view('header');
		$this->load->view('reservation/detail_input',$data);
	}

	//名前入力画面の表示
	public function view_name_input_reserve()
	{
		//postは想定していない
		if($_SERVER["REQUEST_METHOD"] === "POST"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		$_SESSION['sample_name']=[
			'松山次郎',
			'松山三郎',
			'松山四郎',
			'松山五郎',
		];

		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();

		$this->load->view('header');
		$this->load->view('reservation/name_input',$data);
	}
	
	//確認画面表示とデータ成形
	public function view_confirmation_reserve()
	{
		//getは想定していない
		if($_SERVER["REQUEST_METHOD"] === "GET"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		//参加者情報をpostから受け取る
		$book_data    = @$this->input->post(array('booker_name','booker_yomi','booker_tel','visitor1','visitor2','visitor3','visitor4'))?: null;
		
		//確認画面にメールアドレスを表示するために復号化する。
		// $book_data['booker_email'] = $book_data['email'];
		$_SESSION['booker_name'] = $book_data['booker_name'];
		$_SESSION['booker_yomi'] = $book_data['booker_yomi'];
		$_SESSION['booker_tel'] = $book_data['booker_tel'];
		
		//画面表示用に予約日時用の文字列を作成する。
		$_SESSION['detail_visit_info'] = $_SESSION['booking_date'].'  '.$_SESSION['start_time'].':00 ~'.$_SESSION['end_time'].':00';
		
		//参加者を連想配列の2次元配列にする（取り方だるそうなのでとりあえず直打ち表示をループで回すため）
		$_SESSION['visitor'][1] = $book_data['visitor1'];
		$_SESSION['visitor'][2] = $book_data['visitor2'];
		$_SESSION['visitor'][3] = $book_data['visitor3'];
		$_SESSION['visitor'][4] = $book_data['visitor4'];
		
		//postで受け取ってgetで表示する処理
		header('Location: http://etude.com/Reservation/view_confirmation_re');
		exit;
	}
	public function view_confirmation_re()
	{
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();

		$this->load->view('header');
		$this->load->view('reservation/confirmation_re',$data);
	}

	//完了情報を表示する（ＱＲと予約情報確認メール送るのもここ）
	public function view_complete()
	{
		//getは想定していない
		if($_SERVER["REQUEST_METHOD"] === "GET"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		//予約登録情報とQRコードを表示するためのtokenを発行
		$encrypted_data= password_hash(time(),PASSWORD_DEFAULT);

		//予約登録内容情報の形成
		$booking_data=[
			'token'            => $encrypted_data,
			'booker'           => $_SESSION['booker_name'],
			'booker_yomi'      => $_SESSION['booker_yomi'],
			'booker_tel'       => $_SESSION['booker_tel'],
			'booker_email'     => $_SESSION['booker_email'],
			'booking_date'     => $_SESSION['booking_date'],
			'start_time'       => $_SESSION['start_time'],
			'end_time'         => $_SESSION['end_time'],
			'booking_status'   => 0,
			'people_num'       => $_SESSION['people_num'],
		];

		//画面表示用に予約日時用の文字列を作成する。
		$booking_data['detail_date_info'] = $booking_data['booking_date'].'  '.$booking_data['start_time'].':00 ~'.$booking_data['end_time'].':00';
		
		//予約登録内容の登録
		$sql_flg = $this->Reserve_model->regist_reserve_info($booking_data);

		//予約内容の登録に失敗したとき
		if($sql_flg === false){
			//緊急のエラー
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}
		
		//visitor情報に本登録のidを紐づけるためにidをemailアドレスから取得する。
		$id = $this->Reserve_model->get_id_by_email($_SESSION['booker_email']);

		//取得に失敗値た時（想定できない）
		if($sql_flg === false){
			//緊急のエラー
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}
		
		//予約者自身のデータ成形
		$visitor_data[1]=[
			'booking_id' => $id['id'],
			'number' => 1,
			'name'=> $_SESSION['booker_name'],
		];

		//ループ用index
		$i=2;
		foreach($_SESSION['visitor'] as $visitor_name){
			if($visitor_name===null)break;
			$visitor_data[$i]=[
				'booking_id' => $id['id'],
				'number' => $i,
				'name'=> $visitor_name,
			];
			$i++;
		}
		
		//参加者情報成形
		$sql_flg = $this->Reserve_model->regist_visitor_info($visitor_data);

		//登録に失敗値た時（想定できない）
		if($sql_flg === false){
			//緊急のエラー
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}
		
		//メール用データ成型
		$mail_data=[
			'email' => $booking_data['booker_email'],
			'token' => $booking_data['token'],
		];
		
		//ＱＲコードと予約情報を確認できるリンクを送る。
		phpmailer_send_confirm($mail_data);

		//予約登録内容を登録したメールアドレスの仮登録情報を削除する。
		$sql_flg = $this->Reserve_model->delete_record_by_email($_SESSION['booker_email']);

		//削除に失敗値た時（想定できない）
		if($sql_flg === false){
			//緊急のエラー
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		//postで受け取ってgetで表示する処理
		header('Location: http://etude.com/Reservation/reserve_complete');
		exit;
	}

	//予約終了画面表示
	public function reserve_complete()
	{
		$this->load->view('header');
		$this->load->view('reservation/complete');
	}

	//予約削除を行う画面を表示
	public function cancel_reservation()
	{

		//postは想定していない
		if($_SERVER["REQUEST_METHOD"] === "POST"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		//リンクのトークンを取得
		$token = @$this->input->get('token') ?: null;

		//トークンがない時（悪意あるアクセスの可能性）
		if(!isset($token)){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=1');
			exit;
		}

		//トークンから予約情報を取得する。
		$data = $this->Reserve_model->get_info_by_token($token);

		//データの取得に失敗したとき
		if($data===null){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=1');
			exit;
		}

		//予約情報のidからvisitorデータを取得する。
		$visitor_data = $this->Reserve_model->get_visitor_by_booking_id($data['id']);

		//データの取得に失敗したとき
		if($visitor_data===null){
			//想定できない
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		//viewにおくるためのデータ成形
		$data['visitor_data'] = $visitor_data;

		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();

		$this->load->view('header');
		$this->load->view('reservation/cancel_confirmation',$data);
	}

	//予約データをtokenをもとに削除を行い完了画面を表示する
	public function delete_reserve_data()
	{
		//getは想定していない
		if($_SERVER["REQUEST_METHOD"] === "GET"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		$token    = @$this->input->post('token')?: null;

		//トークンが存在しない時
		if($token===null){
			//想定できない
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		//トークンに一致したレコードを取得する。
		$data = $this->Reserve_model->get_info_by_token($token);

		//データが存在しない時
		if($data===null){
			//想定できない
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		//取得したidに一致するvisitor情報を削除する？（bookingstatusの）変更にするだけならのこしてもよいかもしれない
		$sql_flg = $this->Reserve_model->delete_visitor_by_id($data['id']);

		//削除に失敗したとき
		if($sql_flg===false){
			//想定できない
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		//トークンに一致するレコードを削除する？（booking_statusを）変更にするか
		$sql_flg = $this->Reserve_model->delete_record_by_token($token);

		//削除に失敗したとき
		if($sql_flg===false){
			//想定できない
			header('Location: http://etude.com/Reservation/view_error_message?errortype=99');
			exit;
		}

		//postで処理してgetで表示する処理
		header('Location: http://etude.com/Reservation/cancel_complete');
		exit;	
	}
	
	public function cancel_complete()
	{
		//予約キャンセル完了画面表示
		$this->load->view('header');
		$this->load->view('reservation/cancel_complete');
	}

	//予約が可能かどうかをデータベースの値を見て判断する。どこで判断するかはまだ決めてない
	public function bookable_check()
	{
		//getは想定していない
		if($_SERVER["REQUEST_METHOD"] === "GET"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}
		//1時間当たりの最大収容可能人数とりあえず10人にする。
		$limit_num_per_hour = 4;

		$data = @$this->input->post(array('booking_date','start_time','end_time','people_num','email'))?: null;

		//セッションに入力値を保存している。
		$_SESSION = array_merge($_SESSION,$data);

		//予約可否判定前に予約可否フラグは削除する。
		unset($_SESSION['book_unacceptable']);

		//strposでstart_timeとend_timeの:が出てくる所を探索してそこまでをカットしintにできるようにする。。
		$index_start = strpos($data['start_time'],':');
		$input_start = intval(substr($data['start_time'],0,$index_start));
		$index_end = strpos($data['end_time'],':');
		$input_end = intval(substr($data['end_time'],0,$index_end));

		
		//予約日が同じ日のレコードを全て持ってくる。
		$exsiting_data = $this->Reserve_model->get_allrecord_same_booking_date($data['booking_date']);

		//1時間当たりの予約可能な残り人数を表す配列の作成
		//例えば$bookable_array[1]の場合0時から1時まで予約可能人数を表す
		$bookable_array = array_fill(1, 24, $limit_num_per_hour);

		foreach($exsiting_data as $e_data){
			//start_timeと//end_timeをint型に成形する。
			$s_time = intval(substr($e_data['start_time'],0,2));
			$e_time = intval(substr($e_data['end_time'],0,2));
			
			for($i=$s_time;$i<$e_time;$i++){
				//入力された時間の前の1時間が実際のいる時間なので+1している。
				$bookable_array[$i+1] -= $e_data['people_num'];
			}
		};

		//残り予約可能人数の配列が作成できたのでここで今回入力された値が受け付けられるかを判定
		for($i=$input_start;$i<$input_end;$i++){
			$bookable_array[$i+1] -= intval($data['people_num']);
		}

		//一つでも残り予約可能人数配列が負になっていれば予約不可能判定
		$unacceptable_flg = FALSE;
		foreach($bookable_array as $num){
			if($num<0){
				$unacceptable_flg = TRUE;
			}
		}

		//予約不可であれば指定された時間帯は現在予約できないというような表示を出すようにする？
		if($unacceptable_flg===TRUE){
			$_SESSION['book_unacceptable'] = 'その時間帯は予約できませんもう一度入力してください。';

			//postで来てgetで表示する
			header('Location: http://etude.com/Reservation/view_detail_input_reserve');
			exit;

		}else{

			unset($_SESSION['book_unacceptable']);
			$_SESSION['book_unacceptable'] = '';

			//postで来てgetで表示する
			header('Location: http://etude.com/Reservation/view_name_input_reserve');
			exit;

		}
	}

	//postでアドレスを受け取ってトークンとその時間制限用timeをテーブルに登録し
	//その後メールを送る。
	public function sendMail()
	{
		//getは想定していない
		if($_SERVER["REQUEST_METHOD"] === "GET"){
			header('Location: http://etude.com/Reservation/view_error_message?errortype=5');
			exit;
		}

		$Email1    = @$this->input->post('Email1')?: null;

		//すでに仮登録メールが存在する場合

		//すでにbookingに予約情報がありbooking_statusが0か1の場合場合予約できないようにする。(予約データは消さないから予約データの有無では判定できないため)
		$exist = $this->Reserve_model->booking_mail_approval($Email1);
		if(isset($exist)){
			if($exist['booking_status'] === 0 ||$exist['booking_status'] === 1){
				header('Location: http://etude.com/Reservation/view_error_message?errortype=4');
				exit;
			}
		}
			
		//メールアドレスを暗号化する。
		$encrypted_data= password_hash(time(),PASSWORD_DEFAULT);

		//仮登録の期限用のtimestampを作る。
		$token_time = time();

		$data = array(
			'pre_regist_email'    => $Email1,
			'token'         => $encrypted_data,
			'token_time'    => $token_time,
		);
		
		//メールを送る
		// phpmailer_send($Email1,$encrypted_data);
		phpmailer_send($data);

		//仮登録データベースにアドレスを登録する。
		$this->Reserve_model->regist_mail($data);

		//postで送られたのでgetで表示する。という処理by清水氏
		header('Location: http://etude.com/Reservation/view_confirm_mail');
		exit;
	}

	//メール確認画面促進画面
	public function view_confirm_mail()
	{
		$this->load->view('header');
		$this->load->view('reservation/confirm_mail');
	}

	//QRコードと予約情報を確認できるページに行けるリンクを張る。
	public function sendMailFin()
	{
		$Email1    = @$this->input->post('Email1')?: null;
	
		//メールアドレスを暗号化する。
		$encrypted_data= password_hash($Email1,PASSWORD_DEFAULT);

		//仮登録の期限用のtimestampを作る。
		$token_time = time();

		$data = array(
			'temp_email'    => $Email1,
			'token'         => $encrypted_data,
			'token_time'    => $token_time,
		);

		//メールを送る
		phpmailer_send($data);
		
	}

	public function ajaxtest()
	{
		//ここでヘッダーにapplication/jsonを設定するとajaxのdatatypeでjsonを指定しないようにするほうが
		//自然だと思う。
		header("Content-Type: application/json; charset=utf-8");

		//postから予約日を取得
		$booking_date = $_POST['booking_date'];

		//1時間当たりの制限人数。
		$limit_num_per_hour=4;
		
		//開始時刻6時とする
		$event_start = 6;
		//終了時刻18時とする
		$event_finish = 18;
		
		//予約日が同じ日のレコードを全て持ってくる。
		$exsiting_data = $this->Reserve_model->get_allrecord_same_booking_date($booking_date);
		//1時間当たりの予約可能な残り人数を表す配列の作成
		//例えば$bookable_array[1]の場合0時から1時まで予約可能人数を表す
		$bookable_array = array_fill(1, 24, $limit_num_per_hour);

		//すでにある予約データ空
		foreach($exsiting_data as $e_data){
			//start_timeと//end_timeをint型に成形する。
			$s_time = intval(substr($e_data['start_time'],0,2));
			$e_time = intval(substr($e_data['end_time'],0,2));
			
			for($i=$s_time;$i<$e_time;$i++){
				//入力された時間の前の1時間が実際のいる時間なので+1している。
				$bookable_array[$i+1] -= $e_data['people_num'];
			}
		};

		$bookable_array=[1,2,3,4,5,6,7,8,9,8,7,6,5,4,3,2,1,2,3,4,2,3,6,7,3];

		//開始時刻より前と終了時刻より後の時刻は-1とする。
		for($i=0;$i<count($bookable_array);$i++){
			if($i<$event_start || $event_finish<$i){
				$bookable_array[$i] = -1;
			}
		}
		exit(json_encode(array('message' =>'認証成功','aiueo'=>$booking_date,'bookable_array'=>$bookable_array)));
		
	}
}
