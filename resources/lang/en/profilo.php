<?php

    return [
        'navbar' => 'Profile',
        'informazioni' => [
            'title' => 'Personal information',
            'description' => 'Update the profile information of your account and the email address',
            'name' => 'Name',
            'email' => 'Email',
            'save_button' => 'Save changes',
        ],
        'update_password' => [
            'title' => 'Update password',
            'description' => 'Make sure your account is used with a secure and up-to-date password',
            'current_password' => 'Current password',
            'new_password' => 'New password',
            'confirm_password' => 'Confirm password',
            'save_button' => 'Save password',
        ],
        '2fa' => [
            'title' => 'Two-factor authentication',
            'description' => 'Add an additional security layer to your account using Google Authenticator two-factor authentication',
            'enable_button' => 'Enable 2FA',
            'disable_button' => 'Disable 2FA',
        ],
        'delete_account' => [
            'title' => 'Delete account',
            'description' => 'Permanently delete your account and all associated data. This action is irreversible. Before proceeding, make sure you have backed up all the data you want to keep.',
            'delete_button' => 'Delete account',
            'modal' => [
                'title' => 'Are you sure you want to delete your account?',
                'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
                'cancel_button' => 'Cancel',
            ]
        ],
    ];
