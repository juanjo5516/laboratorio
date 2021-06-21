<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-12">
						<h1>Error 404</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="error-page p-5">
				<h2 class="headline text-danger"> 404</h2>
				<div class="error-content">
					<h3>
						<i class="fas fa-exclamation-triangle text-danger"></i>
						Página no encontrada
					</h3>
					<p>
						La página <br>
						"<b>{{$route.path}}</b>"
						no existe.
					</p>
					<!--a href="#" @click="$router.go(-1)">Regresar</a-->
				</div>
			</div>
		</div>
	</div>
</template>