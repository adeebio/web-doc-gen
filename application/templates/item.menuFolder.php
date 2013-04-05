<div class="item_menu">
	<div id="<?php tag($tags,"initiallySelected","") ?>" class="item_menu_header">
		<div class="item_menu_status" onclick="folder.statusClicked(this);">
			+
		</div>
		<div class="item_menu_title" onclick="content.load('contentPath=<?php tag($tags,"path","") ?>',this,'folder');">
			<?php tag($tags,"title","") ?>
		</div>
	</div>
	<div class="item_menu_body" style="display: none;">
		<?php tag($tags,"body","") ?>
	</div>
</div>