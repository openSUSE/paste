<?php

/** 
* Main Controller for Stikked
* 
* @author Ben McRedmond <hello@benmcredmond.com>
* @copyright Ben McRedmond
* @package Stikked
*
*/

/** 
* Main controller class for stikked.
*
* @author Ben McRedmond <hello@benmcredmond.com>
* @version 0.5.1
* @access public
* @copyright Ben McRedmond
* @package Stikked
* @subpackage Controllers
*
*/

class Main extends Controller 
{

	/** 
	* Class Constructor, loads languages model which is inherited in the pastes model.
	*
	* @return void
	*/

	function __construct() 
	{
		parent::__construct();
		$this->load->model('languages');
		$this->load->model('keys');
		$this->lang->load('openid', 'english');
		$this->load->helper('url');

		//converts query string into global GET array variable
		parse_str($_SERVER['QUERY_STRING'],$_GET);
	}
	
	/** 
	* Sets all the fields in a paste form, depending on whether the form is being repopulated or items need to be loaded from session data.
	*
	* @param string $lang Paste language
	* @param string $title Paste title
	* @param string $paste Paste body
	* @param bool|string $reply Is this paste a reply? Bool if not, otherwise it's the id of the paste.
	* @return Array
	* @access private
	* @see index()
	* @see view()
	*/	
	
	function _user_prep($data = array()) {
		if($this->keys->verify()) {
			$data['oid_nick']  = $this->session->userdata('nick');
			$data['oid_login'] = $this->session->userdata('login');
		}
		return $data;
	}

	function _form_prep($lang='auto', $title = '', $paste='', $reply=false)
	{
		$this->load->model('languages');
		$this->load->helper("form");
		
		$data['languages'] = $this->languages->get_languages();		
		$data['scripts'] = array('jquery.js', 'jquery.timers.js');
		
		if($lang == 'auto') {
			if(strncmp("img",$_SERVER['SERVER_NAME'],3)==0) {
				$lang = "image";
			} else {
				$lang = "text";
			}
		}
		
		$nick = $this->session->userdata('nick');
		if($nick != FALSE) {
			$data['name_set'] = $nick;
		}

		if(!$this->input->post('submit'))
		{
			$data['paste_set'] = $paste;
			$data['title_set'] = $title;
			$data['reply'] = $reply;
			$data['lang_set'] = $lang;
			// Parses GET-data for presets:
			$get_title = base64_decode($this->input->get('title', TRUE));
			$get_paste = base64_decode($this->input->get('paste', FALSE));
			$get_name = base64_decode($this->input->get('name', TRUE));
			$get_expire = $this->input->get('expire', TRUE);
			$get_lang = $this->input->get('lang', TRUE);
			$get_private = $this->input->get('private', TRUE);


			if($get_title)
				$data['title_set'] = $get_title;
			if($get_paste)
				$data['paste_set'] = $get_paste;
			if($get_name)
				$data['name_set'] = $get_name;
			if($get_expire)
				if($get_expire < 0)
					$get_expire = 0;
				$data['expire_set'] = $get_expire;
			if($get_lang)
				$data['lang_set'] = $get_lang;
			if($get_private)
				$data['private_set'] = $get_private;
		}
		else
		{
			$data['name_set'] = $this->input->post('name');
			$data['expire_set'] = $this->input->post('expire');
			$data['private_set'] = $this->input->post('private');
			$data['paste_set'] = $this->input->post('paste');
			$data['title_set'] = $this->input->post('title');
			$data['reply'] = $this->input->post('reply');
			$data['lang_set'] = $this->input->post('lang');
		}
		return $this->_user_prep($data);
	}
	
	/** 
	* Controller method to load front page.
	*
	* @return void
	* @access public
	* @see _form_prep()
	* @see _valid_lang()
	*/
	
	function index()
	{
		if(!isset($_POST['submit']))
		{
			$this->keys->verify();
			$data = $this->_form_prep();
			$this->load->view('home', $data);
		}
		else
		{
			$this->keys->verify();
			$match_int = count(preg_split('/http:\/\//i', $this->input->post('code')));
			if((((pow($match_int-1,2) * 20 ) / strlen($this->input->post('code')))>1) &&
			   (!$this->keys->verify()))
			{
					show_error("You are spammer!!!");
					return;
			}

			$this->load->model('pastes');
			$this->load->library('validation');
		
			$rules['lang'] = 'min_length[1]|required|callback__valid_lang';

			$fields['lang'] = 'Language';
			
			$this->validation->set_rules($rules);
			$this->validation->set_fields($fields);
			$this->validation->set_message('min_length', 'The %s field can not be empty');
			$this->validation->set_error_delimiters('<div class="message error"><div class="container">', '</div></div>');
			
			if ($this->validation->run() == FALSE)
			{
				$data = $this->_form_prep();
				$this->load->view('home', $data);
			}
			else
			{
				redirect($this->pastes->createPaste());
			}
		}
	}
	
	
	/** 
	* Controller method to load raw pastes.
	*
	* @return void
	* @access public
	*
	*/
		
	function raw()
	{
		$this->load->model('pastes');
		$check = $this->pastes->checkPaste(3);
		if($check)
		{
		
			$data = $this->pastes->getPaste(3);
			$this->load->view('view/raw', $this->_user_prep($data));
		}
		else
		{
			show_404();
		}
	}

	/** 
	* Controller method to load raw pastes.
	*
	* @return void
	* @access public
	*
	*/
		
