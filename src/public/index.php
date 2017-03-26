<?php
/**
 * Created by DoAnChuyenNganhTeam.
 * User: TungHH
 * Date: 03/15/2017
 * Time: 3:22 PM
 */
use fonda\controller\LoginController;
use fonda\controller\RegisterController;
use fonda\controller\ResendPasswordController;
use fonda\controller\TestController;
use fonda\controller\VerifyAccountController;
use fonda\Program;

require_once ('include/Program.php');
require_once ('include/controller/_loader.php');

$program = Program::instance();
$program->registerHandler(new RegisterController());
$program->registerHandler(new TestController());
$program->registerHandler(new VerifyAccountController());
$program->registerHandler(new LoginController());
$program->registerHandler(new ResendPasswordController());
$program->start();
