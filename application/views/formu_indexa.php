<p>Hello</p>
<h3>Formulaire d'indexation</h3>
<font face="Arial" size="2" color="black">Veuillez fournir une adresse de départ</font>

	<?php echo form_open('formu_indexa/insert'); ?>

	
				<input type="text" name="lien" value="http://" size="60" />
				<?php echo form_submit('submit', 'Indexer'); ?>
			</form>
	</div>
