<?php defined('APPLICATION') or die;

$PluginInfo['RedirectAfterRegistration'] = array(
    'Name' => 'Redirect After Registration',
    'Description' => 'Redirects newly registered users to custom url.<br>Beautiful icon sponsored gracefully by <a href="http://vanillaforums.org/profile/4038/phreak">phreak</a> of <a href="http://vanillaskins.com">VanillaSkins.com</a>.',
    'Version' => '0.2',
    'Author' => 'Robin Jurinka',
    'SettingsUrl' => '/dashboard/settings/redirectafterregistration',
    'SettingsPermission' => 'Garden.Settings.Manage',
    'License' => 'MIT'
);

class RedirectAfterRegistrationPlugin extends Gdn_Plugin {
    // provide basic setup screen
    public function settingsController_redirectafterregistration_create ($sender) {
        $sender->Permission('Garden.Settings.Manage');
        $sender->SetData('Title', T('Redirect After Registration Settings'));
        $sender->AddSideMenu('dashboard/settings/plugins');
        $conf = new ConfigurationModule($sender);
        $conf->Initialize(array(
            'Plugins.RedirectAfterRegistration.Route' => array(
                'Control' => 'TextBox',
                'Description' => T('Where should new users be redirected to, after they have registered?')  
            )
        ));
        $conf->RenderAll();
    }

    // redirect user after successful registration
    public function entryController_registrationSuccessful_handler ($sender) {
        $sender->Form->SetFormValue(
            'Target',
            C('Plugins.RedirectAfterRegistration.Route', '/')
        );
    }
}
