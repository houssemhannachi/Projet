<?php
require_once ("db_conn.php");
$pageName = "Clients";


?>
<link rel="stylesheet" href="assets/css/styleinvoice.css?v=<?php echo time();?>">
<link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo time();?>">
<link rel="stylesheet" href="assets/css/font-awesome.min.css?v=<?php echo time();?>">
<link rel="stylesheet" href="assets/css/line-awesome.min.css?v=<?php echo time();?>">
<link rel="stylesheet" href="assets/css/select2.min.css?v=<?php echo time();?>">
<link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time();?>">
<?php 
session_start();
$pageName ="Factures";
include('dashboard.php');


?>

<script src="js/invoice.js?v=<?php echo time();?>"></script>
<div class="home-content">
		<div class="page-wrapper">
		
			<!-- Page Content -->
			<div class="content container-fluid">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title">Facture</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
								<li class="breadcrumb-item active">Facture</li>
							</ul>
						</div>
						<div class="col-auto float-right ml-auto">


							<a href="ajouter_facture.php" class="btn add-btn"><i class="fa fa-plus"></i>Ajouter une facture</a>

						</div>
					</div>
				</div>
				<!-- /Page Header -->
        		<div class="row filter-row">
					<form action = "chercher_facture.php" method ="POST" >
					<div class="col-sm-8 col-md-4"style="float:left;">  
						<div class="form-group form-focus" >
							<input type="text" class="form-control floating" name="numfch">
							<label class="focus-label">N° Facture</label>
						</div>
					</div>
					<div class="col-sm-8 col-md-4" style="float:left;">  
						<div class="form-group form-focus">
							<input type="text" class="form-control floating" name="clientch">
							<label class="focus-label">Client</label>
						</div>
					</div>

						
					<div class="col-sm-8 col-md-4" style="float:left;" >   
						<button type="submit" class="btn btn-success btn-block" name="submit-search"> Chercher une facture </button>
					</div>
				</form>   
				</div>
        <!-- /Page Header -->
               <div class="row">
				   <div class="col-md-12">
					   <div class="table-responsive">
						   <table id="data-table" class="table table-striped custom-table datatable">
							   <thead>
								    <tr>
										<th>N° Facture</th>
										<th>Client</th>
										<th> Date Facture</th>
                                        <th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
                                <?php
if (isset($_POST['submit-search'])){
    $recherche_numf = $_POST['numfch'];
    $recherche_client = $_POST['clientch'];


   $sql = "SELECT * FROM invoice_order WHERE order_id LIKE '%$recherche_numf%' AND 	order_receiver_name LIKE '%$recherche_client%'  ";
   $result = mysqli_query ($conn,$sql);
   $queryResult = mysqli_num_rows($result);
   if($queryResult > 0) {
       while ($row = mysqli_fetch_assoc($result)) {
										$user_id = $row['user_id'];
										$order_id = $row['order_id'];
										$order_receiver_name = $row['order_receiver_name'];
										$order_receiver_address = $row['order_receiver_address'];
     									$order_total_before_tax = $row['order_total_before_tax'];
        								$order_total_tax = $row['order_total_tax'];
        								$order_tax_per = $row['order_tax_per'];
        								$order_total_after_tax = $row['order_total_after_tax'];
										$order_amount_paid = $row['order_amount_paid'];
										$order_total_amount_due = $row['order_total_amount_due'];
										$order_date = $row['order_date'];
										$note = $row['note'];
       ?>
       <tr>
										<td class="none"><?php echo $user_id?></td>
										<td><?php echo $order_id?></td>
										<td><?php echo $order_receiver_name?></td>
										<td class="none"><?php echo $order_receiver_address?></td>
										<td class="none"><?php echo $order_total_before_tax?></td>
										<td class="none"><?php echo $order_total_tax?></td>
										<td class="none"><?php echo $order_tax_per?></td>
                                        <td><?php echo$order_date?></td>
										<td><?php echo $order_total_after_tax?></td>
										<td  class="none"><?php echo$order_amount_paid?></td>
										<td  class="none"><?php echo$order_total_amount_due?></td>
										<td  class="none"><?php echo$note?></td>
										<td class=>
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item " href="profile_client.php?id=<?php echo $row['id_client'];?>"><i class="fa fa-id-card m-r-5"></i> Profile</a>

													<a class="dropdown-item editbtn"><i class="fa fa-pencil m-r-5"></i> Modifier</a>
													<a class="dropdown-item deletebtn"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>	
												</div>
											</div>
										</td>
									</tr>
		<?php }?>

								
							</table>
						</div>
					</div>
				</div>
			</div>

<?php
   }
   else {
       echo '<tr style="background-color:initial"> <td >Aucune donnée disponible</td> </tr>';

   }
}
else
{
    header ('location:clients.php');

}

?>

	
<script src="assets/js/jquery.dataTables.min.js?v=<?php echo time();?>"></script>
<script src="assets/js/dataTables.bootstrap4.min.js?v=<?php echo time();?>"></script>
<script src="assets/js/app.js?v=<?php echo time();?>"></script>	
<script src="script.js?v=<?php echo time();?>"></script>	
</section>


</body>
</html>