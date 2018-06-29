<?php
class ControllerExtensionPaymentSkyfaithPaymentCase1 extends Controller {
	public function index() {
		return $this->load->view('extension/payment/skyfaith_payment_case1');
	}

	public function confirm() {
		$json = array();
		
		if ($this->session->data['payment_method']['code'] == 'skyfaith_payment_case1') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_skyfaith_payment_case1_order_status_id'));
		
			$json['redirect'] = $this->url->link('checkout/success');
		}
		
		$this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));		
    }
}