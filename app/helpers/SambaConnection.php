<?php

namespace helpers;

class SambaConnection{

    private $domain;

    private $host;

    private $password;

    private $share;

    private $username;

    public function __construct($host, $share, $username, $password, $domain = '')
    {
        $this->username = $username;
        $this->password = $password;
        $this->domain = $domain;
        $this->host = $host;
        $this->share = $host;
    }

    public function execute($command, &$output = null)
    {
        $cmd = "smbclient '\\\\{$this->host}\\{$this->share}' $this->password -U $this->username -W $this->domain -c '$command' 2>&1";
        exec($cmd, $output, $return);

        if($return === 1){
            $errmessage = sprintf("Host: %s / Share: %s / Username: %s / Domain: %s / Error Message: %s",
                $this->host,
                $this->share,
                $this->username,
                $this->domain,
                implode(" ", $output)
            );
            throw new \Exception($errmessage);
        }

        return $return;
    }

    public function getFromRemotePath($remote_path, $local_file = '.')
    {
        $remote_path = str_replace("/", "\\", $remote_path);
        $this->execute('get "'.$remote_path.'" "'.$local_file.'"', $output);
        return $output;
    }
}