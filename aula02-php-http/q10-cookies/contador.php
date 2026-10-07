<?php
$visitas = (int) ($_COOKIE['visitas'] ?? 0) + 1;
setcookie('visitas', (string) $visitas, time() + 3600);
echo "Você visitou esta página $visitas vez(es)";
