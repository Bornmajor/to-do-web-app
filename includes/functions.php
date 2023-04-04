<?php
include 'connection.php';

function successMsg($message){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
  '.$message.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


}
function escapeString($string){
    global  $connection;
   return mysqli_real_escape_string($connection,$string);
 
 }

 function checkQuery($result){
    global $connection;
    if($result){

    }else{
        die("Query failed".mysqli_error($connection));
    
    }  
}

function checkEmptyRow($result){
    global $connection;

$total_rows = mysqli_num_rows($result);

    if($total_rows == 0){
    echo '<div class="empty_list"> <span> Empty list</span> </div>';
    }
}

function viewList(){
    global $connection;
    $query = "SELECT * FROM lists ORDER BY list_id DESC";
    $result = mysqli_query($connection,$query);
    
    checkQuery($result);
    while($row = mysqli_fetch_assoc($result)){
       $list_id = $row['list_id'];
       $list_name =  $row['list_name'];
       $list_desc =  $row['list_desc'];

       ?>
         <!--list-item-->
         <div class="list_item" list-name='<?php echo $list_name ?>'><!--list-itm-->
            
            <div class="list_title">
            <i class="fas fa-list"></i> <span><?php echo $list_name ?></span>  
            </div>
    
            <div class="edit_del_list"><!--edit_del_list-->
          
            <div class="dropdown">
  <span class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <i style='font-size:30px;' class="fas fa-ellipsis-v"></i>
</span>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item edit_list" list-id='<?php echo $list_id ?>' href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-edit"></i> Edit </a></li>
    <li><a class="dropdown-item del_list" list-id='<?php echo $list_id ?>' href="#"><i class="fas fa-trash"></i> Delete</a></li>
  </ul>
</div>
              
                
            </div><!--edit_del_list--> 

            </div><!--list-itm-->
           
            <div class="task_container"> <!--task_container-->

             <div class="feedback_task"></div>

            <!--form-->
            <form id='form_add_task' style='margin:10px;' action="" method="post">   
        <div  class="input-group mb-3  entry_list">

  <input type="text" class="form-control" name='task_name' placeholder="Add task" aria-label="Enter list name" aria-describedby="button-addon2" required>
  <input type="hidden" name="list_id" value="<?php echo $list_id ?>">
  <button class="btn btn-primary" type="submit" id="button-addon2">Go</button>
    </div>

  </form>
  <hr>



<?php  viewTasks($list_id); ?>

                
            </div><!--task_container-->
             <!--list-item-->

            <div style='padding:5px;'></div>

    <?php }
}


function viewTasks($list_id){
    global $connection;
    // global $list_id;


    
   $query = "SELECT * FROM tasks WHERE list_id = $list_id";
   $select_tasks = mysqli_query($connection,$query);
   checkQuery($select_tasks);

   checkEmptyRow($select_tasks);

   while($row = mysqli_fetch_assoc($select_tasks)){
    $task_id = $row['task_id'];
    $task_name = $row['task_name'];
    $status = $row['status'];
    ?>

      <!--task_item-->
      <div class="task_item">
               
               <div class="list_title"><!--list_title-->
  
              <div class="checked_title"><!--checked_title-->
  
              <?php
              if($status == 'completed'){
                ?>

              <div class="form-check">
                <input class="form-check-input check_box" type="checkbox" task-id='<?php echo $task_id ?>'  checked>
              </div>

             <?php }else{
              ?>

              <div class="form-check">
                <input class="form-check-input check_box" type="checkbox" task-id='<?php echo $task_id ?>'  >
              </div>
  


              <?php }

              ?>
  
             
  
      <div class="">
         <i class="fas fa-thumbtack"></i> 
        <span>  <?php echo $task_name ?></span> 
      </div>
              
          
  
              </div><!--checked_title--> 
       </div><!--list_title-->
  
              <div class="edit_del_list"><!--edit_del_list-->
                 
                  <span task-id="<?php echo $task_id ?>" class='del_task'><i class="fas fa-trash"></i></span>
                  
              </div><!--edit_del_list-->
      
              </div>
              <!--task_item-->
           <hr>
   <?php }




}
?>