<?php
    include 'header.php';
    if(!isset($_SESSION))
        session_start();
    $user_id = $_SESSION['user_id'];
    require 'db_connect.php';
?>

<body>
    <div class = "container">
        <div class = "wrapper">
            <div class="owl-carousel owl-theme">
            <?php 
                $user_id = $_SESSION['user_id'];
                $i=0;
                $contacts_query = "SELECT * FROM contact_info  WHERE user_id = '$user_id' ORDER BY fname , lname"; 
                $result = mysqli_query($db_connect,$contacts_query);
                $total_rows = mysqli_num_rows($result);
                if ($total_rows>0){
                    while($row = mysqli_fetch_array($result)){
                        $contact_id[$i] = $row['contact_id'];
                        $one_contact_query = "SELECT * FROM contact_info WHERE user_id = '$user_id' AND contact_id = '$contact_id[$i]'";
                        $one_contact_result = mysqli_query($db_connect,$one_contact_query);
                        $one_contact_row = mysqli_fetch_array($one_contact_result); 
           ?> 
                        <a href="contact_details.php?user=<?php echo $user_id;?>&amp;contact=<?php echo $contact_id[$i];?>">
                            <div class = "item">
                                <div >
                                    <img class = "pro_pic" src="image/<?php if($one_contact_row['pro_pic'] != '') {echo $one_contact_row['pro_pic'];} else {echo 'propic.png';}?>" alt = "propic">
                                </div>
                                <h2><?php echo $one_contact_row['fname']." ".$one_contact_row['lname'];?></h2>
                                <h4><?php echo $one_contact_row['email'];?></h4>
                            </div>
                        </a>

            <?php
                    $i++;
                    }
                }
                else echo "No contacts available";
            ?>
            </div>
        </div>
    </div>
</body>

<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
    
})
</script>
<?php
    include 'footer.php';
?>