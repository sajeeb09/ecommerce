<html>
<body>
    <table width="795" align="center" bgcolor="white"> 


        <tr align="center">
            <td colspan="6"><h2>View All Categories Here</h2></td>
        </tr>

        <tr align="center" bgcolor="skyblue">
            <th>S.N</th>
            <th>Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php 
        include("controller/db.php");

        $get_cat = "select * from categories";

        $run_cat = mysqli_query($connection, $get_cat); 

        $i = 0;

        while ($row_cat=mysqli_fetch_array($run_cat)){

            $cat_id = $row_cat['cat_id'];
            $cat_title = $row_cat['cat_title'];
            $i++;

        ?>
        <tr align="center">
            <td><?php echo $i;?></td>
            <td><?php echo $cat_title;?></td>
            
            <td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
            <td><a href="view/delete_cat.php?cat_id=<?php echo $cat_id;?>">Delete</a></td>

        </tr>
        <?php } ?>
    </table>
</body>
</html>