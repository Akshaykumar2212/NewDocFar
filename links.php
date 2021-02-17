<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable({
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api();
                nb_cols = api.columns().nodes().length;
                var j = 11;
                while(j < nb_cols){
                    var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
                    j++;
                } 
            },

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    header: 'false',
                    messageTop: 'Thanks for visiting',
                    title: 'Print Bill',
                    filename: 'pdf_file_name',
                    footer:true
                }, 
                {
                    extend: 'excel',
                    title: 'Customized EXCEL Title',
                    filename: 'excel_file_name',
                    footer:true
                }, 
                {
                    extend: 'print',
                    filename: 'print_file_name',
                    footer:true
                }
            ]
        });

        $('#myTable tfoot th div').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" size="7" placeholder="Search '+title+'" />' );
         } );

        // DataTable
         var otable = $('#myTable').DataTable();

         // Apply the search
         otable.columns().every( function () {
         
             var that = this;
             $( 'input', this.footer() ).on( 'keyup change', function () {
                 if ( that.search() !== this.value ) {
                     that
                        .search( this.value )
                        .draw();
                 }
             } );
         } );
        // $('.dataTables_length').addClass('bs-select');
    } );
</script>
<style>
    input[type=number] {
    -moz-appearance: textfield;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
	  $('#ChangeToggle').click(function() {
	    $('#navbar-hamburger').toggleClass("navbar-hidden");
	    $('#navbar-close').toggleClass("navbar-hidden");  
	  });
	})
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#show_hide').on('click', function(){
            var passwordField = $('#password');
            var passwordFieldtype = passwordField.attr('type');
            if(passwordFieldtype == 'password')
            {
                passwordField.attr('type','text');
                $('#eye').attr('src', 'images/hide.svg');
            }
            else
            {
                passwordField.attr('type','password');
                $('#eye').attr('src', 'images/eye.svg');
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#show_hide_r1').on('click', function(){
            var passwordField = $('#password');
            var passwordFieldtype = passwordField.attr('type');
            if(passwordFieldtype == 'password')
            {
                passwordField.attr('type','text');
                $('#eyer1').attr('src', 'images/hide.svg');
            }
            else
            {
                passwordField.attr('type','password');
                $('#eyer1').attr('src', 'images/eye.svg');
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#show_hide_r2').on('click', function(){
            var passwordField = $('#confirm_password');
            var passwordFieldtype = passwordField.attr('type');
            if(passwordFieldtype == 'password')
            {
                passwordField.attr('type','text');
                $('#eyer2').attr('src', 'images/hide.svg');
            }
            else
            {
                passwordField.attr('type','password');
                $('#eyer2').attr('src', 'images/eye.svg');
            }
        });
    });
</script>
<script type="text/javascript">
    function sum(){
        var input_t1 = document.getElementById('input_t1').value;
        var input_t2 = document.getElementById('input_t2').value;
        var input_t3 = document.getElementById('input_t3').value;
        var tsum = Number(input_t1) + Number(input_t2) + Number(input_t3);
        document.getElementById('ttotal').value = tsum;
    }

    function sum1(){
        var ttotal = document.getElementById('ttotal').value;
        var paidbill = document.getElementById('paidbill').value;
        var currentduessum = Number(ttotal) - Number(paidbill);
        document.getElementById('currentdues').value = Math.abs(currentduessum);
    }

    function sum2(){
        var currentdues = document.getElementById('currentdues').value;
        var paidbill = document.getElementById('paidbill').value;
        var totalduessum = Number(currentdues) + Number(paidbill);
        document.getElementById('totaldues').value = Math.abs(totalduessum);
    }

    function sum3(){
        var totaldues = document.getElementById('totaldues').value;
        var currentadvance = document.getElementById('currentadvance').value;
        var totaladvancesum = parseInt(Number(totaldues) - Number(currentadvance));
        document.getElementById('totaladvance').value = totaladvancesum;
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            "searching": false,
            "paging":   false,
            "ordering": false,
            "bInfo" : false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    header: 'false',
                    messageTop: 'Thanks for visiting',
                    title: 'Print Bill',
                    filename: 'pdf_file_name',
                    header:false
                }, 
                {
                    extend: 'excel',
                    title: 'Customized EXCEL Title',
                    filename: 'excel_file_name',
                    header:false
                }, 
                {
                    extend: 'print',
                    filename: 'print_file_name',
                    header:false
                }
            ]
        } );
    } );
</script>