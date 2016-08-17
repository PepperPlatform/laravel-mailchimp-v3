<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 8/15/16
 * Time: 4:40 PM
 */

namespace Mailchimp;


class MailchimpMethodWrapper extends Mailchimp {

	public function listSubscribe($listId,
	                              $emailAddress,
	                              $status = 'subscribed',
	                              $mergeFields = null,
	                              $emailType = 'html') {

		$params = array();
		$params["email_address"] = $emailAddress;
		$params["status"] = $status;
		$params["merge_fields"] = $mergeFields;
		$params["email_type"] = $emailType;

		$this->post('/lists/' . $listId . '/members/', $params);
	}

	public function listUnsubscribe($listId, $emailAddress) {

		$md5OfEmail = md5($emailAddress);

		return $this->delete("/lists/$listId/members/$md5OfEmail");
	}
}