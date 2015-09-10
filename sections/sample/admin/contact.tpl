<!-- BEGIN: main -->
<div id="content">
	<div class="breadcrumb"><a href="/admin">Admin</a> &gt; Contact Us</div>
	<div class="heading" id="hd_contact"></div>
	<form name="frm_contact" id="frm_contact" enctype="multipart/form-data" action="/admin/contact" method="post">
    <table id="tbl_contact_main" width="600px">
    	<tr>
        	<td>
            	<textarea name="content_main" cols="75" rows="20">{CONTENT_MAIN}</textarea>
            </td>
        	<td valign="top">
            	<textarea name="content_box" cols="20" rows="10">{CONTENT_BOX}</textarea>
            </td>
		</tr>
        <tr>
        	<td>
            	<input type="submit" value="Save" name="save_sort" />
            	<input type="reset" value="Reset" />
			</td>
		</tr>        
    </table>
    </form>
</div>
<div class="clear"></div>
<!-- END: main -->