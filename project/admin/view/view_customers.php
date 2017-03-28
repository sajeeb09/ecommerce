<html>
<body>
    <table width="795" align="center" bgcolor="white"> 


        <tr align="center">
            <td colspan="6"><h2>View All Customers Here</h2></td>
        </tr>

        <tr align="center" bgcolor="skyblue">
            <th>S.N.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Shipping Address</th>
            <th>Billing Address</th>
            <th>Delete</th>
        </tr>
        <?php 
        include("controller/db.php");

        $get_user = "select * from user";

        $run_user = mysqli_query($connection, $get_user); 

        $i = 0;

        while ($row_user=mysqli_fetch_array($run_user)){

            $user_id = $row_user['user_id'];
            $user_name = $row_user['user_fname'];
            $user_email = $row_user['user_email'];
            $user_phone = $row_user['user_phone'];
            $billing_address = $row_user['billing_address'];
            $shipping_address = $row_user['Shipping_address'];
            $i++;

        ?>
        
        <tr align="center">
            <td><?php echo $i;?></td>
            <td><?php echo $user_name;?></td>
            <td><?= $user_email;?></td>
            <td><?php echo $user_phone;?></td>
            <td><?= $billing_address;?></td>
            <td><?= $shipping_address;?></td>
            <td><a href="view/delete_user.php?user_id=<?= $user_id;?>">Delete</a></td>

        </tr>
        <?php } ?>
    </table>
</body>
</html>