<?php

declare(strict_types=1);

namespace LKSS;

use LKSS\Network\Server;
use LKSS\Network\Socket;

require_once 'vendor/autoload.php';

//(new Server(new Socket()))->start();

$app = new App();
$app->run();
