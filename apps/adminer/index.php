<?php
function adminer_object() {
    // required to run any plugin
    include_once "./plugin.php";
    
    // autoloader
    foreach (glob("plugins/*.php") as $filename) {
        include_once "./$filename";
    }
    
    $plugins = array(
      // Write all plugin classes here.
    );
    
    $themes = array(
      new AdminerTheme(),
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    
    return new AdminerPlugin(array_merge($plugins, $themes));
}

// include original Adminer or Adminer Editor
include "./adminer.php";
?>