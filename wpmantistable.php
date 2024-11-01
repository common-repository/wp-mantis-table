<?php
/*
Plugin Name: WP Mantis Tables
Plugin URI: http://www.rtprime.net/wpplugins/wpmantistables
Description: A plugin to allow you to insert a table of open issues from a mantis bugtracker database into a page on your Wordpress blog.
Version: 0.1.0
Author: rtprime
Author URI: http://www.rtprime.net
  
    Copyright 2009 Robert Torres (e-mail: rtprime@mac.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Set up page filter - look for [MantisTable], If there, get the details for the table */

add_filter('the_content', 'mantistb_filter');

/* Set up options to be set */
function set_mantistb_options() {
        $options = array(
                'mantis_url' => 'http://issues.rtprime.net/api/soap/mantisconnect.php?wsdl',
                'mantis_user' => 'wordpress',
                'mantis_password' => 'myS3cretpa$$w0rd',
                'mantis_project_id' => 1,
                'mantis_base_url' => 'http://issues.rtprime.net',
                'mantis_statuses' => array(
                        '10' => 'NEW',
                        '20' => 'FEEDBACK',
                        '30' => 'ACKNOWLEDGED',
                        '40' => 'CONFIRMED',
                        '50' => 'ASSIGNED',
                        '80' => 'RESOLVED',
                        '90' => 'CLOSED'
                ),
                'mantis_colors' => array(
                        '10' => '#ffa0a0',
                        '20' => '#ff50a8',
                        '30' => '#ffd850',
                        '40' => '#ffffb0',
                        '50' => '#c8c8ff',
                        '80' => '#cceedd',
                        '90' => '#e8e8e8'
                ));

        add_option('mantis_options', $options);
}

function unset_mantistb_options() {
        delete_option('mantis_options');
}

register_activation_hook(__FILE__,'set_mantistb_options');
register_deactivation_hook(__FILE__,'unset_mantistb_options');

