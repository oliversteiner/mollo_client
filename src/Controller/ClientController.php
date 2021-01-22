<?php

namespace Drupal\mollo_client\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;

/**
 * Class ClientController.
 *
 * Get all Information from
 *
 * -----------------------------------------
 */
class ClientController extends ControllerBase
{
  // public  Vars for Twig Var Suggestion.
  // use in Template via:
  // {# @var client \Drupal\mollo_client\Controller\ClientController #}

  public $client_groups;

  public $birthday;

  public $city;

  public $email;

  public $entry;

  public $calendar; // TODO

  public $facebook;

  public $first_name;

  public $function;

  public $is_active;

  public $last_name;

  public $links;

  public $media;

  public $mobile;

  public $phone;

  public $position;

  public $resigning;

  public $speciality;

  public $street_and_number;

  public $title_image;

  public $token;

  public $user;

  public $wikipedia;

  public $zip_code;

  public $role_name;

  public $role_group;

  public $role_description;

  public $leadership;

  public $icon;

  public $id;

  /**
   * Getvars.
   *
   *    Bundle mollo_client
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_first_name
   *    - field_mollo_last_name
   *    - field_mollo_calendar ( Entity: mollo_calendar )
   *    - field_mollo_is_active ( boolean )
   *    - field_mollo_entry
   *    - field_mollo_resigning
   *    - field_mollo_client_groups
   *
   *   Images
   *     - field_mollo_title_image ( Entity: Media )
   *     - field_mollo_media ( Entity: Media )
   *
   *   Classification
   *     - field_mollo_function ( Term: mollo_function )
   *     - field_mollo_position ( Term: mollo_position )
   *     - field_mollo_speciality ( Term: mollo_speciality )
   *
   *   Contact
   *     - field_mollo_email
   *     - field_mollo_links
   *     - field_mollo_facebook
   *     - field_mollo_mobile
   *     - field_mollo_phone
   *     - field_mollo_wikipedia
   *
   *   Personal
   *     - field_mollo_birthday
   *
   *   Address
   *     - field_mollo_street_and_number
   *     - field_mollo_city
   *     - field_mollo_zip_code
   *     - field_mollo_country ( Term: mollo_country )
   *
   *   Helper
   *     - field_mollo_token
   *     - field_mollo_user ( Entity: Drupal user ID )
   *
   *
   * @param $client_id
   *
   *
   * @return array|string[]
   *   Return Client Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($client_id): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($client_id);

    if (isset($node)) {
      // Get Field Values
      $first_name = Helper::getFieldValue($node, 'field_mollo_first_name');
      $last_name = Helper::getFieldValue($node, 'field_mollo_last_name');

      // Get only IDs
      $title_image = Helper::getFieldValue($node, 'field_mollo_title_image');

      // Get Taxonomy Content

      $function = Helper::getFieldValue(
        $node,
        'field_mollo_function',
        'mollo_function',
        true
      );

      $position = Helper::getFieldValue(
        $node,
        'field_mollo_position',
        'mollo_position',
        true
      );
      $speciality = Helper::getFieldValue(
        $node,
        'field_mollo_speciality',
        'mollo_speciality',
        true
      );
      $country = Helper::getFieldValue(
        $node,
        'field_mollo_country',
        'mollo_country',
        true
      );

      // Icon
      $icon = '';



      // Build Variables Array
      return [
        'id' => $client_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'function' => $function,
        'icon' => $icon,
        'position' => $position,
        'speciality' => $speciality,
        'image' => $title_image,
        'country' => $country,
      ];
    }

    return [];
  }

  public $group_by; // Clients group by Taxonomy

  /**
   * getRoleVars.
   *
   *    Bundle mollo_role
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_client    ( Entity: mollo_client )
   *    - field_mollo_calendar     ( Do not use )
   *    - field_mollo_description ( text long, formatted)
   *    - field_mollo_name      ( text )
   *
   *
   *
   * @param $role_id
   *
   * @return array|string[]
   *   Return Client Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getRoleVars($role_id): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($role_id);

    if (isset($node)) {
      // Get Field Values
      $name = Helper::getFieldValue($node, 'field_mollo_name');
      $client_id = Helper::getFieldValue($node, 'field_mollo_client');
      $description = Helper::getFieldValue($node, 'field_mollo_description');

      // Build Variables Array
      return [
        'id' => $role_id,
        'name' => $name,
        'description' => $description,
        'client_id' => $client_id
      ];
    }

    return [];
  }

  /**
   * getLeaderShipVars.
   *
   *    Bundle mollo_leadership
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_client    ( Entity: mollo_client )
   *    - field_mollo_calendars   ( Entity: mollo_calendar )
   *    - field_mollo_position ( Term: mollo_position)
   *
   *
   *
   * @param $leader_id
   *
   * @return array|string[]
   *   Return Client Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getLeaderShipVars($leader_id): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($leader_id);

    if (isset($node)) {
      // Get Field Values
      $position_id = Helper::getFieldValue($node, 'field_mollo_position');
      $client_id = Helper::getFieldValue($node, 'field_mollo_client');

      // Build Variables Array
      return [
        'id' => $leader_id,
        'position_id' => $position_id,
        'client_id' => $client_id
      ];
    }

    return [];
  }

  /**
   * @param $calendar_id
   * @param $vocabularies
   *
   * @param bool $musicians
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getClientsFromEvent($calendar_id, $musicians = FALSE): array
  {
    $all_clients = [];
    if($musicians){
      $field_calendar = 'field_mollo_calendar_orchestra';
    }else{
      $field_calendar = 'field_mollo_calendar';

    }

    // load all Node IDs from "mollo_client" with mollo_calendar ID
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_client')
      ->condition($field_calendar, $calendar_id)
      // Access
      ->accessCheck(false);

    $client_ids = $query->execute();

    // Nodes found
    if (count($client_ids) !== 0) {
      // Load all Clients
      foreach ($client_ids as $client_id) {
        // Output Array
        $all_clients[] = self::getVars($client_id);
      }
    }

    return $all_clients;
  }

  /**
   *
   *
   * @param array $clients
   * @param $vocabularies
   *
   * @param $function
   *
   * @return array
   */
  public static function getFilteredClient(
    array $clients,
    $vocabularies,
    $function
  ): array {
    // {# @var client \Drupal\mollo_calendar\Controller\ClientController #}

    switch ($function) {
      case 'musician': // TODO
        $needle = 'Orchester';
        $vocabulary = 'instrument';
        break;
      default:
        // default is singers
        $needle = 'Chor';
        $vocabulary = 'voice_position';
        break;
    }

    // Build Twig Array from Vocabularies
    $terms = [];
    $client_list = self::clientFilterFunction(
      $needle,
      $clients
    );

    foreach ($vocabularies[$vocabulary] as $term_id => $term_name) {
      $clients_filtered = self::clientFilterOrderByVoc(
        $term_name,
        $vocabulary,
        $needle,
        $clients
      );

      if (count($clients_filtered) > 0) {
        $terms[] = [
          'name' => $term_name,
          'clients' => $clients_filtered
        ];
      }
    }

    //  Group by Term
    $result['group_by'] = $terms;
    $result['clients'] = $client_list;
    //  Clients

    return $result;
  }

