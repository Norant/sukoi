<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Sistema de Administración de Anypsa</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Por favor ingrese con su usuario y contraseña
					</div>
					<form class="form-horizontal" action="<?php echo HTML_PATH;?>saf/" method="post">
						<fieldset>
							<div class="input-prepend" title="Usuario" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large" name="usuario" id="usuario" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Clave" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large" name="clave" id="clave" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Entrar</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->