<div class="col-md-12">
<!-- Button to Open the Modal -->
<hr>

	<table class="table table-bordered" id="tb_users">
		<thead>
			<tr class="bg-info text-light">
				<th>No</th>
				<th>Nama</th>
				<th>Plat</th>
				<th>Gambar</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>



<link rel="stylesheet" type="text/css" href="assets/css/jquery-confirm.min.css">    
<script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.select.min.js"></script>

<script type="text/javascript">

	var tbl;
	var notif;
	
	jQuery(document).ready(function($) {

		tbl= $('#tb_users').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "parkir_process.php?action=get",
		    select: {
		        style: 'multi+shift',
		    },
		    columnDefs: [                
		        {
		            "orderable": false,
		            "className": 'select-checkbox',
		            "targets": 0,
		            "data":null,
		            "defaultContent": "",
		            "width":"5%"
		        },
		        {
		            "data":"user_name",
		            "targets": 1
		        },
		        {
		            "data":"nomor_plat",
		            "targets": 2
		        },
		        {
		        	"targets" : 3,
		        	"data"    : 'img',
		        	"render" : function(data,type,full,meta){
		          		var img = "<img src='"+data+"' class='img-thumbnail' width='50' height='35' />";
		          		return "<center>"+img+"</center>";
		            }
		        },

		    ],
		    select: {
		        style:    'os',
		        selector: 'td:first-child'
		    },
		    order: [[ 1, 'asc' ]]
		});

		tbl.on( 'order.dt search.dt', function () {
		        tbl.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = i+1;
		        } );
		    } ).draw();
	    

	   
	});

	
</script>