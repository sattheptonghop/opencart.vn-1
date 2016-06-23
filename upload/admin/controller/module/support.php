<?php
class ControllerModuleSupport extends Controller {
	private $error = array();
 
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/support')) {
			$this->error['warning'] = $this->language->get('error_permission');
			$this->session->data['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}


	public function index() {
		$this->load->language('module/support');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('support', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_skype'] = $this->language->get('entry_skype');
		$data['entry_skype_2'] = $this->language->get('entry_skype_2');
		$data['entry_yahoo'] = $this->language->get('entry_yahoo');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_facebook'] = $this->language->get('entry_facebook');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/support', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/support', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['skype'])) {
			$data['skype'] = $this->request->post['skype'];
		} elseif (!empty($module_info)) {
			$data['skype'] = $module_info['skype'];
		} else {
			$data['skype'] = '';
		}

		if (isset($this->request->post['skype_2'])) {
			$data['skype_2'] = $this->request->post['skype_2'];
		} elseif (!empty($module_info)) {
			$data['skype_2'] = $module_info['skype_2'];
		} else {
			$data['skype_2'] = '';
		}


		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($module_info)) {
			$data['email'] = $module_info['email'];
		} else {
			$data['email'] = '';
		}


		if (isset($this->request->post['yahoo'])) {
			$data['yahoo'] = $this->request->post['yahoo'];
		} elseif (!empty($module_info)) {
			$data['yahoo'] = $module_info['yahoo'];
		} else {
			$data['yahoo'] = '';
		}


		if (isset($this->request->post['facebook'])) {
			$data['facebook'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['facebook'] = $module_info['facebook'];
		} else {
			$data['facebook'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/support_layout.tpl', $data));
	}
}
?>