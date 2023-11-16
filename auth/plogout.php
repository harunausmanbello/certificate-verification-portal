<?php

require_once('core/usercore.php');

session_regenerate_id();

session_destroy();

header('Location: /logout');