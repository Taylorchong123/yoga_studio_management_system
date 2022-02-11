<?php
include '../../../structure/structure.php';
class gallery_function
{
    private $conn;
    private $structure;
    // constructor
    public function __construct()
    {
        require_once '../../DB_Connect.php';
        // connecting to database
        $db              = new Db_Connect();
        $this->conn      = $db->connect();
        $this->structure = new Structure_object();
    }

    // destructor
    public function __destruct()
    {

    }

    /**
     * read function
     * */
    public function read($merchant_id, $type)
    {
        $stmt = $this->conn->prepare("SELECT path, display_type, type, gallery_id, size FROM tb_gallery WHERE soft_delete = '' AND merchant_id = '$merchant_id' AND type = '$type'");
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }
        $result = $stmt->execute();

        if ($result) {
            //set up bind result
            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field()) {
                $params[] = &$row[$field->name];
            }
            $return_arr = $this->structure->bindResult($stmt, $params, $row);
        }

        return (sizeof($return_arr) > 0 ? $return_arr : false);
    }

    /**
     * create function
     * */
    public function create($params)
    {
        $return_arr = array();
        $stmt       = $this->conn->prepare('INSERT INTO tb_gallery(created_at, path, display_type, type, merchant_id) VALUES (?, ?, ?, ?, ?)');
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }
        //bind param
        return $this->structure->bindParam($stmt, $params);
    }

    /**
     * update function
     * */
    public function update($params)
    {
        $stmt = $this->conn->prepare('UPDATE tb_gallery SET updated_at = ?, path = ?, display_type = ?, type = ?, merchant_id = ? WHERE gallery_id = ?');
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }
        //bind param
        return $this->structure->bindParam($stmt, $params);
    }

    /**
     * delete function
     * */
    public function delete($params)
    {
        $stmt = $this->conn->prepare('UPDATE tb_gallery SET soft_delete = ? WHERE gallery_id = ?');
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }

        //bind param
        return $this->structure->bindParam($stmt, $params);
    }
    /**
     * get path from gallery id
     * */
    public function getPath($gallery_id)
    {
        $stmt = $this->conn->prepare("SELECT path,merchant_id FROM tb_gallery WHERE  gallery_id = '$gallery_id'");
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }
        $result = $stmt->execute();

        if ($result) {
            //set up bind result
            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field()) {
                $params[] = &$row[$field->name];
            }
            $return_arr = $this->structure->bindResult($stmt, $params, $row);
        }

        return (sizeof($return_arr) > 0 ? $return_arr : false);
    }

    public function delete_link_gallery($params)
    {
        $stmt = $this->conn->prepare('UPDATE tb_display_link_gallery SET soft_delete = ? WHERE gallery_id = ?');
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }
        //bind param
        return $this->structure->bindParam($stmt, $params);
    }

    public function update_display_type($params)
    {
        $stmt = $this->conn->prepare('UPDATE tb_gallery SET updated_at = ?, display_type = ? WHERE gallery_id = ?');
        //error reporting
        if (!$stmt) {
            die('prepare() failed: ' . htmlspecialchars($this->conn->error));
        }
        //bind param
        return $this->structure->bindParam($stmt, $params);
    }

}