	function simple()
	{
		$this->load->model('pastes');
		$check = $this->pastes->checkPaste(3);
		if($check)
		{
		
			$data = $this->pastes->getPaste(3);
			$this->load->view('view/simple', $this->_user_prep($data));
		}
		else
		{
			show_404();
		}
	}

	function delete_key() {
		if(!$this->keys->verify())
			redirect();
		$this->keys->delete_key($this->uri->segment(3));
		redirect('main/my_keys');
	}

	function create_key()
	{
		if(!$this->keys->verify())
			redirect();
		$this->keys->gen_key($_POST['ttl'], $_POST['title']);
		redirect('main/my_keys');
	}


	function my_keys() {
		if(!$this->keys->verify())
			redirect();
		$data['keys'] = $this->keys->get_keys();
		$data['page_title'] = "My Keys";
		$this->load->view('key_list', $this->_user_prep($data));
	}

	function deletePaste() {
		if(!$this->keys->verify())
			redirect();
		$this->load->model('pastes');
		$this->pastes->deletePaste($this->uri->segment(2));
		redirect('main/my_list');
	}

	function login() {
		$this->openid->set_trust_root(base_url());
		$this->openid->set_request_to(site_url('main/finish_auth'));
		$this->openid->set_args(null);
		$this->openid->set_sreg(true, array('nickname'), array(), base_url());
		$this->openid->set_pape(true, array());
		$this->openid->authenticate($_POST['openid']);
	}
	function logout() {
		$this->session->sess_destroy();
		redirect();
	}

	function finish_auth() {
		$this->openid->set_request_to(site_url('main/finish_auth'));
		$response = $this->openid->getResponse();
		if (($response->status == Auth_OpenID_SUCCESS) && 
		    ((strlen($login = $response->getDisplayIdentifier()))<160))
		{
			$sreg_resp = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
			$sreg = $sreg_resp->contents();
			$nick = $sreg['nickname'];
			$this->session->set_userdata(array(
				'login' => $login,
				'nick'  => $nick ));
			$this->keys->add_me();
			redirect();
		}
		else
		{
			$this->session->sess_destroy();
			show_error("<h3>Login failed!!!</h3>" . $response->message);
		}
	}
	
	/** 
	* Controller method to download pastes.
	*
	* @return void
	* @access public
	*
	*/
	
	function download()
	{
		$this->load->model('pastes');
		$check = $this->pastes->checkPaste(3);
		if($check)
		{
			$data = $this->pastes->getPaste(3);
			$this->load->view('view/download', $this->_user_prep($data));
		}
		else
		{
			show_404();
		}
	
	}
	
	
	/** 
	* Controller method to show recent pastes.
	*
	* @return void
	* @access public
	*
	*/
	
	function lists()
	{
		$this->load->model('pastes');
		$data = $this->pastes->getLists();
		$data['page_title'] = "Recent Pastes";
		$this->load->view('list', $this->_user_prep($data));
	}

	function my_list()
	{
		$this->keys->verify();
		$this->load->model('pastes');
		$data = $this->pastes->getMyLists();
		$data['page_title'] = "My Pastes";
		$this->load->view('list', $this->_user_prep($data));
	}


		
	/** 
	* Controller method to show a paste.
	*
	* @return void
	* @access public
	*
	*/
	
	function view() 
	{
		$this->load->model('pastes');	

		$check = $this->pastes->checkPaste(2);
				
		if($check)
		{
			$data = $this->pastes->getPaste(2, true);
			$data['reply_form'] = $this->_form_prep($data['lang_code'], "RE: ".$data['title'], $data['raw'], $data['pid']);
			
			$data['full_width'] = false;
			
			$this->load->view('view/view', $this->_user_prep($data));
		}
		else
		{
			show_404();
		}
	}
	
	
	/** 
	* Loads data for view_options from session data or not if not set.
	*
	* @return array
	* @access private
	*
	*/
	
	function _view_options_prep()
	{
		$this->load->helper('form');
		$data['full_width_set'] = false;
		$data['view_simple_set'] = false;
		return $data;
	}
	
	
	/** 
	* Displays the page where a user can change their paste viewing settings which are saved to session data.
	*
	* @return void
	* @access public
	*
	*/
	
	function view_options()
	{
		if(!isset($_POST['submit']))
		{
			$data = $this->_view_options_prep();
			$this->load->view('view/view_options', $this->_user_prep($data));
		}
		else
		{
			$this->load->library('validation');
			
			$rules['full_width'] = 'max_length[1]';
			$rules['view_simple'] = 'max_length[1]';
			
			$this->validation->set_rules($rules);
			
			if($this->validation->run() == false)
			{
				exit('Ugh, stupid skiddie.');
			}
			else
			{
				$user_data = array(
					'full_width' => $this->input->post('full_width'),
					'view_simple' => $this->input->post('view_simple'),
					'remember_view' => true
					);
				redirect();
			}
		}
	}
	
	
	/** 
	* Controller method to run the cron. Requires a valid cron key supplied as an argument in the url.
	*
	* @return void;
	* @access public
	*
	*/
	
	function cron()
	{
		$this->load->model('pastes');
		$key = $this->uri->segment(2);
		if($key != $this->config->item('cron_key'))
		{
			show_404();
		}
		else
		{
			$this->pastes->cron(); 
			$this->keys->cron(); 
			return 0;
		}
	}
	
	
	/** 
	* Validation callback method to validate whether the paste language is valid. 
	*
	* @return bool
	* @access private
	* @see index()
	*
	*/
	
	function _valid_lang($lang) 
	{
		$this->load->model('languages');
		$this->validation->set_message('_valid_lang', 'Please select your language');
		return $this->languages->valid_language($lang);
	}
}
?>
