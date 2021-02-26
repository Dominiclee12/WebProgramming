<?php  
include_once 'products_crud.php';

if(!isset($_SESSION['username'])) {
  header("Location: index.php");
}

$connect = mysqli_connect("lrgs.ftsm.ukm.my", "a170586", "biggraygoat", "a170586");  

if(isset($_POST["submit"]))  
{  
  if(!empty($_POST["search"]))  
  {  
   $query = str_replace(" ", "+", $_POST["search"]);  
   header("location:products_search.php?search=" . $query);
 } else {
  ?>
  <script>alert("Please fill in search text");</script>
  <?php
}
}  
?>

<!DOCTYPE html>  
<html>  
<head>  
 <title>Webslesson Tutorial | Search multiple words at a time in Mysql php</title>  
 <link href="css/bootstrap.min.css" rel="stylesheet">

 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 <!-- Bootstrap library -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <style>
  .center
  {
    margin: 0 auto;
    margin-left: auto;
    margin-right: auto;
    width: 100px;
  }

  body{
    margin:0;
    background-image: url("bg1.jpg") ;
    background-size: 100%;
    background-repeat: no-repeat;
  }
</style>
</head>  
<body>
  <?php include_once 'nav_bar.php'; ?>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Search Products</h2>
        </div>
        <!-- Top Content -->
        <form method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-xs-12">
              <h4>Please Enter Search Text</h4>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10">
              <input type="text" name="search" class="form-control" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>" />
            </div>
            <div class="col-sm-2">
              <button class="btn btn-default" type="submit" name="submit" value="Search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2" style="background-color: rgba(255,255,255,0.9); background-blend-mode: lighten;">
        <div class="page-header">
          <h2>Products List</h2>
        </div>
        <!-- Products List -->
        <table class="table table-striped table-bordered">  
          <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Warranty</th>
            <th></th>
          </tr>

          <?php  
          $per_page = 5;
          if (isset($_GET["page"]))
            $page = $_GET["page"];
          else
            $page = 1;
          $start_from = ($page-1) * $per_page;
          if(isset($_GET["search"]))  
          {  
            /* Multiple keywords */
            $condition = '';  
            $query = explode(" ", $_GET["search"]);  
            foreach($query as $text)  
            {  
             $condition .= "fld_product_name LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR fld_product_brand LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR fld_product_type LIKE '%".mysqli_real_escape_string($connect, $text)."%' OR ";  
           }  
           $condition = substr($condition, 0, -4); 
           $sql_query = "SELECT * FROM tbl_products_a170586_pt2 WHERE " . $condition . " LIMIT $start_from, $per_page";  
           $count_row = "SELECT COUNT(*) FROM tbl_products_a170586_pt2 WHERE " . $condition . " LIMIT $start_from, $per_page";

           try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($sql_query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = $conn->query($count_row)->fetchColumn();
          }
          catch(PDOException $e){
            echo "Error: " . $e->getMessage();
          }

          /*echo "Top";
          echo "Page:" .$page;
          echo "Total Records:" .$total_records;*/

          if(!empty($result)) {
            foreach($result as $readrow) {
              ?>
              <tr>
                <td><?php echo $readrow['fld_product_num']; ?></td>
                <td><?php echo $readrow['fld_product_name']; ?></td>
                <td><?php echo number_format((float)$readrow['fld_product_price'], 2, '.', ''); ?></td>
                <td><?php echo $readrow['fld_product_brand']; ?></td>
                <td><?php echo $readrow['fld_product_type']; ?></td>
                <td><?php echo $readrow['fld_product_quantity']; ?></td>
                <td><?php echo $readrow['fld_product_warranty']; ?></td>
                <td>
                  <!-- Trigger the modal with a button -->
                  <a href="javascript:void(0);" data-href="products_details.php?pid=<?php echo $readrow['fld_product_num'] ?>" class="btn btn-warning btn-xs openPopup">Details</a>
                </td>
              </tr>

              <?php
            }
          } else { ?>
            <h4 class="text-danger">No result found</h4>
          <?php }
          
          $conn = null;
        }
        ?>  
      </table>
    </div>
  </div>

  <!-- Add pagination -->
  <nav aria-label="...">
    <ul class="pager">

      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET["search"])) {
          $stmt = $conn->prepare($sql_query);
          $total_records = $conn->query($count_row)->fetchColumn();
        } else {
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a170586_pt2");
          $stmt->execute();
          $result = $stmt->fetchAll();
          $total_records = count($result);
        }
        
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }

      if(isset($_GET["totalpages"])) {
        $total_pages = $_GET["totalpages"];
      } else {
        $total_pages = ceil($total_records / $per_page);
      }
      ?>
      <?php 
      /*echo "Total Pages:" .$total_pages;
      echo "Page:" .$page;
      echo "Total Records:" .$total_records;*/
      ?>
      <?php if ($page==1) { ?>
        <?php /*echo "Hello still in first page";*/ 
        ?>
        <li class="disabled"><a>Previous</a></li>
      <?php } else { ?>
        <li><a href="products_search.php?page=<?php echo $page-1; echo "&search="; echo $_GET["search"]; echo "&totalpages="; echo $total_pages; ?>">Previous</a></li>
      <?php }

      if ($page==$total_pages) { ?>
        <li class="disabled"><a>Next</a></li>
      <?php } else { ?>
        <li><a href="products_search.php?page=<?php echo $page+1; echo "&search="; echo $_GET["search"]; echo "&totalpages="; echo $total_pages; ?>">Next</a></li>
      <?php } ?>

    </ul>
  </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Details</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  $(document).ready(function(){
    $('.openPopup').on('click',function(){
      var dataURL = $(this).attr('data-href');
      $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
      });
    }); 
  });
</script>

</body>  
</html>