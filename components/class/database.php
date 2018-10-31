<?php
class Database
{
    /**
     * @var string
     */
    private static $_password = 'hackathon';

    /**
     * @var string
     */
    private static $_user = 'mybrainydesk';

    /**
     * @var string
     */
    private static $_name = 'mybrainydesk';

    /**
     * @var string
     */
    private static $_server = 'localhost';

    /**
     * @var int
     */
    private static $_port = 3306;

    /**
     * @var PDO
     */
    private static $_bdd = null;

    public static function bdd()
    {
        if(self::$_bdd == null)
        {
            try {
                self::$_bdd = new PDO('mysql:dbname=' . self::$_name . ';host=' . self::$_server, self::$_user, self::$_password);
            }
            catch(Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$_bdd;
    }
}