     </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
  
  <!-- Datatable -->
  <script src="libs/js/dataTable/jquery.dataTables.min.js"></script>
  <script src="libs/js/dataTable/dataTables.bootstrap4.min.js"></script>
  <script src="libs/js/dataTable/dataTables.responsive.min.js"></script>
  <script src="libs/js/dataTable/responsive.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script> -->
  <script>

   
function add_panjar(a,b,c){
        $('#Body_input').load('form_input_p.php?id_satker='+a+'&spm='+b+'&id='+c);
        $('#form_panjar').modal('show');
    }
function Add_detail(a){
        $('#Body_dp').load('form_detail_p.php?id='+a);
        $('#Detail_Nodin').modal('show');
    }
    function update_detail(a){
        $('#Body_edit').load('form_u_detail_p.php?id='+a);
        $('#Update').modal('show');
    }
    function Tampil(a){
        $('#Body_dp').load('detail_p.php?id='+a);
        $('#Detail_Nodin').modal('show');
    }

    function AddT(a){
        $('#Body_dp').load('add_transaksi.php?id='+a);
        $('#Detail_Nodin').modal('show');
    }
    function EditT(a){
        $('#Body_et').load('edit_transaksi.php?id='+a);
        $('#EditT').modal('show');
    }

    function simpan_dp(){
        var spm = $('#spm').val();
        var jenis = $('#jenis').val();
        alert(spm);
        $('#Body_dp').POST('insert_dp.php?spm='+spm+'&jenis='+jenis);
        // $('#Detail_Nodin').modal('show');
    }


    $(document).ready(function() {
      dataTable();
    });

    function dataTable(){
      $('#tabel').DataTable({
        responsive:true
      });
    }

    function showT(modal){
        //$('#'+modal).modal('show');
        $('#NodinPengajuan').modal('show');
    }

      var e_nominal = document.getElementById('e_nominal');
		e_nominal.addEventListener('keyup', function(e){
			e_nominal.value = formatRupiah(this.value, 'Rp. ');
		});

    var e_ppn = document.getElementById('e_ppn');
		e_ppn.addEventListener('keyup', function(e){
			e_ppn.value = formatRupiah(this.value, 'Rp. ');
		});

    var e_pph = document.getElementById('e_pph');
		e_pph.addEventListener('keyup', function(e){
			e_pph.value = formatRupiah(this.value, 'Rp. ');
		});

   

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }





    /* Fungsi formatRupiah */
  function formatRupiah1(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
  
</script>

</body>

</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
