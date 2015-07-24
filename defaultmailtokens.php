<?php

require_once 'defaultmailtokens.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function defaultmailtokens_civicrm_config(&$config) {
  _defaultmailtokens_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function defaultmailtokens_civicrm_xmlMenu(&$files) {
  _defaultmailtokens_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function defaultmailtokens_civicrm_install() {
  _defaultmailtokens_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function defaultmailtokens_civicrm_uninstall() {
  _defaultmailtokens_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function defaultmailtokens_civicrm_enable() {
  _defaultmailtokens_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function defaultmailtokens_civicrm_disable() {
  _defaultmailtokens_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function defaultmailtokens_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _defaultmailtokens_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function defaultmailtokens_civicrm_managed(&$entities) {
  _defaultmailtokens_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function defaultmailtokens_civicrm_caseTypes(&$caseTypes) {
  _defaultmailtokens_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function defaultmailtokens_civicrm_angularModules(&$angularModules) {
_defaultmailtokens_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function defaultmailtokens_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _defaultmailtokens_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function defaultmailtokens_civicrm_preProcess($formName, &$form) {

}

*/


/**
 * Implements hook_civicrm_tokenValues().
 * // found https://civicrm.org/blogs/colemanw/create-your-own-tokens-fun-and-profit
*/
function defaultmailtokens_civicrm_tokenValues(&$values, $cids, $job = null, $tokens = array(), $context = null) {
	
	//echo 'values:\n',print_r($values,true),"\ncids\n",print_r($cids,true),"\njob\n",print_r($job,true),"\ntokens\n",print_r($tokens,true),"\ncontext\n",print_r($context,true),"\n";
	
	if (!empty($values)) {
		if (is_array($cids)) {
			/* values looks like
			 Array
				(
					[250331] => Array
						(
							[contact_id] => 250331
							[display_name] => John Smith
							[preferred_mail_format] => 
							[hash] => 56ca33ecaefbe170ae155660cf1812c6
							[first_name] => John
							[is_deceased] => 0
							[email_id] => 1235
							[on_hold] => 0
						)
						... more records with pertinanat tokens ...
				)
			*/
			foreach ($cids as $cid) {
				if (empty($values[$cid])) {
					// for some reason we werent passed a contact
					 $contact = civicrm_api3('Contact','get',array(
						'contact_id' => $cid,
					));
					if (!empty($contact['is_error'])) continue;
					$values[$cid] = array(
						'contact_id' => $cid,
						'display_name' => $contact['values'][$cid]['display_name'],
						'preferred_mail_format' => $contact['values'][$cid]['preferred_mail_format'],
						'is_deceased' => $contact['values'][$cid]['is_deceased'],
						'email_id' => $contact['values'][$cid]['email_id'],
						'on_hold' => $contact['values'][$cid]['on_hold'],						
					);
				}
				$used = array_key_exists('first_name',$values[$cid])||!empty($tokens['contact']['first_name']);
				if ($used&&empty($values[$cid]['first_name'])) $values[$cid]['first_name'] = 'Friend';
			}
		} else {
			/* we were passes a single contact record here */
			if (empty($values['first_name'])) $values['first_name'] = 'Friend';
		}
	}

	//echo 'values:\n',print_r($values,true),"\ncids\n",print_r($cids,true),"\njob\n",print_r($job,true),"\ntokens\n",print_r($tokens,true),"\ncontext\n",print_r($context,true),"\n"; exit;
}

// https://civicrm.org/blogs/civicrm-team/civimail-how-add-default-values-empty-tokens?q=blogs/civicrm-team/civimail-how-add-default-values-empty-tokens
//~ function defaultmailtokens_civicrm_tokenValues( &$values, &$contactIDs, $job = null, $tokens = array(), $context = null) {
    //~ if ( is_array( $contactIDs ) ) {
        //~ $single = false;
    //~ } else {
        //~ $contactIDs = array( $contactIDs );
        //~ $single = true;
    //~ }
//~ 
    //~ // lets assume we want default values for the below tokens
    //~ $defaults = array( 
		//~ 'first_name'  => 'Friend',
		//~ // 'last_name'   => 'DEFAULT LAST',
		//~ // 'middle_name' => 'DEFAULT MIDDLE',
		//~ // 'home_URL'    => 'HOME URL'
	//~ );
//~ 
    //~ foreach ( $contactIDs as $cid ) {
        //~ if ( $single ) {
            //~ $value =& $values;
        //~ } else {
            //~ $value =& $values[$cid];
        //~ }
//~ 
        //~ foreach ( $defaults as $k => $v ) {
            //~ if ( ! isset( $value[$k] ) || empty( $value[$k] ) ) {
                //~ $value[$k] = $v;
            //~ }
        //~ }
    //~ }
//~ }

/*
Array
(
    [is_error] => 0
    [version] => 3
    [count] => 1
    [id] => 251528
    [values] => Array
        (
            [251528] => Array
                (
                    [contact_id] => 251528
                    [contact_type] => Individual
                    [contact_sub_type] => 
                    [sort_name] => Knight
                    [display_name] => Knight
                    [do_not_email] => 0
                    [do_not_phone] => 0
                    [do_not_mail] => 0
                    [do_not_sms] => 0
                    [do_not_trade] => 0
                    [is_opt_out] => 0
                    [legal_identifier] => 
                    [external_identifier] => 
                    [nick_name] => 
                    [legal_name] => 
                    [image_URL] => 
                    [preferred_communication_method] => 
                    [preferred_language] => en_US
                    [preferred_mail_format] => Both
                    [first_name] => 
                    [middle_name] => 
                    [last_name] => Knight
                    [prefix_id] => 
                    [suffix_id] => 
                    [formal_title] => 
                    [communication_style_id] => 1
                    [job_title] => 
                    [gender_id] => 
                    [birth_date] => 
                    [is_deceased] => 0
                    [deceased_date] => 
                    [household_name] => 
                    [organization_name] => 
                    [sic_code] => 
                    [contact_is_deleted] => 0
                    [current_employer] => 
                    [address_id] => 249321
                    [street_address] => 
                    [supplemental_address_1] => 
                    [supplemental_address_2] => 
                    [city] => 
                    [postal_code_suffix] => 
                    [postal_code] => 
                    [geo_code_1] => 36.778261
                    [geo_code_2] => -119.4179324
                    [state_province_id] => 1004
                    [country_id] => 1228
                    [phone_id] => 
                    [phone_type_id] => 
                    [phone] => 
                    [email_id] => 89531
                    [email] => phillipkknight+jesus@gmail.com
                    [on_hold] => 0
                    [im_id] => 
                    [provider_id] => 
                    [im] => 
                    [worldregion_id] => 2
                    [world_region] => America South, Central, North and Caribbean
                    [individual_prefix] => 
                    [individual_suffix] => 
                    [communication_style] => Formal
                    [gender] => 
                    [state_province_name] => CA
                    [state_province] => CA
                    [country] => United States
                    [id] => 251528
                )

        )
)
*/
