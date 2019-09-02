<?php

namespace App\Model;

use Core\Database;

class UzduotisModel
{
    public function __construct()
    {
        $this->db = new Database();
    }

    private $timestamp;
    private $folder;
    private $resume;
    private $target;
    private $type;
    private $extension;
    private $size;
    private $max_size = 3145728;
    private $name;
    private $email;
    private $phone;
    private $jobid;
    private $jobtitle;
    private $coverletter;
    private $error = array();

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getFolder()
    {
        return $this->folder;
    }

    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    public function getResume()
    {
        return $this->resume;
    }

    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getMaxSize()
    {
        return $this->max_size;
    }

    public function setMaxSize($max_size)
    {
        $this->max_size = $max_size;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getJobid()
    {
        return $this->jobid;
    }

    public function setJobid($jobid)
    {
        $this->jobid = $jobid;
    }

    public function getJobtitle()
    {
        return $this->jobtitle;
    }

    public function setJobtitle($jobtitle)
    {
        $this->jobtitle = $jobtitle;
    }

    public function getCover()
    {
        return $this->coverletter;
    }

    public function setCover($cover)
    {
        $this->coverletter = $cover;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function save()
    {
        $this->create();
    }

    public function create()
    {
        $fields = 'name, email, phone, jobid, jobtitle, coverletter, resume';
        $values = "'" .$this->name. "','" .$this->email. "','" .$this->phone.  "','" .$this->jobid.  "','" .$this->jobtitle.  "','" .$this->coverletter.  "','" .$this->resume. "'";
        //debug($values);
        $this->db->insert('uzduotis', $fields, $values);
        return $this->db->get();
    }

}