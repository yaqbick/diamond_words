<?php

echo "Input words: ";
$input=input();
$input=replace_polish_chars($input);

if(validate_input($input))
{
    handle_words($input);
}
else
{
    echo 'Your input contains not allowed characters. Only letters are allowed. Please, try again.';
}

function input()
{
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    return $line;
}

function validate_input($input)
{
    $input_without_spaces = str_replace(' ','',trim($input));
    if (ctype_alpha($input_without_spaces))
    {
        return True;
    }
    else
    {
        return False;
    }
}

function replace_polish_chars($alias)
{
    $alias = str_replace(array('Ą','ą', 'Ć','ć','Ę','ę','Ł','ł','Ń','ń', 'Ó','ó','Ś','ś','Ź','ź','Ż','ż'), array('Ą','a','C','c','E' ,'e','L', 'l', 'N','n','O', 'o','S', 's','Z', 'z', 'Z','z'), $alias);
    return $alias;
}

function handle_words($input)
{
    $words = explode(" ", $input);
    foreach($words as $word)
    {
        if(strlen(trim($word)) % 2 == 0)
        {
            draw_diamond($word,True);
        }
        else
        {
            draw_diamond($word, False);
        }
        echo '0'.PHP_EOL;
    }
}

function draw_diamond($word, $is_even)
{
    $letters = str_split(trim($word));
    $result = array_fill(0,sizeof($letters)," ");
    if($is_even)
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
            
            if($is_even)
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