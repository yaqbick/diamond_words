<?php
    unset($argv[0]);
    foreach($argv as $arg)
    {
        draw_diamond($arg);
        echo '0'.PHP_EOL;
    }

function draw_diamond($word)
{
    $letters = str_split(trim($word));
    $result = array_fill(0,sizeof($letters)," ");
    if(strlen(trim($word)) % 2 == 0)
    {
        $middle = ((sizeof($letters))/2)-1;
        $result[$middle+1]=$letters[$middle+1];
        $how_many_letters = 2;
    }
    else
    {
        $middle = ((sizeof($letters)+1)/2)-1;
        $how_many_letters = 1;
    }
    $result[$middle]=$letters[$middle];
    $index_min = 0;
    $index_max = sizeof($letters)-1;

    for($i = 1;$i<=sizeof($letters);$i++)
    {
        $line=implode(" ",$result);
        print_r($how_many_letters.$line.PHP_EOL);
        if($middle+$i>=sizeof($letters) || $middle-$i<0)
        {
            $result[$index_min] = ' ';
            $result[$index_max] = ' ';
            $index_min++;
            $index_max--;
            $how_many_letters=$how_many_letters-2;
        }
        else
        {
            $how_many_letters=$how_many_letters+2;
            
            if(strlen(trim($word)) % 2 == 0)
            {
                $result[$middle+$i+1]=$letters[$middle+$i+1];
            }
            else
            {
                $result[$middle+$i]=$letters[$middle+$i];
            }
           
            $result[$middle-$i]=$letters[$middle-$i];
        }
    }
}


?>