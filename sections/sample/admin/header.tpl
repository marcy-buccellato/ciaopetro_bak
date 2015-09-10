<!-- BEGIN: main -->
<div id="content">
	<div class="breadcrumb"><a href="/admin">Admin</a> &gt; Header</div>
	<form name="frm_header" id="frm_header" enctype="multipart/form-data" action="/admin/header" method="post">
    <table id="tbl_header_mission" width="600px">
    	<tr>
        	<td>
            	<textarea name="content_mission" cols="20" rows="5">{CONTENT_MISSION}</textarea>
            </td>
		</tr>
        <tr>
        	<td>
            	<input type="submit" value="Save" name="save" />
            	<input type="reset" value="Reset" />
			</td>
		</tr>        
    </table>
    </form>
</div>
<div class="clear"></div>
<!-- END: main -->