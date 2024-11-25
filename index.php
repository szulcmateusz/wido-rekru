<?php
require_once 'vendor/autoload.php';
require_once './classes/Render.php';

session_start();
Render::renderTemplate();