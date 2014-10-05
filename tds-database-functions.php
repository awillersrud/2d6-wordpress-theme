<?php
/**
 *
 */

include 'tds-database-base-custom-data.php';

global $tds_tournament_db_version;
$tds_tournament_db_version = "0.1.3";

class Table extends Base_Custom_Data {
    public function __construct($tableName)
    {
        global $wpdb;
        parent::__construct($wpdb->prefix . $tableName);
    }
}

global $TournamentResultCategory;
global $TournamentResult;
global $Tournament;
global $Player;
$Tournament = new Table("tournament");
$Player = new Table("player");
$TournamentResult = new Table("tournament_result");
$TournamentResultCategory = new Table("tournament_result_category");

class Tournament {
    private static $table_name = "tournament";
    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . self::$table_name;
    }
    public $id;
    public $location;
    public $name;
    public $from;
    public $to;
    public $max_players;
    public $contact_email;
    public $registration_notice;
    public function to_insert_array() {
        return array(
            'tournament_name' => $this->name,
            'location' => $this->location,
            'from_date' => $this->from,
            'to_date' => $this->to,
            'max_players' => $this->max_players,
            'contact_email' => $this->contact_email,
            'registration_notice' => $this->registration_notice
        );
    }
    public static function from_db_array($db_array) {
        $tournament = new Tournament();
        $tournament->id = $db_array["id"];
        $tournament->location = $db_array["location"];
        $tournament->name = $db_array["tournament_name"];
        $tournament->from = $db_array["from_date"];
        $tournament->to = $db_array["to_date"];
        $tournament->max_players = $db_array["max_players"];
        $tournament->contact_email = $db_array["contact_email"];
        $tournament->registration_notice = $db_array["registration_notice"];
        return $tournament;
    }
}

class Player {
    public static $table_name = "player";
    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . self::$table_name;
    }
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $user_id;
    public $army;
    public $tournament_id;
    public $registered;
    public function displayName() {
        return $this->first_name . " " . $this->last_name;
    }
    public function to_insert_array() {
        return array(
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'user_id' => $this->user_id,
            'army' => $this->army,
            'tournament_id' => $this->tournament_id,
            'registered' => $this->registered
        );
    }
    public static function from_db_array($db_array) {
        $player = new Player();
        $player->id = $db_array["id"];
        $player->first_name = $db_array["first_name"];
        $player->last_name = $db_array["last_name"];
        $player->email = $db_array["email"];
        $player->army = $db_array["army"];
        $player->user_id = $db_array["user_id"];
        $player->tournament_id = $db_array["tournament_id"];
        $player->registered = $db_array["registered"];
        return $player;
    }
}
class TurneringResultatKategori {
    private static $table_name = "turnering_resultat_kategori";
    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . self::$table_name;
    }
    private $id;
    private $navn;
    private $teller_mot_endelig_resultat;
    public function to_insert_array() {
        return array(
            'navn' => $this->navn,
            'teller_mot_endelig_resultat' => $this->teller_mot_endelig_resultat
        );
    }
    public static function from_db_array($db_array) {
        $kategori = new TurneringResultatKategori();
        $kategori->id = $db_array["id"];
        $kategori->navn = $db_array["navn"];
        $kategori->teller_mot_endelig_resultat = $db_array["teller_mot_endelig_resultat"];
    }
}
class TurneringResultat {
    private static $table_name = "turnering_resultat";
    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . self::$table_name;
    }
    public $id;

    public function to_insert_array() {
        return array(
            'navn' => $this->navn,
            'teller_mot_endelig_resultat' => $this->teller_mot_endelig_resultat
        );
    }
    public static function from_db_array($db_array) {

    }

}

function get_tournament($tournament_id) {
    global $wpdb;
    $query = "SELECT * FROM " . Tournament::table_name() . " WHERE id = $tournament_id";
    $row = $wpdb->get_row($query, ARRAY_A);

    return Tournament::from_db_array($row);
}

function get_tournaments() {
    global $wpdb;
    $tournament_db_arrays = $wpdb->get_results("SELECT * FROM " . Tournament::table_name(), ARRAY_A);

    $result = array();
    foreach ($tournament_db_arrays as $db_array ) {
        array_push($result, Tournament::from_db_array($db_array));
    }
    return $result;
}

function get_tournament_players($tournament_id) {
    global $wpdb;
    $resultset = $wpdb->get_results("SELECT * FROM " . Player::table_name() .
        " WHERE tournament_id = " . $tournament_id . " ORDER BY registered", ARRAY_A);

    $result = array();
    foreach ($resultset as $row_array) {
        array_push($result, Player::from_db_array($row_array));
    }
    return $result;
}

function er_paameldt($user_id, $tournament_id) {
    global $wpdb;
    $query_result = $wpdb->get_var("select user_id from " . Player::table_name() . " p where p.user_id = $user_id and p.tournament_id = $tournament_id");
    return $query_result == $user_id;
}

function insert_player($first_name, $last_name, $email, $army, $user_id, $tournament_id) {
    global $wpdb;
    $player = new Player();
    $player->first_name = $first_name;
    $player->last_name = $last_name;
    $player->email = $email;
    $player->army = $army;
    $player->registered = date_format(new DateTime(), 'Y-m-d');
    $player->user_id = $user_id;
    $player->tournament_id = $tournament_id;

    $wpdb->insert(Player::table_name(), $player->to_insert_array());
}
function insert_tournament(Tournament $tournament) {
    global $wpdb;

    $wpdb->insert(Tournament::table_name(), $tournament->to_insert_array());
}

function get_final_standing(Tournament $tournament) {
    global $wpdb;

    $query = "select concat(p.first_name, ' ', ifnull(last_name, '')) as player_name, battle_points, painting_score,
              battle_points + painting_score as total, army
              from wp_player p
              where p.tournament_id = $tournament->id
              order by (battle_points + ifnull(painting_score,0)) desc, battle_points desc";

    return $wpdb->get_results($query);
}



if ( !function_exists('wp_new_user_notification') ) :

    /**
     * Notify the blog admin of a new user, normally via email.
     *
     * @since 2.0
     *
     * @param int $user_id User ID
     * @param string $plaintext_pass Optional. The user's plaintext password
     */
function wp_new_user_notification($user_id, $plaintext_pass = '') {
        $user = get_userdata( $user_id );

        // The blogname option is escaped with esc_html on the way into the database in sanitize_option
        // we want to reverse this for the plain text arena of emails.
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        $message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user->user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = sprintf(__('Brukernavn: %s'), $user->user_login) . "\r\n";
        $message .= sprintf(__('Passord: %s'), $plaintext_pass) . "\r\n";
        $message .= wp_login_url() . "\r\n";

        wp_mail($user->user_email, sprintf(__('[%s] Ditt brukernavn og passord'), $blogname), $message);

    }
endif;
?>