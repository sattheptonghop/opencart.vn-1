<?php
class ControllerModuleSupport extends Controller {
	public function index() {
		$this->load->language('module/support');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['id'])) {
			$parts = explode('_', (string)$this->request->get['id']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['support_id'] = $parts[0];
		} else {
			$data['support_id'] = 0;
		}

		$this->load->model('tool/image');
		$this->load->model('extension/module');
 		$support_module = $this->model_extension_module->getModulesByCode('support');
 		$setting_support = json_decode($support_module[0]['setting']);
 		$data['module_title'] = $support_module[0]['name'];
		
 		$data['support_skype'] = (
 			$setting_support->skype ?
 			'<a href="skype:'.$setting_support->skype.'?chat" class="list-group-item"><img src="image/support-skype.png"> Skype: <strong>'.$setting_support->skype.'</strong></a>':
 			'cx'
 		);
 		$data['support_skype_2'] = (
 			$setting_support->skype_2 ?
 			'<a href="skype:'.$setting_support->skype_2.'?chat" class="list-group-item"><img src="image/support-skype.png"> Skype: <strong>'.$setting_support->skype_2.'</strong></a>':
 			''
 		);
 		$data['support_yahoo'] = (
 			$setting_support->yahoo ?
 			'<a href="ymsgr:SendIM?'.$setting_support->yahoo.'" class="list-group-item"><img src="image/support-yahoo.png"> Yahoo: <strong>'.$setting_support->yahoo.'</strong></a>':
 			''
 		);
 		$data['support_email'] = (
 			$setting_support->email ?
 			'<a href="mailTo:'.$setting_support->email.'" class="list-group-item"><img src="image/support-email.png"> Email: <strong>'.$setting_support->email.'</strong></a>':
 			''
 		);
 		$data['support_facebook'] = (
 			$setting_support->facebook ?
 			'<a href="https://www.facebook.com/'.$setting_support->facebook.'" class="list-group-item"><img src="image/support-facebook.png" /> Facebook: <strong>'.$setting_support->facebook.'</strong></a>':
 			''
 		);


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/support.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/support.tpl', $data);
		} else {
			return $this->load->view('default/template/module/support.tpl', $data);
		}
	}

}