<?php

    return [
        'menu' => 'Users',
        'title' => 'Users',
        'welcome_msg' => 'Welcome to the users section',
        'search_input_label' => 'Search user for surname or email',
        'search_input_button' => 'Search',
        'search_input_alert_charachters' => 'Enter at least 4 characters',
        'search_input_alert_no_results' => 'No users found',
        'search_input_alert_error_title' => 'Error',
            'table' => [
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'role' => 'Role',
            'edit_button' => 'Details',
            'add_button' => 'Add user',
        ],
        'create' => [
            'title' => 'Add user',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm password',
            'role' => 'Role',
            'submit' => 'Save user',
        ],
        'edit' => [
            'title' => 'Edit user',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm password',
            'role' => 'Role',
            'submit' => 'Update user',
            'informazioni_title' => 'User Information',
            'informazioni_subtitle' => 'Update user profile information',
            'password_title' => 'Change Password',
            'password_subtitle' => 'Change user password. Ensure that the password is at least 8 characters long.',
            'delete_title' => 'Delete User',
            'delete_subtitle' => 'Permanently delete your account and all associated data. This action is irreversible. Before proceeding, make sure you have backed up all data you wish to keep.',
            'delete_modal_title' => 'Are you sure you want to delete this account?',
            'delete_modal_subtitle' => 'Once you delete this account, there is no going back. Please be certain.',
            'additional_info_title' => 'Additional Information',
            'additional_info_subtitle' => 'Additional user profile data',
        ],
        '2fa' => [
            'disable_message' => 'Disable two-factor authentication for this user',
        ]
    ];
