<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// 
//  Stikked Config File
//  stikked
//  
//  Created by Ben McRedmond on 2008-01-25.
//  Copyright 2008 HiPPstr. All rights reserved.
// 

/**
 * Site Name
 * 
 * The name of your site
 *
*/
$config['site_name'] = "openSUSE Paste";

/**
 * Key for Cron
 *
 * The password required to run the cron job
 *
**/
$config['cron_key'] = "pastesecretkey";

/**
 * Pastes Per Page
 *
 * Number of pastes per page, on the recent pastes listings.
 *
**/
$config['per_page'] = 20;

/**
 * Name for anonymous poster
 *
 * What name is to be set for anonymous posters
 * DO NOT SET BLANK
 * Set to random for a random paste to be generated
 * NOTE: if changed only pastes from then on will be updated.
 *
**/
$config['unknown_poster'] = "random";

/**
 * Name for untitled pastes
 *
 * What name is to be set for untitled pastes.
 * DO NOT SET BLANK
 * NOTE: if changed only pastes from then on will be updated.
**/
$config['unknown_title'] = "Untitled";

/**
 *
 *
 *  Words used for when unknown_poster is set to random
 *
 *
**/

$config['nouns'] = array('Lizzard', 'Geeko', 'Chameleon');

$config['adjectives'] = array('Anonymous', 'Unknown', 'Paranoid');

?>
