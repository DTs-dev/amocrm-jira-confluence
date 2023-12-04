# amoCRM, Jira & Confluence Integration Module
Integration module for interaction amoCRM, Jira and Confluence systems in PHP

## Requirements
- php
- php-curl
- php-json
- php-xml
- Web-server (Nginx, Apache, etc.)
- [Confluence content properties to CQL](/../../../confluence-cql-properties)

## Usage
1. Set up the configuration of amoCRM, jira and confluence instances in the file `config.php`.
2. Set amoCRM account id in the file `index.php`.
3. Run the software on your web-server.
4. Configure your web-server to write access log to the file `ajc.access.log` in the folder `ajc/amocrm-jira-confluence/logs` (the rest of the log files in the folder are managed by php).
5. URL to use in webhook integration on amoCRM instance: https://your-web-server.com/ajc
6. URL to use in webhook integration on Jira instance: https://your-web-server.com/ajc?issue_key=${issue.key}

## Software information
This version of the module is a demo version. In this version, the functionality of creating amoCRM task /Jira issue / Confluence page is available. Authorization in jira and confluence using with username and password, in amoCRM using with personal key is also available. More advanced authorization and other integration features are available in the full version.
