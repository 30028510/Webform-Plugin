<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Webform
 *
 * @wordpress-plugin
 * Plugin Name:       Webform
 * Plugin URI:        #
 * Description:       This is a Webform. Use shortcode [webform] for display table on page or post.
 * Version:           1.0.0
 * Author:            Akashdeep Sharma
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       #
 * Text Domain:       webform
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
    die();
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 
 * Rename this for your plugin and update it as you release new versions.
 */
define("WEBFORM_VERSION", "1.0.0");

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webform-activator.php
 */
function activate_webform()
{
    require_once plugin_dir_path(__FILE__) .
        "includes/class-webform-activator.php";
    Webform_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webform-deactivator.php
 */
function deactivate_webform()
{
    require_once plugin_dir_path(__FILE__) .
        "includes/class-webform-deactivator.php";
    Webform_Deactivator::deactivate();
}

register_activation_hook(__FILE__, "activate_webform");
register_deactivation_hook(__FILE__, "deactivate_webform");

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . "includes/class-webform.php";

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
add_action("admin_menu", "lead_admin_menu");

function lead_admin_menu()
{
    add_menu_page(
        "Lead  Page",
        "Leads",
        "manage_options",
        "Webform-Leads",
        "webform_admin"
    );
}

function webform_admin()
{
    echo "<h1>Leads</h1>";
    global $wpdb;

    $table_name = $wpdb->prefix . "leads";

    $user = $wpdb->get_results("SELECT * FROM $table_name");
    //print_r($user);
    ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><?php _e("Name"); ?></th>
      <th scope="col"><?php _e("Email"); ?></th>
      <th scope="col"><?php _e("Phone"); ?></th>
      <th scope="col"><?php _e("Service Required"); ?></th>
      <th scope="col"><?php _e("Date Submitted"); ?></th>
    </tr>
  </thead>
  <tbody>
    
   <?php foreach ($user as $row) { ?>
<tr>
   
    <td><?php echo $row->Name; ?></td>
    <td><?php echo $row->Email; ?></td>
    <td><?php echo $row->Phone; ?></td>
    <td><?php echo $row->Service_Required; ?></td>
    <td><?php echo $row->Date_Submission; ?></td>
</tr>
<?php }
}
?></tbody>
</table>
<?php
function run_webform()
{
    ?>
<div class="webform-body">
   <div id="webform-form">
      <!DOCTYPE html>
      <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <title>contact form</title>
      </head>
      <body>
         <h2 class="webform-h2">WEBFORM</h2>
         <p>We'd love to help,leave us your details and we'll be in touch.</p>
         <form id="web-form-id" class="web-form-class" method="post" action="#">
            <div class="webform-form-group">
               <label for="Name" class="webform-label">Name</label>
               <div class="webform-input-group">
                  <input type="text" id="Name" name="Name" class="webform-form-control" required>
               </div>
            </div>
            <div class="webform-form-group">
               <label for="Email" class="webform-label">Email</label>
               <div class="webform-input-group">
                  <input type="email" id="Email" name="Email" class="webform-form-control" required>
               </div>
            </div>
            <div class="webform-form-group">
               <label for="Phone" class="webform-label">Phone number</label>
               <div class="webform-input-group">
                  <input type="phone" id="Phone" name="Phone" class="webform-form-control" required>
               </div>
            </div>
            <div class="webform-form-group">
               <label for="Service" class="webform-label">Service required</label>
               <div class="webform-input-group">
                  <select name="Service" class="webform-form-control">
                     <option value="Electricity">Electricity</option>
                     <option value="Internet">Internet</option>
                     <option value="Solar">Solar</option>
                  </select>
               </div>
            </div>
            <div class="webform-form-group">
               <button type="submit" id="webform-button" class="webform-btn webform-btn-primary webform-btn-lg webform-btn-block">SUBMIT</button>
            </div>
         </form>
   </div>
</div>
<?php
date_default_timezone_set("NZ");
$date = date("Y-m-d H:i:s");
function enqueue_related_pages_scripts_and_styles()
{
    wp_enqueue_style("related-styles", plugins_url("/css/style.css", __FILE__));
    //  wp_enqueue_script('releated-script', plugins_url( '/js/custom.js' , __FILE__ ), array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'));
}
add_action("wp_enqueue_scripts", "enqueue_related_pages_scripts_and_styles");
?>

<style>
#webform-form {
    display:block;
}
#webform-button {
    background-color: #cd2653;
    border: 1px solid #cd2653;
}