// Create the options page that will show on the dashboard
function admin_mantistb_options() {
?>

        <div class="wrap">
        <h2>WP Mantis Tables Configuration</h2>
        <?php
        if ($_REQUEST['submit']) {
                update_mantistb_options();
        }

        //Get the options already in the datbase
        $options = get_option('mantis_options');

        ?>
        <form method="post">
        <table class="form-table">
                <tr align="top"><th scope="row">URL to Mantis Connect WSDL:</th><td><input type="text" name="mantis_url" value="<?= $options['mantis_url'] ?>" size="45" /></td></tr>
                <tr align="top"><td colspan="2">The URL to MantisConnect should be the complete URL where you find the mantisconnect.php file.  You must make sure to end this url with ?wsdl or you'll get errors everywhere!</td></tr>

                <tr align="top"><th scope="row">Mantis Base URL:</th><td><input type="text" name="mantis_base_url" value="<?= $options['mantis_base_url'] ?>" size="45" /></td></tr>
                <tr align="top"><td colspan="2">The base URL to use to your homepage mantis installation (e.g. http://www.example.com/mantisbt)</td></tr>

                <tr align="top"><th scope="row">Mantis User:</th><td><input type="text" name="mantis_user" value="<?= $options['mantis_user'] ?>" /></td></tr>
                <tr align="top"><td colspan="2">This is the Mantis user you set up to identify your Wordpress installation - should have at least viewer/reporter abilities.</td></tr>

                <tr align="top"><th scope="row">Mantis Password:</th><td><input type="password" name="mantis_password" value="<?= $options['mantis_password'] ?>" /></td></tr>
                <tr align="top"><td colspan="2">Enter the password set up for the wordpress user listed above.</td></tr>

                <tr align="top"><th scope="row">Project ID</th><td><input type="text" name="mantis_project_id" value="<?= $options['mantis_project_id'] ?>" /></td></tr>
                <tr align="top"><td colspan="2">The project ID number for where the issues are from.  You can find this on the edit project page.</td></tr>
        </table>

        <h3>Colors and Statuses</h3>
        <p>Customize the status names and colors below:
        <table class="form-table">
                <tr align="top"><th>Code</th><th>Status</th><th>Color</th></tr>
                <tr><td>10</td><td><input type="text" name="status[10]" value="<?= $options['mantis_statuses'][10] ?>" /></td><td><input type="text" name="color[10]" value="<?= $options['mantis_colors'][10] ?>" /></td></tr>
                <tr><td>20</td><td><input type="text" name="status[20]" value="<?= $options['mantis_statuses'][20] ?>" /></td><td><input type="text" name="color[20]" value="<?= $options['mantis_colors'][20] ?>" /></td></tr>
                <tr><td>30</td><td><input type="text" name="status[30]" value="<?= $options['mantis_statuses'][30] ?>" /></td><td><input type="text" name="color[30]" value="<?= $options['mantis_colors'][30] ?>" /></td></tr>
                <tr><td>40</td><td><input type="text" name="status[40]" value="<?= $options['mantis_statuses'][40] ?>" /></td><td><input type="text" name="color[40]" value="<?= $options['mantis_colors'][40] ?>" /></td></tr>
                <tr><td>50</td><td><input type="text" name="status[50]" value="<?= $options['mantis_statuses'][50] ?>" /></td><td><input type="text" name="color[50]" value="<?= $options['mantis_colors'][50] ?>" /></td></tr>
                <tr><td>80</td><td><input type="text" name="status[80]" value="<?= $options['mantis_statuses'][80] ?>" /></td><td><input type="text" name="color[80]" value="<?= $options['mantis_colors'][80] ?>" /></td></tr>
                <tr><td>90</td><td><input type="text" name="status[90]" value="<?= $options['mantis_statuses'][90] ?>" /></td><td><input type="text" name="color[90]" value="<?= $options['mantis_colors'][90] ?>" /></td></tr>
        </table>
        <br />
        <input type="submit" class="button-primary" name="submit" value="<?= _e('Save Changes') ?>" />
        </form>         <?php
}

function update_mantistb_options() {
        $options = get_option('mantis_options');

        $options['mantis_user'] = $_REQUEST['mantis_user'];
        $options['mantis_pawword'] = $_REQUEST['mantis_password'];
        $options['mantis_url'] = $_REQUEST['mantis_url'];
        $options['mantis_project_id'] = $_REQUEST['mantis_project_id'];
        $options['mantis_base_url'] = $_REQUEST['mantis_base_url'];
        $options['mantis_statuses'] = $_REQUEST['status'];
        $options['matnis_colors'] = $_REQUEST['color'];

        update_option('mantis_options', $options);

        ?>
        <div id="message" class="updated fade">
        <p>Options saved.</p>
        </div>
        <?php
}

function modify_mantistb_menu() {
        add_options_page(
                          'WP Mantis Tables',
                          'WP Mantis Tables',
                          'manage_options',
                          __FILE__,
                          'admin_mantistb_options'
                        );
}

add_action('admin_menu', 'modify_mantistb_menu');

function mantistb_filter($content) {
        // Check content for instance of [MantisTable]
        if (strpos($content, "[MantisTable]") === false) {
		// Nothing to replace, so return the original content
		return $content;
	} else {
                // Get options
                $options = get_option('mantis_options');

                $mantis_username = $options['mantis_user'];
                $mantis_password = $options['mantis_password'];
                $mantis_project_id = $options['mantis_project_id'];
                $mantis_base_url = $options['mantis_base_url'];
                $mantis_url = $options['mantis_url'];

                $status = $options['mantis_statuses'];
                $colors = $options['mantis_colors'];

                //Check to see that the base URL ends with a trailing slash
                //if not, add it
                if (substr($mantis_base_url, -1, 1) != '/') { $mantis_base_url .= '/'; }

                $client = new SoapClient($mantis_url);
                $results = $client->mc_project_get_issues($mantis_username, $mantis_password, $mantis_project_id, 1, 100);

                $output = "<table border=\"1\" style=\"border-collapse:collapse\"><tr><td>ID #</td><td>Status</td><td>Category</td><td>Details</td></tr>\n";

                foreach ($results as $result) {
                        $id = $result->id;
                        $title = $result->summary;
                        $category = $result->category;
                        $priority = $result->priority->id;
                        $b_status = $result->status->id;
                        $b_status_name = $status[$b_status];
                        $description = $result->description;

                        $output .= "<tr bgcolor=\"{$colors[$b_status]}\"><td><a href=\"{$mantis_base_url}view.php?id={$id}\" target=\"_new\"s>{$id}</a></td><td>{$b_status_name}</td><td>{$category}</td><td><b>{$title}</b><br />{$description}</td></tr>\n";
                }
		
		// Close the table
                $output .= "</table>\n";
		
		//Now that we have the output, replace [MantisTable]
                $new_content = str_replace("[MantisTable]", $output, $content);
                echo $new_content;
       }   

}
?>
