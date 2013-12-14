<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<!--This is the second .php file for program 8 -->
<html>
<head>
       <title>Rick's Goods</title>
</head>
<body bgcolor="#D8D8D8">
<pre>
<?PHP

     //FILE : Wiggins_Ricks2.php
     //PROG : Timothy Wiggins
     //PURP : Process check boxes from Wiggins_Ricks1.php

     printf("<table cellpadding='10' cellspacing='1' border='25' bgcolor='#CC0000' width='100%%'>");
     printf("<tr><td valign='top' align='left'><div align='center'>");
     printf("<font size='7' face='Arial Black' color='#000000'>Welcome To Ricks Goods</font>");
     printf("<br /><b><small>Here at Ricks we strive to bring you hot products at hard to beat prices!</b></td></div>");
     printf("</tr></head>");

     printf("<body bgcolor='#D8D8D8'>");
     printf("<table cellpadding='10' cellspacing='0' border='0' width='100%%'>");
     printf("<tr><td valign='top' align='left'><div>");
         
     extract ($_POST);

     if (!isset($choices))
     {
        printf ("You didn't make any choices.\n");
        printf ("Please push your back button and choose at least one!\n");
     }
     else
     {
        //First, connect to the cpt283 DB
        $link = mysql_connect ("localhost", "root", "wiggins");
        if (!$link) die("Could not connect: " . mysql_error());

        //Choose the database to work with
        if (!mysql_select_db ("cpt283db"))
           die("Problem with the database: " . mysql_error());

        printf ("<br><h4><b>%-10s     %-31s    %-23s  %-7s  %-12s %s</b>",
                "ITEM ID", "Entertainer/Author", "Title", "Price", "In Stock", "Summary\n</h4>");


        //Loop through the choices array
        foreach ($choices as $value)
        {
           //Set up the query for the first $value.
           $queryOne   = "SELECT ID, entertainerauthor, title FROM products WHERE ID = '$value'";
           $queryTwo   = "SELECT UnitPrice, UnitsInStock FROM prodinv WHERE ID = '$value'";
           $queryThree = "SELECT summary FROM products WHERE ID = '$value'";

           //Execute the query
           $result_setOne   = mysql_query ($queryOne);
           $result_setTwo   = mysql_query ($queryTwo);
           $result_setThree = mysql_query ($queryThree);

           //Result set condition
           if ($result_setOne && $result_setTwo && $result_setThree)
           {
              $rowOne   = mysql_fetch_assoc($result_setOne);
              $rowTwo   = mysql_fetch_assoc($result_setTwo);
              $rowThree = mysql_fetch_assoc($result_setThree);

              printf ("%-15d%-35s%-25s$%-10.2f%-10d%-14s\n",
                     $rowOne['ID'],
                     $rowOne['entertainerauthor'],
                     $rowOne['title'],
                     $rowTwo['UnitPrice'],
                     $rowTwo['UnitsInStock'],
                     $rowThree['summary']);
           }
           else printf ("Error with the DB result set!\n");
        }
     mysql_close($link);
     printf("</tr>");

     }//End of choices isset statement!!
?>
</pre>
</body>
</html>
