<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// 
//  Stikked Config File
//  stikked
//  
//  Created by Ben McRedmond on 2008-01-25.
//  Copyright 2008 HiPPstr. All rights reserved.
// 

/**
 * Pastes Per Page
 *
 * Number of pastes per page, on the recent pastes listings.
 *
**/
$config['per_page'] = 10;

/**
 * Name for anonymous poster
 *
 * What name is to be set for anonymous posters
 * DO NOT SET BLANK
 * NOTE: if changed only pastes from then on will be updated.
**/
$config['unknown_poster'] = "anonymous";

/**
 * Name for untitled pastes
 *
 * What name is to be set for untitled pastes.
 * DO NOT SET BLANK
 * NOTE: if changed only pastes from then on will be updated.
**/
$config['unknown_title'] = "Untitled";

?>