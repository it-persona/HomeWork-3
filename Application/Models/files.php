<?php

class FilesModel
{
    public $fileName;
    public $readMode;
    public $writeMode;
    public $option;
    public $data;
    public $year, $month, $day, $hour, $minutes, $setDate;

    function __construct ($fileName, $readMode, $writeMode, $option, $data)
    {
        // Initialize file parameters
        $this->fileName          = "Application/Files/".$fileName;
        $this->readMode          = $readMode;
        $this->writeMode         = $writeMode;
        $this->option            = $option;
        $this->data              = $data;

        // Initialize date parameters
        $this->setDate            = false;
        $this->year               = date('Y');
        $this->month              = date('n');
        $this->day                = date('j');
        $this->hour               = date('H');
        $this->minutes            = date('i');
    }

    public function readFromFile ()
    {
        if ($this->option == "read_date") {
            echo "<b>Starting reading from file...</b><br>";

            // Check file exist on this server
            if (file_exists($this->fileName)) {
                $handler = fopen($this->fileName, $this->readMode); // mode = r

                if (!$handler) {
                    echo 'Unable open this file<br>';
                    exit;
                }

                $date = fgets($handler);
                
                if ($date) {
                    // Reading date from file
                    list($this->year, $this->month, $this->day, $this->hour, $this->minutes) = explode(">", $date);
                    echo 'Date successfully readed from file on server<br><br>';
                } else {
                    echo 'WARNING: This file empty.<br>';
                }
            } else {
                echo 'File not exist on this server!<br>';
            }

        // End reading file

        } else {

        $id = 0; // Current cycle iterator counter
        echo("Reading data from file <b>$this->fileName</b><br><br>\n");

        $handle = fopen($this->fileName, $this->readMode); // mode = r

            if ($handle) {
            // Build table header
            echo("
                 <table border='1' style='background-color:#d3d3d3; border-collapse:collapse;
                  border:1px solid #7f7f7f; color:#494747; width:33%;'>
                  <tr>
                      <td><b>USERNAME</b></td>
                      <td><b>MESSAGE</b></td>
                  </tr>
                 ");

            while (($buffer = fgets($handle, 4096)) !== false) {
                // Parse string reading from file
                $parsed = explode("=", $buffer);

                // Add parsed data to table
                echo("
                      <tr>
                          <td id='first-cell-$id'> $parsed[0] </td>
                          <td id='second-cell-$id'> $parsed[1] </td>
                      </tr>
                     ");
            }

            if (!feof($handle)) {
                // Exception
                echo "<b>Error: unexpected fgets() fail</b><br>\n";
            }

            // Close current file handler
            fclose($handle);

            echo("</table><br>");
            echo("<b>Parsing complete!</b><br>\n<hr>");
        }
        }
    }

    public function writeToFile ($data)
    {
        if ($this->option == "write_date") {
            
            $this->setDate = true;
            
            echo "<b>Entered date: </b><br>";

            echo "<pre>";
            print_r($data);

            echo "<br><b>Check date on correct input type and save to file</b><br>";

            if ($data['months'] < 1 or $data['months'] > 12) {
                echo "Error: Month need be digits 1 - 12 <br>";
                exit;
            }

            if ($data['hours'] < 0 or $data['hours'] > 23) {
                echo "Error: Hour need be digits 0 - 23<br>";
                exit;
            }

            if ($data['minutes'] < 0 or $data['minutes'] > 59) {
                echo "Error: Minute need be digits 0 - 59<br>";
                exit;
            }

            // 1 - 30 if 30 days per month
            if (($data['days'] < 1 or $data['days'] > 30) and ($data['months'] == 4 or $data['months'] == 6 or $data['months'] == 9 or $data['months'] == 11)) {
                echo "Error: Days need be digits 1 - 30<br>\n";
                exit;
            }

            // 1 - 31 if 31 days per month
            if (($data['days'] < 1 or $data['days'] > 31) and ($data['months'] == 1 or $data['months'] == 3 or $data['months'] == 5 or $data['months'] == 7 or $data['months'] == 8 or $data['months'] == 10 or $data['months'] == 12)) {
                echo "Error: Day need be digits 1 - 31<br>\n";
                exit;
            }

            // 1 - 28 days
            if (($data['days'] < 1 or $data['days'] > 28) and $data['months'] == 2 and $data['years']%4 != 0) {
                echo "Error: Day need be digits <br>\n";
                exit;
            }

            $datetime = implode(">", $data);
            $file = fopen($this->fileName, $this->writeMode);

            if (!$file) {
                echo 'Unable open file on server';
                exit;
            }

            $fw = fwrite($file, $datetime);

            if (!$fw) {
                echo 'Unable write date from file on server';
                exit;
            }
            echo 'Date successfully write to file on this server';

        // End checking date format and write to file procedure 
        } else {

        if (file_exists($this->fileName)) {
            echo "File $this->fileName exist on this server!<br> Data writed to end of this file. ($data)<br>";
            $handle = fopen($this->fileName, $this->writeMode); // mode = a+

            if (fwrite($handle, $data) === FALSE) {
                echo "Failed write data from file $this->fileName<br>";
                exit;

            } else {
                echo "Write data to file. Success!<br>";
                fclose($handle);
                echo "Closing file descriptor $this->fileName because all operations completed.<br>";
            }

        } else {    
        // If file not existing on this server run this...
            echo "File $this->fileName not exist. Create new file on this server.<br>";

            $handle = fopen($this->fileName, $this->writeMode); // mode a+

            if (is_writable($this->fileName)) {
                if (fwrite($handle, $data) === FALSE) {
                    echo "Unable write to file $this->fileName<br>";
                } else {
                    echo "Creating file $this->fileName sucess!<br>
                                   Data entered by user ($data) succesfull add to end of file<br>";
                    fclose($handle);
                    echo "Closing file descriptor $this->fileName becouse procedure write data to file success.<br>";
                }
            }
            else echo "Failed create file $this->fileName on this server now. Pleace try again or check permissions.<br>";
            }
        }
    }

    public function saveFileForm()
    {
        $iText       = null;
        $tArea       = null;
        $checkBox      = null;
        $radioBox      = null;

        echo "Save form data to file...<br> Preview data:<br>";
        print_r($this->data);

            foreach ($this->data as $var => $value) {
                if (substr($var, 0, 5) == "text_") { // Check Input type text
                    preg_match("/text_([a-zA-Z0-9-_]{1,})/i", $var, $element);
                    $iText[$element[1]] = $value;
                    echo "<b>text_$element[1]</b> - found!<br>\n";
                    continue;

                } elseif (substr($var, 0, 9) == "textarea_") { // Check textarea ^[a-zA-Z0-9]+$
                        preg_match("/textarea_([a-zA-Z0-9-_]{1,})/i", $var, $element);
                        $textArea[$element[1]] = $value;
                        echo "<b>textarea_$element[1]</b> - found!<br>\n";
                        continue;

                } elseif (substr($var, 0, 6) == "check_") { // Check checkboxes
                            preg_match("/check_([a-zA-Z0-9-_]{1,})/i", $var, $element);
                            $checkBox[$element[1]] = $value;
                            echo "<b>checkbox_$element[1]</b> - found!<br>\n";
                            continue;

                } elseif (substr($var, 0, 6) == "radio_") { // Check radio
                                preg_match("/radio_([a-zA-Z0-9-_]{1,})/i", $var, $element);
                                $radioBox[$element[1]] = $value;
                                echo "<b>radio_$element[1]</b> - found!<br>\n";
                }
            }
            // Serializing all data containing in form 
                $text = serialize($iText);
                $resTextArea = serialize($tArea);
                $resCheckBox = serialize($checkBox);
                $resRadioBox = serialize($radioBox);
                $res = $text . ">" . $resTextArea . ">" . $resCheckBox . ">" . $resRadioBox;
        
                $handler = fopen($this->fileName, $this->writeMode);
    
                if (fwrite($handler, $res)) {
                    echo "Saving form data <b>$this->fileName</b> Success!";
                     fclose($handler);
                } else {
                    echo "Error: Unable save form data to file <b>$this->fileName</b> on this server. Pleace try agin latter";
                }
    }

    public function loadFormFromFile()
    {
        echo "Loadin form data from file <b>$this->fileName</b><br>\n";

        if (file_exists($this->fileName)) {
            $outForm = "<form id='text-input-area' method='post'><br>\n";
            $file = file($this->fileName);

            print_r($file[0]);
            $array = explode(">", $file[0]);
            echo '<br>Index 1: ';
            print_r($array[0]);
            echo '<br>Index 2: ';
            print_r($array[1]);
            echo '<br>Index 3: ';
            print_r($array[2]);
            echo '<br>Index 4: ';
            print_r($array[3]);

            $text = unserialize($array[0]);
            $unTextArea = unserialize($array[1]);
            $unCheckBox = unserialize($array[2]);
            $unRadioBox = unserialize($array[3]);

            // Parse file and build form html-code
            foreach ($text as $var => $value) {
                $outForm .= "<input type=\"text\" name=\"text_".$var."\" size=\"65\" value=\"".$value."\"/><br><br>\n";
            }

            foreach ($unTextArea as $var => $value) {
                $outForm .= "<textarea name=\"textarea_".$var." cols=\"50\" rows=\"10\" value=\"".$value."\"></textarea><br>";
            }

            foreach ($unCheckBox as $var => $value) {
                $outForm .= "<input type=\"checkbox\" id=\"chk\" name=\"check_".$var." value=\"".$value."\"><label for=\"chk\">Checkbox 1</label><br>";
            }

            foreach ($unRadioBox as $var => $value) {
                $outForm .="<input type=\"radio\" id=\"rbu\" name=\"radio_".$var." value=\"".$value."\"<label for=\"rbu\">Radio 1</label><br>";
            }
            echo $outForm;
        }
    }
}
