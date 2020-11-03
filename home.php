<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    
    $query = "SELECT * FROM `Bcorp` WHERE CONCAT(`company_id`, `company_name`, `date_first_certified`, `current_status`,`industry`,`industry_category`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `Bcorp`";
    $search_result = filterTable($query);
}


function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "search_db");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="home.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
            
            <table>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                </tr>

                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['company_id'];?></td>
                    <td><?php echo $row['company_name'];?></td>
                    <td><?php echo $row['date_first_certified'];?></td>
                    <td><?php echo $row['current_status'];?></td>
                    <td><?php echo $row['industry'];?></td>
                    <td><?php echo $row['industry_category'];?></td>
                    
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>
