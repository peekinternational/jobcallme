<?php

if(!isset($errors)){
   $errors='';
}

$content = <<<EOD

CREATE table cometchat_archive LIKE cometchat;
CREATE table cometchat_guests_archive LIKE cometchat_guests;
CREATE table cometchat_chatroommessages_archive LIKE cometchat_chatroommessages;
CREATE table cometchat_chatrooms_archive LIKE cometchat_chatrooms;
CREATE table cometchat_chatrooms_users_archive LIKE cometchat_chatrooms_users;

WITH upsert AS (UPDATE cometchat_settings SET value = '29', key_type = '1' WHERE setting_key = 'dbversion' RETURNING *) INSERT INTO cometchat_settings (setting_key , value, key_type) SELECT 'dbversion', '29', '1' WHERE NOT EXISTS (SELECT * FROM upsert);
EOD;

EOD;
$q = preg_split('/;[\r\n]+/',$content);
foreach ($q as $query) {
  if (strlen($query) > 4) {
    if (!sql_query($query, array(), 1)) {
      $errors .= sql_error($dbh)."<br/>\n";
    }
  }
}
removeCachedSettings($client.'settings');
