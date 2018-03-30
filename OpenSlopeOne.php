<?php
/**
 * OpenSlopeOne Class File
 * 
 * This is the main file of openslopeone
 * @author Chaoqun Fu <fuchaoqun@gmail.com>
 * @version 1.0
 * @since 2008-09-10
 * @copyright Chaoqun Fu <fuchaoqun@gmail.com>
 * @license GPL V3 
 */

set_include_path('./inc');

require_once 'Zend/Db.php';
require_once 'Zend/Loader.php';

class OpenSlopeOne
{
    /**
     * Database link
     *
     * @var resource
     */
    var $_db;
    
    /**
     * Config
     *
     * @var array
     */
    private $_config;
    
    /**
     * Counstuctor
     *
     * @param array $config
     */
    function __construct($config = '')
    {
        /**
         * Init config
         */
        empty($config) ? $this->initConfig() : $this->_config = $config;
        
        /**
         * Init database link
         */
        $this->_initDb();
    }
    
    /**
     * Init database link
     *
     * @param array $config
     * @return resource
     */
    private function _initDb()
    {
        /**
         * Singleton Pattern
         */
        if (is_resource($this->_db)) return $this->_db;
        
        /**
         * Init database config
         */
        $config = array(
            'host' => $this->_config['host'],
            'username' => $this->_config['username'],
            'password' => $this->_config['password'],
            'dbname' => $this->_config['dbname'],
            'port' => $this->_config['port']
        );        
        $adapter = $this->_config['adapter'];
        
        /**
         * Factory Pattern
         */
        $this->_db = Zend_Db::factory($adapter, $config);
        
        return $this->_db;
    }
    
    /**
     * Init config
     *
     * @param string $configIniFile
     */
    public function initConfig($configIniFile = './config.ini.php')
    {
        $this->_config = parse_ini_file($configIniFile);
    }
    
    /**
     * Init SlopeOneTable
     *
     * Use factory pattern
     * Specify the mode use 'PHP' or 'MySQL'
     * If you user 'PHP' mode, it's a pure php implementation, and it might be very slow
     * You can use 'MySQL' mode, it's based on mysql procedure, and it will be mutch faster.
     * @param string $factory
     */
    public function initSlopeOneTable($factory = 'PHP')
    {
        set_time_limit(0);
        
        /**
         * If the mode is not PHP or MySQL, then it will be set as 'PHP'
         */
        ($factory != 'PHP' && $factory != 'MySQL') && ($factory = 'PHP');
        
        /**
         * Delete all the data of oso_slope_one
         */
        $this->_db->query('TRUNCATE TABLE `oso_slope_one`');
        
        /**
         * Form the function
         */
        $func = '_initSlopeOneTableBy' . $factory;
        
        /**
         * Execute the function
         */
        $this->$func();
    }
    
    /**
     * Init SlopeOneTable By PHP
     *
     * A pure php implementation, use it just for fun.
     */
    private function _initSlopeOneTableByPHP()
    {        
        /**
         * Get distinct show_id
         */
        $sql = 'SELECT DISTINCT show_id FROM oso_user_ratings';
        $rs = $this->_db->query($sql);
        while ($itemId = $rs->fetchColumn())
        {
            $slopeOneSql = 'insert into oso_slope_one (select a.show_id as show_id1,b.show_id as show_id2,count(*) as times, sum(a.rating-b.rating) as rating from oso_user_ratings a,oso_user_ratings b where a.show_id = '
                         . $itemId
                         .' and b.show_id != a.show_id and a.email=b.email group by a.show_id,b.show_id)';
            $this->_db->query($slopeOneSql);
        }
    }
    
    /**
     * Init SlopeOneTable By MySQL
     *
     * A MySQL procedure implementation, use it in production environment
     * You can also call the procedure in shell
     */
    private function _initSlopeOneTableByMySQL()
    {
        if (!$this->_hasProcedure())
        {
            $this->_createProcedure();
        }
        $this->_db->query('call slope_one');
    }
    
    /**
     * Check if exists the procedurn
     *
     * @return boolean
     */
    private function _hasProcedure()
    {
        $sql = 'show procedure status where Db = "' . $this->_config['dbname'] . '" and name= "slope_one"';
        
        return $this->_db->fetchCol($sql) ? true : false;
    }
    
    /**
     * Create procedure
     *
     */
    private function _createProcedure()
    {
        $sql = '
            CREATE PROCEDURE `slope_one`()
                begin                    
                    DECLARE tmp_show_id int;
                    DECLARE done int default 0;                    
                    DECLARE mycursor CURSOR FOR select distinct show_id from oso_user_ratings;
                    DECLARE CONTINUE HANDLER FOR NOT FOUND set done=1;
                    open mycursor;
                    while (!done) do
                        fetch mycursor into tmp_show_id;
                        if (!done) then
                            insert into oso_slope_one (select a.show_id as show_id1,b.show_id as show_id2,count(*) as times, sum(a.rating-b.rating) as rating from oso_user_ratings a,oso_user_ratings b where a.show_id = tmp_show_id and b.show_id != a.show_id and a.email=b.email group by a.show_id,b.show_id);
                        end if;
                    END while;
                    close mycursor;
                end
        ';
        $this->_db->query($sql);
    }
    
    /**
     * Get recommended items by item's id 
     *
     * @param int $itemId
     * @param int $limit
     * @return array
     */
    public function getRecommendedItemsById($itemId, $limit = 20)
    {
        $sql = 'select show_id2 from oso_slope_one where show_id1 = '
             . $itemId
             . ' group by show_id2 order by sum(rating/times) limit '
             . $limit;
        return  $this->_db->fetchCol($sql);
    }
    
    /**
     * Get recommended items by user's id
     *
     * @param int $userId
     * @param int $limit
     * @return array
     */
    public function getRecommendedItemsByUser($userId, $limit = 20)
    {
        $sql = 'select s.show_id2 from oso_slope_one s,oso_user_ratings u where u.email = '
             . '\''
             . $userId
             . '\''
             . ' and s.show_id1 = u.show_id and s.show_id2 != u.show_id group by s.show_id2 order by sum(u.rating * s.times - s.rating)/sum(s.times) desc limit '
             . $limit;
         return  $this->_db->fetchCol($sql);
    }
}
?>