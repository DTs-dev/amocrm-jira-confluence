<?php
/*
Module Name: amoCRM, Jira & Confluence Integration Module
Module URL: https://github.com/DTs-dev/amocrm-jira-confluence
Description: Integration module for interaction amoCRM, Jira and Confluence systems
Author: Dmitriy Tsyganok
Author URL: https://github.com/DTs-dev
License: GPL v3
*/

// Main paths
define('MODULE_DIR', __DIR__ . '/');
define('LOG_DIR', MODULE_DIR . 'logs/');
define('INC', MODULE_DIR . 'inc/');

// Returns 200 and processing continues (to exception response timeouts to amoCRM)
include_once INC . 'respond-ok.php';

// amoCRM task created
include_once INC . 'ajc.php';
?>
