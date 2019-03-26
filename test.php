<?php
/**
 * Get secrets from secrets file.
 *
 * @param array $requiredKeys  List of keys in secrets file that must exist.
 */

$secretsFile = './secrets.json';
if (file_exists($secretsFile)) {
    $secrets = json_decode(file_get_contents($secretsFile), 1);
} else {
    die('No secrets file found. Aborting!');
}
if ($secrets == false) {
    die('Could not parse json in secrets file. Aborting!');
}
if (!empty($secrets['migrate_source_db__url'])) {
    $parsed_url = parse_url($secrets['migrate_source_db__url']);
    echo $parsed_url['port'] . PHP_EOL;
    echo $parsed_url['host'] . PHP_EOL;
    echo $parsed_url['pass'] . PHP_EOL;
    if (!empty($parsed_url['port']) && !empty($parsed_url['host']) && !empty($parsed_url['pass'])) {
      $databases['upgrade']['default'] = array (
      'database' => 'pantheon',
      'username' => 'pantheon',
      'password' => $parsed_url['pass'],
      'host' => $parsed_url['host'],
      'port' => $parsed_url['port'],
      'driver' => 'mysql',
      'prefix' => '',
      );

      $databases['migrate']['default'] = $databases['upgrade']['default'];
      $databases['drupal_7']['default'] = $databases['upgrade']['default'];
    }
    var_dump($databases);
}

// {"migrate_source_db__url":"mysql:\/\/pantheon:9a1a60f331604f279e94d3bda21937c2
//   @dbserver.migratetest.7ce3eed7-0b1c-40fc-bd90-3a8ecbbd391f.drush.in:24359\/pantheon"}
