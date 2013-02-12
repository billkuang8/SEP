        <title>File Upload</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="public/css/files.css" />
    </head>
    <body>
		
        <table id="main" cellspacing="0">
			<th colspan="6">
				<h3>Uploaded Files</h3><br>
				<?=$chain?>
			</th>
			<tr style="text-align: center; font-size: 15px;">
				<td>Title</td>
				<td>Uploaded By</td>
				<td>Modified</td>
				<td>File Type</td>
				<td>Size</td>
				<td> </td>
			</tr>
			<?=$content?>
        </table>	
        <div id="upload_form">
			<hr>
			<p><b>Upload a file here...</b></p>
			<?=form_open_multipart($file_action, array('id' => 'upload'))?>
					<input type="file" name="file[]" multiple=""/>
					<input class="submit" type="submit" name="submit" value="Upload" />
			</form>
			
			<br><br><br><br><hr>
			<p><b>Create a folder here...</b></p>
			<?=form_open($folder_action, array('id' => 'folder'))?>
					<label>Folder Name: </label><input type="text" name="folder" />
					<input class="submit" type="submit" name="submit" value="Create" />
			</form>
		</div>
		<script type="text/javascript">
			var logged_in_as = "<?=$logged_in_as?>";
			var privilege = parseInt("<?=$privilege?>");
		</script>
		<script type="text/javascript" src="public/js/files.js"></script>
