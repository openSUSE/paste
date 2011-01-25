<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['openid_storepath'] = 'tmp';
$config['openid_baseurl'] = 'http://susepaste.org';
$config['openid_policy'] = 'Main/index';
$config['openid_required'] = array('nickname');
$config['openid_request_to'] = 'Main/finish_auth';

?>
