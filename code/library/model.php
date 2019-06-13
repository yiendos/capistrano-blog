<?php

namespace Capistrano\Blog;

class Model
{
    private $_conn;

    private  $_defaults = array(
        'database' => 'sites_capistrano-blog',
        'user' => 'root',
        'password' => 'root',
        'host' => '127.0.0.1:3306');

    private $_state = array(
        'name' => '',
        'username' => '',
        'email' => '',
        'password' => ''
    );

    /**
     * This is where we configure our db connection.
     * configuration can be passed in to change the default values given above
     * __construct functions always get parsed first
     * @param array $config
     */
    public function __construct($config = array())
    {
        $config = (object) array_merge($this->_defaults, $config);

        $this->_conn = mysqli_connect($config->host, $config->user, $config->password, $config->database);
    }

    /**
     * Take the controller request and make state or data the model can work with
     * First we filter any nasties
     * Lastly we escape to ensure SQL safe strings
     * @param $request
     */
    public function setState($request)
    {
        $query_id = $request->query->filter('id', '', FILTER_SANITIZE_NUMBER_INT);
        $id = mysqli_real_escape_string($this->_conn, $query_id);

        foreach($this->_state as $key => $value)
        {
            $value = $request->request->filter($key, '');
            $this->_state[$key] =  mysqli_real_escape_string($this->_conn, $value);
        }

        $this->_state['id'] = $id;
    }

    /**
     * Bring back all user records
     * @return array
     */
    public function actionFetch()
    {
        $result = $this->query("SELECT * FROM `j_users`;");

        $rows = array();

        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Return a single row
     * @return array
     */
    public function actionGet()
    {
        $id = $this->_state['id'];

        $result = $this->query("SELECT * FROM `j_users` WHERE `id` = '$id';");

        return $result->fetch_all();

    }

    /**
     * Here we save the records to the database
     * isNew == true then we INSERT
     * isNew == false then we UPDATE
     */
    public function actionSave()
    {
        $isNew = ($this->_state['id'] == 0) ? true : false;

        $state = (object) $this->_state;

        if ($isNew) {
            $sql = "INSERT INTO `users` (`name`, `username`, `email`, `password`) VALUES('$state->name', '$state->email', '$state->username', '$state->password')";
        } else {
            $sql = "UPDATE `users` SET `name` = '$state->name', `email` = '$state->email', `username` = '$state->username', `password` = '$state->password' WHERE `id` = '$state->id'";
        }

        $this->query($sql);
    }

    /**
     * Here we can delete records
     * important that we have an id or we could delete everything
     */
    public function actionDelete()
    {
        $id = $this->_state['id'];

        if ($id)
        {
            $sql = "DELETE FROM `users` WHERE `id` = '$id'";

            $this->query($sql);
        }
    }

    /**
     * a Reusable way to query the database
     * @param $query
     * @return bool|mysqli_result
     */
    public function query($query)
    {
        return $this->_conn->query($query);
    }
}