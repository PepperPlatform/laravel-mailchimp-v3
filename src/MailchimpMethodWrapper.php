<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 8/15/16
 * Time: 4:40 PM
 */

namespace Mailchimp;


class MailchimpMethodWrapper extends Mailchimp {

	/**
	 *
	 * Status 'pending' means that the user will get a confirmation email for a subscription
	 * @see http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/#create-post_lists_list_id_members
	 *
	 * @param $listId
	 * @param $emailAddress
	 * @param string $status    subscribed, unsubscribed, cleaned, pending
	 * @param string $emailType
	 * @return \Illuminate\Support\Collection
	 */
	public function listSubscribe($listId,
	                              $emailAddress,
	                              $status = 'pending',
	                              $emailType = 'html') {

		$params = array();
		$params["email_address"] = $emailAddress;
		$params["status"] = $status;
		$params["email_type"] = $emailType;

		return $this->post('/lists/' . $listId . '/members/', $params);
	}

	public function listUnsubscribe($listId, $emailAddress) {

		$md5OfEmail = md5($emailAddress);

		return $this->delete("/lists/$listId/members/$md5OfEmail");
	}
}