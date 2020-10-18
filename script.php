<?php 
require_once('Calculation.php');
require_once('History.php');

    for(;;){
        $line = getUserInput("Enter x to Exit, 1 to make new calculation, 2 to recall the last five results or 3 to Generate HTML document with last 5 results: ");
        switch($line){
            case 'x':
                echo "\nABORTING!\n";
                exit();
            break;
            case '1';
                $a = (int)getUserInput("Enter the first number: ");
                $b = (int)getUserInput("Enter the second number: ");
                $calc = new Calculation($a, $b);
                echo "\nthe average is ". $calc->average($a, $b);
                echo "\nthe area is ". $calc->area($a, $b);
                echo "\nthe squared area is ". $calc->areaSquared($a, $b)."\n";
            break;
            case '2';
                $history = new History();
                $items = $history->getLast();
                print_r($items);
            break;
            case '3';
                generateHtml();
            break;
            default:
                echo "Enter a correct choice";
        }
    }

    function getUserInput($inputText){
        echo $inputText;
        $handle = fopen ("php://stdin","r");
        return rtrim(fgets($handle));
    }

    function generateHtml(){
        $history = new History();
        $items = $history->getLast();
        $fileName = date("Y-m-d-His-").rand().".html";
        copy("template.html",$fileName);
        $data = "";
        foreach($items as $item){
            $data .= "<tr><td>".implode("</td><td>", $item)."</td></tr>";
        }
        
        try{
            $file_contents = file_get_contents($fileName);
            $file_contents = str_replace("-----content here-----", $data, $file_contents);
            file_put_contents($fileName,$file_contents);
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }
        echo "the output file is ".getcwd().'/'.$fileName."\n";
    }
?>