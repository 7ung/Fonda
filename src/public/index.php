<?php
/**
 * Created by DoAnChuyenNganhTeam.
 * User: TungHH
 * Date: 03/15/2017
 * Time: 3:22 PM
 */
use fonda\controller\RegisterController;
use fonda\controller\TestController;
use fonda\Program;

require_once ('include/Program.php');
require_once ('include/controller/RegisterController.php');
require_once ('include/controller/TestController.php');

$program = Program::instance();
$program->registerHandler(new RegisterController());
$program->registerHandler(new TestController());
$program->start();
