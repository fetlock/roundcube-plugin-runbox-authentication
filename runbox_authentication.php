<?php
/**
 * Runbox Authentication
 *
 * Allow connection to Runbox IMAP and SMTP servers by replacing the 'at' symbol
 * with a 'percent' symbol in the username at connection time.
 *
 * Intentionally doesn't hook into user_create in order to preserve a friendly
 * looking email address in the user interface.
 *
 * @version 0.11
 * @author Fetlock
 * @url https://github.com/fetlock/roundcube-plugin-runbox-authentication
 */
class runbox_authentication extends rcube_plugin
{
  public $task = 'login|mail';
  private $rc;
  
  function init()
  {
    $this->rc = rcube::get_instance();
    $this->add_hook('authenticate', array($this, 'authentication'));
    $this->add_hook('storage_connect', array($this, 'storage_connection'));
    $this->add_hook('smtp_connect', array($this, 'smtp_connection'));
  }
  
  function authentication($args)
  {
    return array('user' => str_replace('@', '%', $args['user']));
  }
  
  function storage_connection($args)
  {
    return array('user' => str_replace('@', '%', $args['user']));
  }
  
  function smtp_connection($args)
  {
    return array('smtp_user' => str_replace('@', '%', $this->rc->user->get_username()));
  }
}
