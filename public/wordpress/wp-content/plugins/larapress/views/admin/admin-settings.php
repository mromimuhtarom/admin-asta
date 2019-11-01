<?php
use WPLaravelBoostrap\WPCore\WPoption;
use WPLaravelBoostrap\LaravelBootstrap\LoadLaravel;

$laravelRoot   = new WPoption('laravel_root');
$laravel = new LoadLaravel; 

$statusMsg = "";
$class = 'lara-press-success';
$nonce = $_REQUEST['_wpnonce'];


if (!empty($_POST['pluginOptionsSubmit'])) {
    if(!wp_verify_nonce( $nonce, 'lara-press' )) {
        exit('Nonce Invalid');
    }
    $optionValue = rtrim($_POST['laravel_root'], '/');
    $laravelRoot->setValue($optionValue);
    $laravelRoot->save();
    if(!file_exists($_POST['laravel_root'].'/bootstrap/autoload.php')){
        $class = 'lara-press-error';
        $statusMsg = __('Sorry this folder does contain a Laravel App.', 'lara-press');    
    }else{
        $statusMsg = __('Settings Saved', 'lara-press');    
    }    
}

$value = $laravelRoot->getValue() ?: $_SERVER['DOCUMENT_ROOT'];

?>
<style>
    .lara-press-status.{
    }
    .lara-press-success:before{
        color:#449d44;
    }
    .lara-press-error:before{
        color:#d9534f;
    }
</style>
<h1><?php _e('LaraPress Settings', 'lara-press');?></h1>
<p><?php _e('These are the settings for booting your Laravel application inside Wordpress. We assumed that your web server has access to the Laravel folder. So we suggest to install Laravel in the root and then Wordpress in the public folder as a subdirectory. You can then tweak your Apached or Nginx conf file to use subdomain if needed.', 'lara-press');?></p>
<form action="" method="post">
<?php wp_nonce_field('lara-press') ?>
<table class="form-table">
<tbody><tr>
    <th><label for="category_base"><?php _e('Laravel Root folder', 'lara-press');?></label></th>
    <td><input name="laravel_root" id="laravel_root" type="text" value="<?php echo $value; ?>" class="regular-text code">
    <p class="description"><?php _e('Make sure this is the root folder and not the public folder.', 'lara-press');?></p>
    </td>
</tr>

</tbody></table>
<p class="submit"><input id="pluginOptionsSubmit" name="pluginOptionsSubmit" type="submit" class="button button-primary" value="Save Changes"></p>
<p><?php echo $statusMsg;?><p>
<?php if($laravel->laravel_exists()){?>
<p class="lara-press-status lara-press-success dashicons-before dashicons-yes"> <?php _e('Laravel is currently bootstrapped correctly', 'lara-press');?></p>
<p><?php _e('You can now use Laravel Facades inside of your Wordpress Theme. Example', 'lara-press');?></p>
<textarea cols="50" rows="7" name="newcontent" id="newcontent" aria-describedby="newcontent-description">
  <?php echo "<?php";?>
  <?php echo "\nif (is_callable('Auth'))\n{";?>
  <?php echo "\n    Auth::check();";?>
  <?php echo "\n}";?>
  <?php echo "\n?>";?>
</textarea>
<p><?php _e('We always recommand to wrap these with a is_callable() condition to make sure you theme won\'t break if the plugin is disabled.', 'lara-press');?></p>
<?php }else{?>
<p class="lara-press-status lara-press-error dashicons-before dashicons-no-alt"> <?php _e('Laravel is not currently bootstrapped correctly', 'lara-press');?></p>
<?php }?>
</form>
