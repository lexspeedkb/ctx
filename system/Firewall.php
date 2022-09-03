<?php
namespace system;

use App\Controllers\Api\BaseApiController;

class Firewall
{
    const CONNECTIONS_LIMIT_PER_MINUTE = 100;

    /**
     * @return void
     *
     * Close connection, if too many requests
     */
    public static function connection(): void
    {
        global $env;
        $time = date('Y-m-d H:i:00');
        $ip = $_SERVER['REMOTE_ADDR'];

        $ipd = str_replace('.', '', $ip);

        $BaseModel = new BaseModel();

        $connection = $BaseModel->db->query("SELECT * FROM connections WHERE ip=$ipd ")->fetchArray();

        if (sizeof($connection) === 0) {
            $BaseModel->db->query("INSERT INTO connections (ip, connections_minute, last_connection) VALUES ('$ipd', 0, '$time')");
        } else {
            if ($connection['last_connection'] != $time) {
                $connections = 0;
            } else {
                $connections = $connection['connections_minute'] + 1;

                if ($connections > $env['firewall.requests_per_minute']) {
                    $BaseApiController = new BaseApiController();
                    $BaseApiController->respond('Too many requests', 429);
                }
            }
            $BaseModel->db->query("UPDATE connections SET connections_minute=$connections, last_connection='$time' WHERE ip=$ipd");
        }
    }
}