$(document).ready(function ()
{
	$("#fileuploader").uploadFile({
		url: BASE_URL + "restrita/produtos/upload",
		fileName: "foto_produto",
		returnType: "json",
		onSuccess: function (files, data) {
			if (data.erro == 0) {
				const imageUrl = BASE_URL + 'uploads/produtos/small/' + data.upload_data['file_name'];
				$("#uploaded_image").append('<ul style="list-style: none; display: inline-block"><li><img src="' + imageUrl + '" width="80" class="img-thumbnail mb-2 mr-1"><input type="hidden" name="fotos_produtos[]" value="' + data.foto_caminho + '"><a href="javascript:(void)" type="button" class="btn bg-danger d-block btn-icon text-white mx-auto mb-30 btn-remove"><i class="fas fa-times"></i></a></li></ul>');
			} else {
				$("#erro_uploaded").html(data.mensagem || "Erro desconhecido ao enviar a imagem.");
			}
		},
	});



	$('#uploaded_image').on('click', '.btn-remove', function () {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn bg-danger text-white',
				cancelButton: 'btn bg-blue text-white mr-2'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: 'Tem certeza da exclusão?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: '<i class="fas fa-exclamation-circle"></i>Excluir!',
			cancelButtonText: '<i class="fas fa-arrow-circle-left"></i>Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$(this).parent().remove();
			} else {
				return false;
			}
		})
	});

});
