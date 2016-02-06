# Runbox authentication plugin (Roundcube)

The [Runbox] (https://runbox.com) email hosting service expects custom domain logins to the IMAP and SMTP services to use a format of
>username%domain.tld

This doesn't play well with the [Roundcube] (https://roundcube.net) webmail client when using the *username_domain* configuration option (silently appending *@domain.tld* onto a username as needed).

This plugin [hooks] (http://trac.roundcube.net/wiki/Plugin_Hooks) into the authentication steps and replaces *@* with *%*,  making the username compatible.

## Install
Upload the files to your roundcube installation such that you have
> {roundcube}/plugins/runbox_authentication/runbox_authentication.php

Enable the plugin in your configuration file
> {roundcube}/config/config.inc.php

```php
$config['plugins'] = array(
 	'runbox_authentication'
 	//,'other',
 	//'plugins'
);
```