  /**
   *
   *
   * @param $term_name
   * @param $vocabulary
   * @param $needle
   * @param $clients
   *
   * @return array
   */
  public static function clientFilterOrderByVoc(
    $term_name,
    $vocabulary,
    $needle,
    $clients
  ): array {
    $results = [];
    $ids = [];
    foreach ($clients as $client) {
      foreach ($client['function'] as $function) {
        // Needle in Function (Choir, Orchestra, Leadership)
        if (in_array($needle, $client['function'], true)) {
          // term in Voc ( Voice Position, Instruments
          if (in_array($term_name, $client[$vocabulary], true)) {
            // Eliminate duplicates
            if (!in_array($client['id'], $ids, true)) {
              $ids[] = $client['id'];

              // Add filterd Client to Result
              $results[] = $client;
            }
          }
        }
      }
    }
    return $results;
  }

  /**
   *
   *
   * @param $term_name
   * @param $vocabulary
   * @param $needle
   * @param $clients
   *
   * @return array
   */
  public static function clientFilterFunction(
    $needle,
    $clients
  ): array {
    $results = [];
    $ids = [];
    foreach ($clients as $client) {
      foreach ($client['function'] as $function) {
        // Needle in Function (Choir, Orchestra, Leadership)
        if (in_array($needle, $client['function'], true)) {
            // Eliminate duplicates
            if (!in_array($client['id'], $ids, true)) {
              $ids[] = $client['id'];
              // Add filterd Client to Result
              $results[] = $client;
          }
        }
      }
    }
    return $results;
  }


