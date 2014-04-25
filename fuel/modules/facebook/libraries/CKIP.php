<?php

class Term {

    public $term;
    public $tag;

}

class CKIP {

    public $username;
    public $password;
    public $serverIP;
    public $serverPort;
    public $rawText;
    public $returnText;
    public $sentence = Array();
    public $term = Array();

    function send() {

        $xw = new xmlWriter();
        $xw->openMemory();

        $xw->startDocument('1.0');

        $xw->startElement('wordsegmentation');
        $xw->writeAttribute('version', '0.1');

        $xw->startElement('option');
        $xw->writeAttribute('showcategory', '1');
        $xw->endElement();

        $xw->startElement('authentication');
        $xw->writeAttribute('username', $this->username);
        $xw->writeAttribute('password', $this->password);
        $xw->endElement();

        $xw->startElement('text');
        $xw->writeRaw($this->rawText);
        $xw->endElement();

        $xw->endElement();

        $message = iconv("utf-8", "big5", $xw->outputMemory(true));

        //send message to CKIP server
        set_time_limit(60);

        $protocol = getprotobyname("tcp");
        $socket = socket_create(AF_INET, SOCK_STREAM, $protocol);
        socket_connect($socket, $this->serverIP, $this->serverPort);
        socket_write($socket, $message);
        //$this->returnText = socket_read($socket,strlen($message)*3);
        $this->returnText = iconv("big5", "utf-8", socket_read($socket, strlen($message) * 3));

        socket_shutdown($socket);
        socket_close($socket);
    }

    function getSentence() {
        $reader = new XMLReader();
        $reader->XML($this->returnText);

        while ($reader->read()) {
            if ($reader->name == "sentence" && $reader->nodeType == XMLReader::ELEMENT) {
                $reader->read();
                $this->sentence[] = $reader->value;
            }
        }
        $reader->close();
    }

    function getTerm() {
        $this->getSentence();
        foreach ($this->sentence as $t) {
            foreach (explode("　", $t) as $s) {
                if ($s != "") {
                    preg_match("/(\S*)\((\S*)\)/", $s, $m);
                    $t = new Term();
                    $t->term = $m[1];
                    $t->tag = $m[2];

                    $this->term[] = $t;
                }
            }
        }
    }

}

?>