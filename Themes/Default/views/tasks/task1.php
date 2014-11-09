<?php
/**
 * task1.php
 *
 * @author      Vadym Panchenko <panchenko.vadym@gmail.com>
 * @link        http://www.it-persona.com.ua/
 * @copyright   2010-2014 IT-PERSONA
 * @license     http://www.it-persona.com.ua/license/
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/Application/Models/files.php');

    $iData = @$_POST['t-input'];
    $tData = @$_POST['t-area'];

// End initial script variables
    if (empty($iData) || empty($tData)) {
        echo("<b>Waiting user data...</b><br>");
    } else {
//Main program
        echo ("<b>Просмотр введенных данных $iData , $tData</b><br>");
        $idata = str_replace("\r\n", "", $_POST['t-input']);
        $tdata = str_replace("\r\n", "", $_POST['t-area']);
        $mergingStr = $iData . "=" . $tData . "\r\n";

        echo("<b>Preview merged string:" . $mergingStr . "</b><br>");

        $test = new FilesModel("data_t1.txt", "r", "a+", "additional option", "This text must be saved to file...");
        $test->writeToFile($mergingStr);
    }
?>
<!-- HTML CODE SEGMENT -->
<h1>Task #1:</h1><br>
<p>
    PHP script used files model for saving entered text content from form inputs to file on server HDD.
</p>
<form id="text-input-area" method="POST">
    <b>Input type "text":</b><br>
    <input type="text" name="t-input" size="65" placeholder="Please enter or paste first text data and click button 'Find & Save'"/><br><br>
    <b>Textarea:</b><br>
    <textarea name="t-area" cols="50" rows="10" placeholder="Please enter or paste second text data and click button 'Find & Save'"></textarea><br>
    <button id="start-script" type="submit">Save</button>
</form>