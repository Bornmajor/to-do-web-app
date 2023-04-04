<?php include 'includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500&family=Roboto+Slab:wght@400;500&display=swap" rel="stylesheet">
    
<title>TO-DO LIST</title>
    <!--js-->
<script src="js/jquery-3.6.3.min.js"></script>
<!--js-->
</head>
<body>
    <!--nav-->
    <nav id='navbar'>
      <div id='title'>TO DO LIST</div>  

    </nav>
     <!--nav-->

    <div class="container"> <!--container-->
    
    <div class="section_one"><!--section_one-->

    <div class="item_div">
        <a href="#" class='btn btn-primary create_list'> <i class="fas fa-plus-circle"></i> Create list</a>
        </div>

        <!--form add list-->
        <div class="item_div"><!--item div--> 

        <div class="feedback_list"></div>

    <form id='form_add_list' action="" method="post">   
        <div  style='display:none;' class="input-group mb-3 entry_list">

  <input type="text" class="form-control" name='list_name' placeholder="Enter list name" aria-label="Enter list name" aria-describedby="button-addon2" required>
  <button class="btn btn-primary" type="submit" id="button-addon2">Go</button>
    </div>

  </form>

</div><!--item div--> 

    <div class="item_div">
        <input type="search"
         name=""
         id='search'
         class='form-control'
          placeholder='Search for tasks' 
          style='background-image:url("images/searchicon.png");
          background-repeat:no-repeat;
          background-size:38px ;
          padding-left:35px;'
          autocomplete="off">
    </div>
  
    <div class="item_div">

        <div class="list_container"><!--list-container-->

        <div id="title">Lists</div>
     
        <div id="view_list">
          
        <div class="loader"></div>

        </div>
     


         


    
        </div><!--list-container-->
     

    </div>

    

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">

      

      <div id="edit_list">
<!--loader-->
      <div class="loader"></div>

      </div>
    
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>



    </div><!--section_one-->

    <div class="section_two"><!--section_two-->
    <div id="title">Recently opened</div>





    </div><!--section_two-->



    </div> <!--container-->


    <!--js-->
    <script src="js/popper.min.js"></script>
 <script src="js/bootstrap.bundle.min.js" ></script>
 <script src="js/all.js"></script>
   <!--js-->



<script>


    $(document).ready(function(){

    
  
      //display/hide form add lis
      $('.create_list').click(function(){
        $(".entry_list").slideToggle();

      });
      
      //submit add list form
      $('#form_add_list').submit(function(e){
      e.preventDefault();

      let postData = $(this).serialize();

      $.post("includes/add_list.php",postData,function(data){
        $('.feedback_list').html(data);
     $('#form_add_list')[0].reset();

      })

     //display tasks
    setTimeout(function() {  displayList(); }, 2000);
     

      });


    
      
      
      //display tasks
    setTimeout(function() {  displayList(); }, 2000);

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

 



  
        }); 


</script>
</body>
</html>