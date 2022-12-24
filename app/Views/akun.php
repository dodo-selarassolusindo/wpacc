<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<!-- Main content -->
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 mt-2">
              <h3 class="card-title">Akun</h3>
            </div>
            <div class="col-2">
              <button type="button" class="btn float-right btn-success" onclick="save()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i>   <?= lang('App.new') ?></button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="data_table" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th>Grup Akun</th>
<th>Kode</th>
<th>Nama</th>
<th>Debet Bulan Lalu</th>
<th>Kredit Bulan Lalu</th>
<th>Debet Bulan Ini</th>
<th>Kredit Bulan Ini</th>
<th>Bulan & Tahun</th>

			  <th></th>
              </tr>
            </thead>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<!-- /Main content -->

<!-- ADD modal content -->
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="text-center bg-info p-3" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <form id="data-form" class="pl-3 pr-3">
          <div class="row">
<input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="11" required>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="grup_akun" class="col-form-label"> Grup Akun: <span class="text-danger">*</span> </label>
									<select id="grup_akun" name="grup_akun" class="form-select" required>
										<option value="select1">select1</option>
										<option value="select2">select2</option>
										<option value="select3">select3</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="kode" class="col-form-label"> Kode: <span class="text-danger">*</span> </label>
									<input type="text" id="kode" name="kode" class="form-control" placeholder="Kode" minlength="0"  maxlength="4" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="nama" class="col-form-label"> Nama: <span class="text-danger">*</span> </label>
									<input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" minlength="0"  maxlength="50" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="debet_lalu" class="col-form-label"> Debet Bulan Lalu: <span class="text-danger">*</span> </label>
									<input type="number" id="debet_lalu" name="debet_lalu" class="form-control" placeholder="Debet Bulan Lalu" minlength="0"  required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="kredit_lalu" class="col-form-label"> Kredit Bulan Lalu: <span class="text-danger">*</span> </label>
									<input type="number" id="kredit_lalu" name="kredit_lalu" class="form-control" placeholder="Kredit Bulan Lalu" minlength="0"  required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="debet_ini" class="col-form-label"> Debet Bulan Ini: <span class="text-danger">*</span> </label>
									<input type="number" id="debet_ini" name="debet_ini" class="form-control" placeholder="Debet Bulan Ini" minlength="0"  required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="kredit_ini" class="col-form-label"> Kredit Bulan Ini: <span class="text-danger">*</span> </label>
									<input type="number" id="kredit_ini" name="kredit_ini" class="form-control" placeholder="Kredit Bulan Ini" minlength="0"  required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="bulan_tahun" class="col-form-label"> Bulan & Tahun: <span class="text-danger">*</span> </label>
									<input type="text" id="bulan_tahun" name="bulan_tahun" class="form-control" placeholder="Bulan & Tahun" minlength="0"  maxlength="4" required>
								</div>
							</div>
						</div>

          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="form-btn"><?= lang("App.save") ?></button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= lang("App.cancel") ?></button>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /ADD modal content -->



<?= $this->endSection() ?>
<!-- /.content -->


<!-- page script -->
<?= $this->section("pageScript") ?>
<script>
  // dataTables
  $(function() {
    var table = $('#data_table').removeAttr('width').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollY": '45vh',
      "scrollX": true,
      "scrollCollapse": false,
      "responsive": false,
      "ajax": {
        "url": '<?php echo base_url($controller . "/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true"
      }
    });
  });

  var urlController = '';
  var submitText = '';

  function getUrl() {
    return urlController;
  }

  function getSubmitText() {
    return submitText;
  }

  function save(id) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof id === 'undefined' || id < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-info').addClass('bg-success');
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');
    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          			$("#data-form #id").val(response.id);
			$("#data-form #grup_akun").val(response.grup_akun);
			$("#data-form #kode").val(response.kode);
			$("#data-form #nama").val(response.nama);
			$("#data-form #debet_lalu").val(response.debet_lalu);
			$("#data-form #kredit_lalu").val(response.kredit_lalu);
			$("#data-form #debet_ini").val(response.debet_ini);
			$("#data-form #kredit_ini").val(response.kredit_ini);
			$("#data-form #bulan_tahun").val(response.bulan_tahun);

        }
      });
    }
    $.validator.setDefaults({
      highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      },
      errorElement: 'div ',
      errorClass: 'invalid-feedback',
      errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if ($(element).is('.select')) {
          element.next().after(error);
        } else if (element.hasClass('select2')) {
          //error.insertAfter(element);
          error.insertAfter(element.next());
        } else if (element.hasClass('selectpicker')) {
          error.insertAfter(element.next());
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        var form = $('#data-form');
        $(".text-danger").remove();
        $.ajax({
          // fixBug get url from global function only
          // get global variable is bug!
          url: getUrl(),
          type: 'post',
          data: form.serialize(),
          cache: false,
          dataType: 'json',
          beforeSend: function() {
            $('#form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success: function(response) {
            if (response.success === true) {
              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                $('#data-modal').modal('hide');
              })
            } else {
              if (response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var ele = $("#" + index);
                  ele.closest('.form-control')
                    .removeClass('is-invalid')
                    .removeClass('is-valid')
                    .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
                  ele.after('<div class="invalid-feedback">' + response.messages[index] + '</div>');
                });
              } else {
                Swal.fire({
                  toast: false,
                  position: 'bottom-end',
                  icon: 'error',
                  title: response.messages,
                  showConfirmButton: false,
                  timer: 3000
                })

              }
            }
            $('#form-btn').html(getSubmitText());
          }
        });
        return false;
      }
    });

    $('#data-form').validate({

      //insert data-form to database

    });
  }



  function remove(id) {
    Swal.fire({
      title: "<?= lang("App.remove-title") ?>",
      text: "<?= lang("App.remove-text") ?>",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '<?= lang("App.confirm") ?>',
      cancelButtonText: '<?= lang("App.cancel") ?>'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: '<?php echo base_url($controller . "/remove") ?>',
          type: 'post',
          data: {
            id : id
          },
          dataType: 'json',
          success: function(response) {

            if (response.success === true) {
              Swal.fire({
                toast:true,
                position: 'top-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
              })
            } else {
              Swal.fire({
                toast:false,
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 3000
              })
            }
          }
        });
      }
    })
  }
</script>


<?= $this->endSection() ?>
