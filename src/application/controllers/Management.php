<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class management extends CI_Controller {

	public function __construct()
	{
		// CI_Model constructor の呼び出し
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Booking_model');
		$this->load->model('Visitor_model');
		date_default_timezone_set('Asia/Tokyo');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->view('header');
		$this->load->view('management/login');
		$this->load->view('footer');
	}

	//1.ログイン画面表示//
	public function login()
	{
		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();

		//ログイン画面の表示
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	//2.パスワードチェック//
	public function Auth_check()
	{
		header("Content-Type: application/json; charset=utf-8");
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			define('PASSWORD', '$2y$10$SbdHurka6tRt02PSRxfNMOOFUnCSSPnnFmq8RWjoTIpTTfLTKdCr6'); //adminPasswordという文字列を暗号化したものが入っています
			if (empty($this->input->post('admin_password', true))) {
					header('HTTP/1.1 401 Unauthorized');
					exit(json_encode(['message' =>'パスワードが入っていません']));
			}
			$password = $this->input->post('admin_password', true);
			if (password_verify($password, PASSWORD)) {
					$_SESSION['admin_login'] = true;
					exit(json_encode(['message' =>'認証成功']));
			}
			header('HTTP/1.1 401 Unauthorized');
			exit(json_encode(['message' =>'パスワードが間違っています']));
		} else {
			header('HTTP/1.1 405 Method Not Allowed');
			exit(json_encode(['message' =>'許可されていないメソッドです']));
		}
		exit();
	}

	//3.一覧表表示//
	public function all_display()
	{
		//Booking_modelから全ての予約情報を取得する
		$data['booking_array'] = $this->Booking_model->get_all_record();

		//csrfチェック
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token_hash'] = $this->security->get_csrf_hash();

		//一覧表画面表示
		$this->load->view('header');
		$this->load->view('management/all_of_reservation',$data);
		$this->load->view('footer');
	}

	//受付（予約）情報表示
	public function confirmation()
	{
		//一覧表画面からidを取得
		$id = @$this->input->get('id')?: null;

		//Visitor_model用にidをbooking_idに変換
		$booking_id = @$this->input->get('id')?: null;

		// $_SESSION['id'] = $booking_id;
			if(!empty($id) && is_numeric($id)) {
					$data = null;
					if (!empty($_SESSION['error_message'])) {
						$data['error_message'] = $_SESSION['error_message'];
						unset($_SESSION['error_message']);
					}
					//指定のidを持つbooking情報を取得
					$data['booking_data'] = $this->Booking_model->get_record($id);

					//指定のbooking_idを持つvisitor情報を取得
					$data['visitor_data'] = $this->Visitor_model->get_record($booking_id);

					//csrfチェック
					$data['csrf_token_name'] = $this->security->get_csrf_token_name();
					$data['csrf_token_hash'] = $this->security->get_csrf_hash();

					//$dataにデータがあれば表示、なければエラー表示
					if (!empty($data['booking_data'])) {
						$this->load->view('header');
						$this->load->view('management/part_of_reservation',$data);
						$this->load->view('footer');
					} else {
						$_SESSION['error_message'][] = '存在しないレコードです。';
						header('location: /');
						exit;
					}
			} else {
					$_SESSION['error_message'][] = '更新に必要なパラメータが含まれていません';
					header('location: /');
					exit;
			}
	}
}
