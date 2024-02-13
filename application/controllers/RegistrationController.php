<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistrationController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('registrationAdminModel');
        $this->load->helper('url');
    }

    public function create_admin() {
        // Retrieve the raw JSON data from the request body
        $post_data = json_decode(file_get_contents('php://input'), true);

        // Debugging: Print the received data
        var_dump($post_data); // Check if data is received correctly

        if (empty($post_data)) {
            // If no data received, return an error response
            $response = array('status' => 'error', 'message' => 'No data received');
        } else {
            // Prepare the data for insertion into the database
            $data = array(
                'FirstName' => $post_data['FirstName'],
                'MiddleName' => $post_data['MiddleName'],
                'LastName' => $post_data['LastName'],
                'Address' => $post_data['Address'],
                'MailID' => $post_data['MailID'],
                'Phone' => $post_data['Phone'],
                'AlternatePhoneNumber' => $post_data['AlternatePhoneNumber'],
                'Password' => $post_data['Password']
            );

            // Debugging: Print the data to be inserted
            var_dump($data); // Check if data is formatted correctly

            // Attempt to save the admin data
            $result = $this->registrationAdminModel->save_admin($data);

            if ($result) {
                $response = array('status' => 'success', 'message' => 'Admin saved successfully');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to save admin');
            }
        }

        // Send the response as JSON
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }
}
?>