.message-display {
    font-size: 25px;
    color: #cd2653;
    margin-top: 20px;
	width: 50%;
}
#webform-button {
    width: 18%;
    border-radius: 0px;
}
.webform-h2 {
    font-size: 40px;
    color: #cd2653;
}
.webform-body {
    width: 50%;
    text-align: ;
}
.webform-body {
    margin: 0;
    font-family: -apple-system, Arial, sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #f5efe0;
    padding: 30px;
    padding-bottom: 10px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    max-width: 100%;
}

.webform-form-group {
    margin-bottom: 1rem;
}

.webform-input-group {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 100%;
}

.webform-form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    outline: none;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.webform-form-control:focus {
    border: 1px solid #313131;
}

select.webform-form-control[size], select.webform-form-control[multiple] {
    height: auto;
}

label.webform-label {
    display: inline-block;
    margin-bottom: 0.5rem;
}

.webform-credit {
    padding-top: 10px;
    font-size: 0.9rem;
    color: #545b62;
}

.webform-credit a {
    color: #545b62;
    text-decoration: underline;
}

.webform-credit a:hover {
    color: #0056b3;
    text-decoration: underline;
}

.webform-btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .webform-btn {
        transition: none;
    }
}

.webform-btn:hover {
    color: #212529;
    text-decoration: none;
}

.webform-btn:focus, .webform-btn.focus {
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.webform-btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.webform-btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}

.webform-btn-primary:focus, .webform-btn-primary.focus {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
}

.webform-btn-lg, .webform-btn-group-lg>.webform-btn {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: 0.3rem;
}

.webform-btn-block {
    display: block;
    width: 100%;
}

.webform-btn-block+.webform-btn-block {
    margin-top: 0.5rem;
}

input[type="submit"].webform-btn-block, input[type="reset"].webform-btn-block, input[type="button"].webform-btn-block {
    width: 100%;
}
</style>
<?php if (isset($_POST["Email"])) {

    // validation expected data exists
    if (
        !isset($_POST["Name"]) ||
        !isset($_POST["Email"]) ||
        !isset($_POST["Phone"]) ||
        !isset($_POST["Service"])
    ) {
        problem(
            "We are sorry, but there appears to be a problem with the form you submitted."
        );
    }

    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $Phone = $_POST["Phone"];
    $Service = $_POST["Service"];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .=
            "The Email address you entered does not appear to be valid.<br>";
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .=
            "The Name you entered does not appear to be valid.<br>";
    }
    $string_exp = "/^[1-9][0-9]{10}$/";
    if (!preg_match($string_exp, $Phone)) {
        $error_message .=
            "The Phone you entered does not appear to be valid.<br>";
    }

    $email_message = "Form details below.\n\n";
    global $wpdb;
    $tablename = $wpdb->prefix . "Leads";

    $date = date("m/d/Y h:i:s a", time());

    $wpdb->insert(
        $tablename,
        [
            "Name" => $name,
            "Email" => $email,
            "Phone" => $Phone,
            "Service_Required" => $Service,
            "Date_Submission" => $date,
        ],
        ["%s", "%s", "%s", "%s", "%s"]
    );
    ?>
		    <!-- include your success message below -->

<h2 class="message-display">  Thank you for contacting us. We will be in touch with you very soon. </h2>
   <?php
}
}
add_shortcode("webform", "run_webform");

?>
