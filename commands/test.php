<?php
require_once dirname(__DIR__)."/vendor/autoload.php";
use App\Sys\Config;


$page=1;?>
<?=($page!=1)? "?".Config::urlHelper("p",$page-1):"/" ?>