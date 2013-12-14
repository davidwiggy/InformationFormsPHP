<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
       <title>Rick's Goods</title>
</head>
<body bgcolor="#D8D8D8">
<pre>
<?php

//FILENAME   : Wiggins_Ricks1.php
//PROGRAMMER : Timothy Wiggins
//PURPOSE    : This programs presents the user with a form to select goods
//PURPOSE    : when the user selects the department this php file pulls information from
//PURPOSE    : the database and formats into a checkbox selection for the user to select
//PURPOSE    : the product the user wants more information about. Then Wiggins_Ricks2.php
//PURPOSE    : process these selection and pulls the information about these products from
//PURPOSE    : database and prints them to the screen.


     printf("<table cellpadding='10' cellspacing='1' border='25' bgcolor='#CC0000' width='100%%'>");
     printf("<tr><td valign='top' align='left'><div align='center'>");
     printf("<font size='7' face='Arial Black' color='#000000'>Welcome To Ricks Goods</font>");
     printf("<br /><b><small>Here at Ricks we strive to bring you hot products at hard to beat prices!</b></td></div>");
     printf("</tr>");

     printf("<body bgcolor='#D8D8D8'>");
     printf("<table cellpadding='10' cellspacing='0' border='0' width='100%%'>");
     printf("<tr><td valign='top' align='left'><div>");

     extract ($_POST);
     
     if (empty($username))
     {
        printf ("You forget to enter your name.\n");
        printf ("Please push your back button and enter your name.\n");
     }
     else   //$username not empty
     {
        if (!isset($rating))
           printf ("Please press the back button and select a department!\n");
        else   //Set up connection to cpt283db and set up list of items
        {
           $link = mysql_connect ("localhost", "root", "wiggins");
           if (!$link) die("Could not connect: " . mysql_error());

           //Choose the database to work with
           if (!mysql_select_db ("cpt283db"))
              die("Problem with the database: " . mysql_error());

           //Set up query for items to display
           $query = "SELECT ID, entertainerauthor, title, media, feature FROM products WHERE department = '$rating'";

           //Execute the query
           $result_set = mysql_query ($query);
           
            printf("<h1><b>%s Department</h1></b>", $rating);

            printf("%s please select any or all of the products you want more information about.<br>", $username);

            printf ("Here are the products offered from the department you've selected:\n");
            printf ("<br><b>%-12s     %-36s    %-23s  %-13s  %s</b>",
                   "ITEM ID", "Entertainer/Author", "Title", "Media", "Feature");

           //Start a while loop to process all the rows
           while ($row = mysql_fetch_assoc ($result_set))
           {
              $ID = $row['ID'];
              $enter = $row['entertainerauthor'];
              $title = $row['title'];
              $media = $row['media'];
              $feat = $row['feature'];
              //Leaving PHP to set up the checkbox choices.
              ?>
            <form action = "Wiggins_Ricks2.php" method = "POST">
<input type="checkbox" name = "choices[]"
              value = "<?PHP print $ID; ?>"/><?PHP printf("%-15s%-40s%-25s%-15s%-35s", $ID, $enter, $title, $media, $feat);

           } //End of the while statement

           ?>

<br />
<p /><input type="submit" value="Submit"><input type="reset" value="Clear">
</form></body></html>


           <?PHP
           mysql_close ($link);


        }//End of !isset Else Statement
     }//End of the UserName Else Statement
     
     printf("</tr>");
?>
</pre>

</body>
</html>

