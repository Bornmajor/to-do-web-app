<?php
include 'functions.php';

$edit_id = $_POST['edit_id'];

$query = "SELECT * FROM lists WHERE list_id = $edit_id";
$select_list = mysqli_query($connection,$query);

checkQuery($select_list);

while($row = mysqli_fetch_assoc($select_list)){
     $list_name = $row['list_name'];
}


?>

<form id='edit_form_list' action="" method="post">
 <div class="mb-3">   <input type="text" name='list_name' placeholder='New list title' value='<?php echo $list_name ?>' name='list_name' class="form-control" required></div>
 <input type="hidden" name="list_id" value='<?php echo $edit_id ?>'>
<div class="mb-3"> <input class='btn btn-primary' type="submit" value="Update list"></div>
 </form>

<script>
      $('#edit_form_list').submit(function(e){
            e.preventDefault();
            
            let postData = $(this).serialize();

            $.post("includes/update_form.php",postData,function(data){
             $('#feedback_list').html(data);
                 //display tasks
    setTimeout(function() {  displayList(); }, 2000);

            });
           
      });

      function displayList(){
          $.ajax({
            url: "includes/view_list.php",
            type:'post',
            success:function(show_list){
              if(!show_list.error){
                $('#view_list').html(show_list);


              }
              
            }

          })
      }

</script>

     