  public static function getSoloClient(
    $calendar_id,
    array $clients,
    array $vocabularies
  ) {
    $solo_clients = [];
    $solo_clients_temp = [];
    $roles = [];

    // get all Roles for Event
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_role')
      ->condition('field_mollo_calendars', $calendar_id)
      // Access
      ->accessCheck(false);

    $role_ids = $query->execute();

    // Nodes found
    if (count($role_ids) !== 0) {
      // Load all Clients
      foreach ($role_ids as $role_id) {
        // Output Array
        $roles[] = self::getRoleVars($role_id);
      }
    }

    // Add Client to Roles
    foreach ($roles as $role) {
      // Search in Client
      foreach ($clients as $client) {
        // Find Client for Role
        if ($client['id'] === $role['client_id']) {
          // Add Role-Vars to Client
          $client['role_id'] = $role['id'];
          $client['role_name'] = $role['name'];
          $client['role_description'] = $role['description'];

          // Store Client in Solo Clients
          // Group Clients by Roles ( like Soldaten, Zofen, Grissetten)
          $role_group = $role['name'];
          $solo_clients_temp[$role_group][] = $client;
        }
      }
    }

    // Postprocessing
    // Add role_group 'solo' for Solo Clients
    $i = 0;
    foreach ($solo_clients_temp as $role_group) {
      $solo_clients[0]['name'] = 'solo';

      if (count($role_group) === 1) {
        $solo_clients[0]['clients'][] = $role_group[0];
      } else {
        foreach ($role_group as $client) {
          $solo_clients[$i]['name'] = $client['role_name'];
          $solo_clients[$i]['clients'][] = $client;
        }
      }
      $i++;
    }

    return $solo_clients;
  }

  public static function getLeaderShip(
    int $calendar_id,
    array $clients,
    array $vocabularies
  ) {
    $leadership = [];
    $solo_clients_temp = [];
    $leaders = [];

    // get all Roles for Event
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_calendar_leadership')
      ->condition('field_mollo_calendars', $calendar_id)
      // Access
      ->accessCheck(false);

    $leader_ids = $query->execute();

    // Nodes found
    if (count($leader_ids) !== 0) {
      // Load all Clients
      foreach ($leader_ids as $leader_id) {
        // Output Array
        $leaders[] = self::getLeaderShipVars($leader_id);
      }
    }

    // Add Client to Roles
    foreach ($leaders as $leader) {
      // Search in Client
      foreach ($clients as $client) {
        // Find Client for Role
        if ($client['id'] === $leader['client_id']) {
          // Get Name from Position Term
          if (isset($leader['position_id'])) {
            $client['position'] =
              $vocabularies['position'][$leader['position_id']];
          }

          // Add Role-Vars to Client
          $client['client_id'] = $leader['id'];

          // Store Client in Solo Clients
          // Group Clients by Roles ( like Soldaten, Zofen, Grissetten)
          $leadership[] = $client;
        }
      }
    }

    return $leadership;
  }
}
