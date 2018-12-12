<?php
    include 'header.php';
    require 'db_connect.php';
    if(!isset($_SESSION))
        session_start();
    $user_id = $_SESSION['user_id'];
    $i=0;
    $contacts_query = "SELECT * FROM contact_info  WHERE user_id = '$user_id' ORDER BY fname , lname"; 
    $result = mysqli_query($db_connect,$contacts_query);
    $total_rows = mysqli_num_rows($result);    
?>

<div class= "container">
    <div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Search</span>
			<input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
		</div>
	</div>
	<br />
	<div id="result"></div>
    <br><br>
    <div class = "total_contacts"><h2>Total Contacts: <?php echo $total_rows;?></h2></div>
    <div class = "table">
        <table>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
            </tr>
    <?php 
        if ($total_rows>0){
            while($row = mysqli_fetch_array($result)){
                $contact_id[$i] = $row['contact_id'];
    ?>          
                <tr>
                    <td><a href="contact_details.php?user=<?php echo $user_id;?>&amp;contact=<?php echo $contact_id[$i];?>"><?php echo $row['fname']." ".$row['lname'];?></a></td>
                    <td><?php echo $row['address'];?></td>
                    <td><?php echo $row['mobile'];?></td>
                </tr>
    <?php
            $i++;
            }
        }
        else echo "No contacts available";
    ?>
        </table>
    </div>
    <li><a id= "add_new_contact" href="add_new_contact.php">Add New Contact</a></li>
</div>
<script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();			
            }
        });
    });
</script>

<?php
    include 'footer.php';
?>