<?php
include_once 'products_crud.php';
include_once 'product_brand.php';
include_once 'product_type.php';

if(!isset($_SESSION['username'])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Mobility Care Ordering System : Products</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Bootstrap library -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
    body{
      margin:0;
      background-image: url("bg.jpg") ;
      background-size: 100%;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
</head>
<body>
  <?php include_once 'nav_bar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" style="background-color: rgba(255,255,255,1); background-blend-mode: lighten; border-style: groove; border-radius: 10px;">
        <div class="page-header">
          <h2>Create New Product</h2>
        </div>
        <form action="products.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label for="productid" class="col-sm-3 control-label">Product ID</label>
            <div class="col-sm-9">
              <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" 
              value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label for="productname" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" 
              value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label for="productprice" class="col-sm-3 control-label">Price</label>
            <div class="col-sm-9">
              <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" 
              value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label for="productbrand" class="col-sm-3 control-label">Brand</label>
            <div class="col-sm-9">
              <select name="brand" class="form-control" id="productbrand" required>

                <option value="">Please Select</option>
                <?php foreach($ProductBrand as $Brand) { ?>
                  <option value="<?php echo $Brand ?>" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']==$Brand) echo "selected"; ?>><?php echo $Brand ?></option>
                <?php } ?>

              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="producttype" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <select name="type" class="form-control" id="producttype" required>
                <option value="">Please Select</option>
                <?php foreach($ProductType as $Type) { ?>
                  <option value="<?php echo $Type ?>" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']==$Type) echo "selected"; ?>><?php echo $Type ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="productquantity" class="col-sm-3 control-label">Quantity</label>
            <div class="col-sm-9">
              <input name="quantity" type="number" class="form-control" id="productquantity" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>" min="1" required>
            </div>
          </div>
          <div class="form-group">
            <label for="productwarranty" class="col-sm-3 control-label">Warranty</label>
            <div class="col-sm-9">
              <div class="radio">
                <label>
                  <input name="warranty" type="radio" id="productwarr" value="Yes" <?php if(isset($_GET['edit'])) if($editrow['fld_product_warranty']=="Yes") echo "checked"; ?> required> Yes
                </label>
              </div>
              <div class="radio">
                <label>
                  <input name="warranty" type="radio" id="productwarr" value="No" <?php if(isset($_GET['edit'])) if($editrow['fld_product_warranty']=="No") echo "checked"; ?>> No
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <?php if (isset($_GET['edit'])) { ?>
                <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
                <button type="submit" class="btn btn-default" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
              <?php } else { ?>      
                <button type="submit" class="btn btn-default" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
              <?php } ?>
              <button type="reset" class="btn btn-default" ><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
            </div>
          </div>

        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="page-header">
          <h2 style="margin: 0; display: inline-block;">Products List</h2>
          <!-- Search Button -->
          <button style="float: right;" type="button" onclick="window.location='products_search.php'" class="Redirect btn btn-default" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
        </div>
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
      // Read
          $per_page = 5;
          if (isset($_GET["page"]))
            $page = $_GET["page"];
          else
            $page = 1;
          $start_from = ($page-1) * $per_page;
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("select * from tbl_products_a170586_pt2 LIMIT $start_from, $per_page");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
            echo "Error: " . $e->getMessage();
          }
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
                <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
              </td>
            </tr>

            <?php
          }
          $conn = null;
          ?>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <nav>
          <ul class="pagination">
            <?php
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM tbl_products_a170586_pt2");
              $stmt->execute();
              $result = $stmt->fetchAll();
              $total_records = count($result);
            }
            catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }
            $total_pages = ceil($total_records / $per_page);
            ?>
            <?php if ($page==1) { ?>
              <li class="disabled"><span aria-hidden="true">«</span></li>
            <?php } else { ?>
              <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
              <?php
            }
            for ($i=1; $i<=$total_pages; $i++)
              if ($i == $page)
                echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
              else
                echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
              ?>
              <?php if ($page==$total_pages) { ?>
                <li class="disabled"><span aria-hidden="true">»</span></li>
              <?php } else { ?>
                <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
              <?php } ?>
            </ul>
          </nav>
        </div>
      </div>
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